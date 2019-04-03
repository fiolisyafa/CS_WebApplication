<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'city_id',
        'budget',
        'name',
        'description',
        'date_from',
        'date_to',
        'number_of_people',
    ];	
    
   /**
    * Model Relationships
    */

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function preferences() {
        return $this->hasMany('App\Preference');
    }
}
