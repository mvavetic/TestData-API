<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'nickname', 'birth_date'
    ];

    /**
     * Get country from which person originates
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function fromCountry()
    {
        return $this->belongsTo('App\Models\Country', 'country');
    }
}
