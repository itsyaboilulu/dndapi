<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_ability
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED ability PRIMARY_KEY
 *@param UNASSIGNED description 
 */
class monsterToAbility extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_ability';
}