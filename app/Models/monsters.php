<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\monstersAPI;


/**
 * model for monsters
 *
 *@param UNASSIGNED id PRIMARY_KEY
 *@param UNASSIGNED name
 *@param UNASSIGNED cr
 *@param UNASSIGNED type
 *@param UNASSIGNED size
 *@param UNASSIGNED ac
 *@param UNASSIGNED hp
 *@param UNASSIGNED hp_die
 *@param UNASSIGNED alighn
 *@param UNASSIGNED legendery
 *@param UNASSIGNED str
 *@param UNASSIGNED dex
 *@param UNASSIGNED con
 *@param UNASSIGNED int
 *@param UNASSIGNED wis
 *@param UNASSIGNED cha
 *@param UNASSIGNED passive_perception
 */
class monsters extends Model
{
    public $timestamps = false;
    protected $table = 'monsters';

    /**
     * return get monsters data using name instead of id
     *
     * @param string $name monsters name
     * @return mixed
     */
    public static function fromName($name)
    {
        $m = monsters::select('id')->where('name', $name)->first();

        return ($m) ?
            new monster($m->id) :
            NULL;
    }
}
