<?php

namespace App\Controllers;

use App\Helpers\apiHelper;
use App\Helpers\monsterHelper;
use App\Models\monsters;

class monsterController extends controller
{

    public function all($request, $response, $args)
    {
        $monsters = array();
        foreach (monsters::select('id', 'name', 'cr')->get() as $m) {
            $monsters[] = array(
                'id'        => $m->id,
                'name'      => $m->name,
                'challenge' => $m->cr,
                'link'      => (new apiHelper())->createLink('monsters', $m->name)
            );
        }
        return $response->withJSON($monsters);
    }

    public function random($request, $response, $args)
    {
        return $this->single($response, (monsters::select('name')->inRandomOrder()->limit(1)->first())->name);
    }

    public function randomWildshape($request, $response, $args)
    {
        return $this->single($response, (monsters::select('name')->where('wildshape', 1)->inRandomOrder()->limit(1)->first())->name);
    }

    public function search($request, $response, $args)
    {
        if (monsterHelper::checkSearchParams($request)) {
            $ret = array();
            $search = monsters::select('id', 'name', 'cr');
            if ($request->getParam('name')) {

                $search = $search->where('name', 'like', "%" . $request->getParam('name') . "%");
            }
            if ($request->getParam('challenge')) {
                if (strpos($request->getParam('challenge'), '>') !== NULL) {
                    $c = str_replace('>', '', $request->getParam('challenge'));
                    $o = '>=';
                } else if (strpos($request->getParam('challenge'), '<') !== NULL) {
                    $c = str_replace('<', '', $request->getParam('challenge'));
                    $o = '<=';
                } else {
                    $c = $request->getParam('challenge');
                    $o = '=';
                }
                $search = $search->where('cr', $o, $c);
            }
            if ($request->getParam('size')) {
                $search = $search->where('size', ucfirst($request->getParam('size')));
            }
            if ($request->getParam('ac')) {
                if (strpos($request->getParam('ac'), '>') >= 0) {
                    $c = str_replace('>', '', $request->getParam('ac'));
                    $o = '>=';
                } else if (strpos($request->getParam('ac'), '<') >= 0) {
                    $c = str_replace('<', '', $request->getParam('ac'));
                    $o = '<=';
                } else {
                    $c = $request->getParam('ac');
                    $o = '=';
                }
                $search = $search->where('ac', $o, $c);
            }
            if ($request->getParam('hp')) {
                if (strpos($request->getParam('hp'), '>') >= 0) {
                    $c = str_replace('>', '', $request->getParam('ac'));
                    $o = '>=';
                } else if (strpos($request->getParam('hp'), '<') >= 0) {
                    $c = str_replace('<', '', $request->getParam('hp'));
                    $o = '<=';
                } else {
                    $c = $request->getParam('hp');
                    $o = '=';
                }
                $search = $search->where('hp', $o, $c);
            }
            if ($request->getParam('wildshape')) {
                $search = $search->where('wildshape', 1);
            }
            if ($request->getParam('type')) {
                $search = $search->where('type', $request->getParam('type'));
            }
            if ($request->getParam('align')) {
                $search = $search->where('align', $request->getParam('align'));
            }
            foreach ($search->get() as $m) {
                $ret[] = array(
                    'id'        => $m->id,
                    'name'      => $m->name,
                    'challenge' => $m->cr,
                    'link'      => (new apiHelper())->createLink('monsters', $m->name)
                );
            }
            return $response->withJSON($ret);
        }
        return $this->all($request, $response, $args);
    }

    public function find($request, $response, $args)
    {
        return ($args['any']) ?
            $this->single($response, $args['any']) :
            $this->search($request, $response, $args);
    }

    public function single($response, $name)
    {
        $name = str_replace('_', ' ', $name);
        $m = monsters::fromName($name);
        if ($m) {
            return $response->withJSON([
                'name'                  => $m->name,
                'challenge'             => $m->cr,
                'size'                  => $m->size,
                'align'                 => $m->align,
                'type'                  => $m->type,
                'ac'                    => $m->ac,
                'hp'                    => $m->hp_die,
                'speed'                 => $m->speed,
                'perception'            => $m->perception,
                'languages'             => $m->lang,
                'ability_score'         => array(
                    'STR'   => $m->str,
                    'DEX'   => $m->dex,
                    'CON'   => $m->con,
                    'INT'   => $m->int,
                    'WIS'   => $m->wis,
                    'CHA'   => $m->cha,
                ),
                'saving_throw'          => $m->savingThrow,
                'damage_resistance'     => $m->damage_resistance,
                'condition_immunity'    => $m->condition_resistance,
                'ability'               => $m->ability,
                'multieattacks'         => $m->multieattack,
                'actions'               => array(
                    'multiattack'   => $m->multieattack,
                    'action'        => $m->action,
                    'reaction'      => $m->reaction,
                ),
            ]);
        }
        return $response->withJSON(['error' => "$name not found"]);
    }
}
