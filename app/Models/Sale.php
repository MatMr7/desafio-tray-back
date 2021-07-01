<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_value',
        'seller_uuid'
    ];

    public function setCommissionAttribute($value)
    {
        $value = number_format(doubleval($value), 2, '', '');
        $value_lenght  = strlen($value);
        $formated_value = str_repeat('0', 12 - $value_lenght);
        $formated_value= $formated_value.$value;
        $this->attributes['commission'] = $formated_value;
    }

    public function getCommissionAttribute($value)
    {
       return $this->formatValueFromTwelveDigits($value);
    }


    public function getSaleValueAttribute($value)
    {
        return $this->formatValueFromTwelveDigits($value);
    }

    
    public function formatValueFromTwelveDigits($value)
    {
        $value = ltrim($value,'0');
        $value = substr_replace($value, '.',strlen($value) - 2, 0);
        if($value[0] == '.')
            $value = '0'.$value;
        return doubleVal($value);
    }
}