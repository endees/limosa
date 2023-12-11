<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Pesel implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[0-9]{11}$/', $value)) {
            $fail("The $attribute must have exactly 11 digits.");
        }

        $weights_pesel = array(1,3,7,9,1,3,7,9,1,3);

        if ($this->calculateControlSum($value, $weights_pesel) === false) {
            $fail("The $attribute must be a valid PESEL number.");
        }
    }

    private function calculateControlSum($pesel, $weights) {
        if (strlen($pesel) < count($weights)) {
            return false;
        }
        $target_digit  = substr($pesel, count($weights), 1);

        $sum = 0;
        foreach($weights as $key => $weight) {
            $product = $weight * substr($pesel, $key, 1);
            if ($product > 10) {
                $sum += (int)substr($product, 1,1);
            } else {
                $sum += $product;
            }
        }
        if ($sum > 10) {
            $control_digit = 10 - (int)substr($sum, 1,1);
        } else {
            $control_digit = 10 - $sum;
        }

        if ($control_digit != $target_digit || $control_digit == 10) {
            return false;
        }
        return true;
    }
}
