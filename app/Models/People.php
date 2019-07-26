<?php

namespace App\Models;

use App\Traits\Excludable;
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
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
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
