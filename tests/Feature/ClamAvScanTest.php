<?php

use App\Rules\ClamAvScan;
use App\Services\VirusScannerService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

const EICAR_TEST_STRING = 'X5O!P%@AP[4\PZX54(P^)7CC)7}$EICAR-STANDARD-ANTIVIRUS-TEST-FILE!$H+H*';

test('scanner passes automatically when clamav is disabled', function () {
    Config::set('clamav.enabled', false);

    $tempFile = tempnam(sys_get_temp_dir(), 'eicar_disabled_');
    file_put_contents($tempFile, EICAR_TEST_STRING);

    $scanner = new VirusScannerService();
    $result = $scanner->scanFile($tempFile);

    @unlink($tempFile);

    expect($result['isClean'])->toBeTrue();
});

test('ClamAvScan validation rule passes for clean uploaded file when mocked', function () {
    Config::set('clamav.enabled', true);

    $mockScanner = Mockery::mock(VirusScannerService::class);
    $mockScanner->shouldReceive('scanFile')
        ->once()
        ->andReturn([
            'isClean' => true,
            'virus' => null,
            'message' => 'File is clean.',
        ]);

    $file = UploadedFile::fake()->create('clean_document.pdf', 100, 'application/pdf');

    $rule = new ClamAvScan($mockScanner);
    $validator = Validator::make(
        ['document' => $file],
        ['document' => [$rule]]
    );

    expect($validator->passes())->toBeTrue();
});

test('ClamAvScan validation rule fails for infected uploaded file when mocked', function () {
    Config::set('clamav.enabled', true);

    $mockScanner = Mockery::mock(VirusScannerService::class);
    $mockScanner->shouldReceive('scanFile')
        ->once()
        ->andReturn([
            'isClean' => false,
            'virus' => 'Eicar-Signature',
            'message' => 'File is infected with malware: Eicar-Signature',
        ]);

    $file = UploadedFile::fake()->create('infected.txt', 10, 'text/plain');

    $rule = new ClamAvScan($mockScanner);
    $validator = Validator::make(
        ['document' => $file],
        ['document' => [$rule]]
    );

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('document'))->toContain('Eicar-Signature');
});

test('live ClamAV scanner integration scans real files', function () {
    if (! env('RUN_LIVE_CLAMAV_TESTS', true)) {
        $this->markTestSkipped('Live ClamAV tests skipped for speed.');
    }

    Config::set('clamav.enabled', true);

    $tempFile = tempnam(sys_get_temp_dir(), 'eicar_live_');
    file_put_contents($tempFile, EICAR_TEST_STRING);

    $scanner = new VirusScannerService();
    $result = $scanner->scanFile($tempFile);

    @unlink($tempFile);

    expect($result['isClean'])->toBeFalse()
        ->and($result['virus'])->not->toBeNull();
});
