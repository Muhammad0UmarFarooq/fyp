<?php

namespace App\Rules;

use App\Services\VirusScannerService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class ClamAvScan implements ValidationRule
{
    protected VirusScannerService $scanner;

    public function __construct(?VirusScannerService $scanner = null)
    {
        $this->scanner = $scanner ?? app(VirusScannerService::class);
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value instanceof UploadedFile && ! is_string($value)) {
            return;
        }

        $result = $this->scanner->scanFile($value);

        if (! $result['isClean']) {
            if ($result['virus']) {
                $fail("The :attribute contains a virus ({$result['virus']}) and was rejected.");
            } else {
                $fail("The :attribute failed security and virus scanning.");
            }
        }
    }
}
