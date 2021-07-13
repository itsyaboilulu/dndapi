<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_sense
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED sense 
 *@param UNASSIGNED distance 
 */
class monsterToSense extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_sense';
}