<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class VirusScannerService
{
    /**
     * Scan a file for viruses using ClamAV (supports clamdscan with clamscan fallback).
     *
     * @param  UploadedFile|string  $file
     * @return array{isClean: bool, virus: ?string, message: string}
     */
    public function scanFile(UploadedFile|string $file): array
    {
        if (! config('clamav.enabled', true)) {
            return [
                'isClean' => true,
                'virus' => null,
                'message' => 'Virus scanning disabled.',
            ];
        }

        $filePath = $file instanceof UploadedFile ? $file->getRealPath() : $file;

        if (! $filePath || ! file_exists($filePath)) {
            return [
                'isClean' => false,
                'virus' => null,
                'message' => 'File path not found or unreadable for scanning.',
            ];
        }

        $configuredBinary = config('clamav.binary', '/usr/bin/clamscan');
        $timeout = (float) config('clamav.timeout', 60);

        // Try clamdscan first if clamd daemon is active for fast scans
        if ($configuredBinary === '/usr/bin/clamscan' && file_exists('/usr/bin/clamdscan')) {
            $clamdResult = $this->runScanProcess('/usr/bin/clamdscan', $filePath, $timeout);
            if ($clamdResult['success']) {
                return $clamdResult['data'];
            }
        }

        // Run configured binary (e.g. /usr/bin/clamscan)
        $scanResult = $this->runScanProcess($configuredBinary, $filePath, $timeout);
        if ($scanResult['success']) {
            return $scanResult['data'];
        }

        Log::error("ClamAV scan failed to execute properly.");

        return [
            'isClean' => false,
            'virus' => null,
            'message' => 'Virus scan failed to execute properly.',
        ];
    }

    /**
     * Helper to execute scan process.
     *
     * @return array{success: bool, data: ?array{isClean: bool, virus: ?string, message: string}}
     */
    protected function runScanProcess(string $binary, string $filePath, float $timeout): array
    {
        if (! file_exists($binary) && ! $this->isBinaryInPath($binary)) {
            return ['success' => false, 'data' => null];
        }

        $process = new Process([$binary, '--no-summary', $filePath]);
        $process->setTimeout($timeout);

        try {
            $process->run();
            $exitCode = $process->getExitCode();
            $output = trim($process->getOutput());

            if ($exitCode === 0) {
                return [
                    'success' => true,
                    'data' => [
                        'isClean' => true,
                        'virus' => null,
                        'message' => 'File is clean.',
                    ],
                ];
            }

            if ($exitCode === 1) {
                $virusName = $this->extractVirusName($output);
                Log::warning("Virus detected in file [{$filePath}]: {$virusName}");

                return [
                    'success' => true,
                    'data' => [
                        'isClean' => false,
                        'virus' => $virusName,
                        'message' => "File is infected with malware: {$virusName}",
                    ],
                ];
            }

            // Exit code 2 usually means error / daemon unavailable for clamdscan
            return ['success' => false, 'data' => null];
        } catch (\Throwable $e) {
            Log::error("Exception running {$binary}: " . $e->getMessage());
            return ['success' => false, 'data' => null];
        }
    }

    protected function isBinaryInPath(string $binary): bool
    {
        if (str_contains($binary, '/')) {
            return is_executable($binary);
        }

        $process = new Process(['which', $binary]);
        $process->run();

        return $process->isSuccessful();
    }

    protected function extractVirusName(string $output): string
    {
        if (preg_match('/: (.*) FOUND$/i', $output, $matches)) {
            return trim($matches[1]);
        }

        return 'Malware detected';
    }
}
