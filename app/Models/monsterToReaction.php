<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_reaction
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED name 
 *@param UNASSIGNED desc 
 */
class monsterToReaction extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_reaction';
}