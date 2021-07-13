<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_skill
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED skill PRIMARY_KEY
 *@param UNASSIGNED value 
 */
class monsterToSkill extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_skill';
}