<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_damage
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED dtype PRIMARY_KEY
 *@param UNASSIGNED damage 
 */
class monsterToDamage extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_damage';
}