<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_saving_throw
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED ability PRIMARY_KEY
 *@param UNASSIGNED value 
 */
class monsterToSavingThrow extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_saving_throw';
}