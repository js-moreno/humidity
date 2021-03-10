<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }
}
