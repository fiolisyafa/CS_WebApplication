<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuggestedActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'fee', 'city_id', 'activity_type_id', 'image', 'promo',
    ];

    /**
    * Model Relationships
    */

    public function city()
    {
        return $this->belongsTo('App\City');
    }   

}
