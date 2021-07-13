<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_speed
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED type PRIMARY_KEY
 *@param UNASSIGNED speed 
 */
class monsterToSpeed extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_speed';
}