<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
    ];

    /**
    * Model Relationships
    */

    public function suggestedActivity()
    {
        return $this->hasMany('App\SuggestedActivity');
    }
}
