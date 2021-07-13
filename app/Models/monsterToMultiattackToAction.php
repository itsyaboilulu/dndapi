<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**

 * model for monster_to_multiattack_to_action
 *
 *@param UNASSIGNED maid PRIMARY_KEY
 *@param UNASSIGNED aid PRIMARY_KEY
 *@param UNASSIGNED count
 */
class monsterToMultiattackToAction extends Model
{
    public $timestamps = false;
    protected $table = 'monster_to_multiattack_to_action';

    /**
     * returns the action for the given multie attack id
     *
     * @param int $maid multie attack id @see App\Models\monsterToMultiattack
     * @return array
     */
    public static function getActions($maid)
    {
        $actions = array();
        $a = monsterToMultiattackToAction::where('maid', $maid)->get();
        foreach ($a as $j) {
            if (!isset($actions[$j->option])) {
                $actions[$j->option] = array();
            }
            $ac = monsterToAction::find($j->aid);
            $actions[$j->option][] = (object) array(
                'count'     => $j->count,
                'name'      => $ac->name,
                'desc'      => $ac->description,
                'dc'        => array(
                    'attr'      => $ac->dc,
                    'beat'      => $ac->dcv,
                    'success'   => $ac->dc_success,
                ),
                'damage'    => array(
                    'type'          => $ac->damage_type,
                    'damage'        => $ac->damage,
                    'roll_bonus'    => $ac->bonus,
                ),
            );
        }
        return $actions;
    }
}
