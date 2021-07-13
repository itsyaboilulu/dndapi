<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_language
 *
 *@param UNASSIGNED mid PRIMARY_KEY
 *@param UNASSIGNED language PRIMARY_KEY
 *@param UNASSIGNED distance 
 */
class monsterToLanguage extends Model 
{
    public $timestamps = false;
    protected $table = 'monster_to_language';
}