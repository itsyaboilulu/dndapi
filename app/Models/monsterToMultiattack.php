<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * model for monster_to_multiattack
 *
 *@param UNASSIGNED id PRIMARY_KEY
 *@param UNASSIGNED mid
 *@param UNASSIGNED desc
 *@param UNASSIGNED choose
 */
class monsterToMultiattack extends Model
{
    public $timestamps = false;
    protected $table = 'monster_to_multiattack';

    /**
     * returns the related multieattacks attacks
     *
     * @param int $maid
     * @return array
     */
    public static function getAttacks($maid)
    {
        return monsterToMultiattackToAction::getActions($maid);
    }
}
