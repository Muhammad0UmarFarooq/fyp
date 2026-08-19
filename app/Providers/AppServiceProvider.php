<?php

namespace App\Providers;

use App\Rules\ClamAvScan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('clamav', function ($attribute, $value, $parameters, $validator) {
            $rule = app(ClamAvScan::class);
            $failed = false;
            $failMessage = null;

            $rule->validate($attribute, $value, function ($message) use (&$failed, &$failMessage) {
                $failed = true;
                $failMessage = $message;
            });

            if ($failed && $failMessage) {
                $validator->setCustomMessages([
                    'clamav' => $failMessage,
                ]);
                return false;
            }

            return ! $failed;
        });
    }
}
