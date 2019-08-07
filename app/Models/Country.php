<?php

namespace App\Models;

use App\Interfaces\ModelInterface;
use Illuminate\Database\Eloquent\Model;

class Country extends Model implements ModelInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];

    /**
     * Get people which are from certain country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function people()
    {
        return $this->hasMany('App\Models\People', 'country_id');
    }

    /**
     * Get cities that belong to a country
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function capitalCity()
    {
        return $this->hasOne('App\Models\City', 'country_id');
    }
}
