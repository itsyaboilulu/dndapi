<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_condition
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED ctype PRIMARY_KEY
 *@param UNASSIGNED condition 
 */
class monsterToCondition extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_condition';
}