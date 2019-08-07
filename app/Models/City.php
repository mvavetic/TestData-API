<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country_id'
    ];

    /**
     * Get country from which city originates
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
