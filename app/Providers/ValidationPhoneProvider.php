<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use libphonenumber\PhoneNumberUtil;

class ValidationPhoneProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            $phoneUtil = PhoneNumberUtil::getInstance();
            try {
                $phoneNumber = $phoneUtil->parse($value, 'BR');

                return $phoneUtil->isValidNumber($phoneNumber);
            } catch (\libphonenumber\NumberParseException $e) {
                return false;
            }
        });
    }
}
