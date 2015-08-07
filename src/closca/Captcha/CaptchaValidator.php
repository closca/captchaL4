<?php namespace closca\Captcha;

use Illuminate\Validation\Validator;

class CaptchaValidator extends Validator
{
    public function validateCaptcha($attribute, $value, $parameters)
    {
        return \Captcha::check($value);
    }
}
