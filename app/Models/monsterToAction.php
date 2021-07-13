<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_action
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED type PRIMARY_KEY
 *@param UNASSIGNED name PRIMARY_KEY
 *@param UNASSIGNED description 
 */
class monsterToAction extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_action';
}