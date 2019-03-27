<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'itinerary_id', 'activity_type_id',
    ];

    /**
    * Model Relationships
    */

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function suggestedActivity()
    {
        return $this->hasMany('App\SuggestedActivity');
    }

    public function customActivity()
    {
        return $this->hasMany('App\CustomActivity');
    }   

}
