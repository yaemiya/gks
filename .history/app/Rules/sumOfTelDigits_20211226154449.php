<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SumOfTelDigits implements Rule
{
    /**
     * @var array
     */
    protected $attributes = [];
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->attributes = $attributes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attributes, $value)
    {
        foreach ($this->attributes as $attribute)
        {
            $sumOfTelDigits += $attribte;

        }
        
        return  $sumOfTelDigits ===;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '電話番号の合計桁数は10桁か11桁で入力してください';
    }
}
