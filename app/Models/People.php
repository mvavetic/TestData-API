<?php

namespace App\Models;

use App\Interfaces\ModelInterface;
use Illuminate\Database\Eloquent\Model;

class People extends Model implements ModelInterface
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'nickname', 'birth_date', 'country_id'
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
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    /**
     * Get person's avatar
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function avatar()
    {
        return $this->hasOne('App\Models\Avatar', 'person_id');
    }
}
