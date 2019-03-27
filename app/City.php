<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city', 'country',
    ];

    /**
    * Model Relationships
    */

    public function suggestedActivity()
    {
        return $this->hasMany('App\SuggestedActivity');
    }

    public function customActivity()
    {
        return $this->hasMany('App\CustomActivity');
    }   

}
