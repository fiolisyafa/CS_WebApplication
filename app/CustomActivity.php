<?php

namespace App;

use App\Uuids;
use Illuminate\Database\Eloquent\Model;

class CustomActivity extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'itinerary_id', 'name', 'fee', 'city_id', 'activity_type_id', 'date_time',
    ];

	/**
    * Model Relationships
    */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
