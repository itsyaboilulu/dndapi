<?php

namespace App\Models;


class monster
{

    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    function __get($key)
    {
        switch ($key) {
            case 'name':
                return $this->base()->name;
            case 'id':
                return $this->base()->id;
            case 'challenge':
            case 'cr':
                return $this->base()->cr;
            case 'size':
                return $this->base()->size;
            case 'type':
                return $this->base()->type;
            case 'align':
                return $this->base()->align;
            case 'ac':
                return $this->base()->ac;
            case 'hp':
                return $this->hp();
            case 'hp_die':
                return $this->hp()['die'];
            case 'wildshape':
                return ($this->base()->wildshape) ? TRUE : FALSE;
            case 'str':
                return $this->base()->str;
            case 'dex':
                return $this->base()->dex;
            case 'con':
                return $this->base()->con;
            case 'int':
                return $this->base()->int;
            case 'wis':
                return $this->base()->wis;
            case 'cha':
                return $this->base()->cha;
            case 'language':
            case 'lang':
                return $this->languages();
            case 'speed':
                return $this->speed();
            case 'walk':
                return (isset($this->speed()['walk'])) ? $this->speed()['walk'] : 0;
            case 'swim':
                return (isset($this->speed()['swim'])) ? $this->speed()['swim'] : 0;
            case 'fly':
                return (isset($this->speed()['fly'])) ? $this->speed()['fly'] : 0;
            case 'climb':
                return (isset($this->speed()['climb'])) ? $this->speed()['climb'] : 0;
            case 'savingThrow':
                return $this->savingThrow();
            case 'perception':
                return $this->base()->passive_perception;
            case 'damage_resistance':
                return $this->damage();
            case 'condition_resistance':
                return $this->condition();
            case 'ability':
                return $this->abilities();
            case 'multieattack':
                return $this->multieAttack();
            case 'action':
                return $this->action();
            case 'reaction':
                return $this->reaction();
        }
    }

    /**
     * store for monsters table data
     *
     * @see monster()
     * @var object
     */
    private $base;

    /**
     * returns monsters base table data
     *
     * @return object
     */
    public function base()
    {
        if (!$this->base) {
            $this->base = monsters::find($this->id);
        }
        return $this->base;
    }

    /**
     * store for monsters languages
     *
     * @see language()
     * @var array
     */
    private $lang;

    /**
     * returns list of monsters languages
     *
     * @return array
     */
    public function languages()
    {
        if (!$this->lang) {
            $this->lang = array();
            foreach (monsterToLanguage::select('language')->where('mid', $this->id)->get() as $l) {
                $this->lang[] = $l->language;
            }
        }
        return $this->lang;
    }

    /**
     * store for monsters movment and speed
     *
     * @see speed
     * @var array
     */
    private $speed;

    /**
     * return monsters movment and speed
     *
     * @var array
     */
    public function speed()
    {
        if (!$this->speed) {
            $this->speed = array();
            foreach (monsterToSpeed::select('type', 'speed')->where('mid', '=', $this->id)->get() as $s) {
                $this->speed[$s->type] = $s->speed;
            };
        }
        return $this->speed;
    }

    /**
     * store for monsters abilities
     *
     * @see abilities()
     * @var array
     */
    private $abilities;

    /**
     * returns a list of the loaded monsters ability data
     *
     * @return array
     */
    public function abilities()
    {
        if (!$this->abilities) {
            $this->abilities = array();
            foreach (monsterToAbility::select('ability', 'description')->where('mid', '=', $this->id)->get() as $m) {
                $this->abilities[$m->ability] = $m->description;
            }
        }
        return $this->abilities;
    }

    /**
     * store for monsters multie attack data
     *
     * @see multieAttack()
     * @var array
     */
    private $multieattack;

    /**
     * returns list of monsters multie attack data
     *
     * @return void
     */
    public function multieAttack()
    {
        if (!$this->multieAttack) {
            $multieattack = monsterToMultiattack::where('mid', $this->id)->get();
            $this->multieAttack = array();
            foreach ($multieattack as $m) {
                $this->multieAttack[] = (object) array(
                    'attacks'   => monsterToMultiattack::getAttacks($m->id),
                    'choose'    => $m->choose,
                    'desc'      => $m->desc,
                );
            }
        }
        return $this->multieAttack;
    }

    /**
     * store for monsters action data
     *
     * @see action()
     * @var array
     */
    private $action;

    /**
     * returns list of monsters actions
     *
     * @return array()
     */
    public function action()
    {
        if (!$this->action) {
            $this->action = array();
            foreach (monsterToAction::where('mid', '=', $this->id)->get() as $a) {
                $this->action[] = array(
                    'name'      => $a->name,
                    'desc'      => $a->description,
                    'dc'        => array(
                        'attr'      => $a->dc,
                        'beat'      => $a->dcv,
                        'success'   => $a->dc_success,
                    ),
                    'damage'    => array(
                        'type'      => $a->damage_type,
                        'damage'    => $a->damage,
                        'roll_bonus' => $a->bonus,
                    ),
                    'legendery_action'  => ($a->legendery) ? TRUE : FALSE,
                );
            }
        }
        return $this->action;
    }

    private $reaction;

    public function reaction()
    {
        if (!$this->reaction) {
            $this->reaction = array();
            foreach (monsterToReaction::select('name', 'desc')->where('mid', $this->id)->get() as $m) {
                $this->reaction[$m->name] = $m->desc;
            }
        }
        return $this->reaction;
    }

    /**
     * store for monsters conditional resistances
     *
     * @var array
     */
    private $condition;

    /**
     * ruturn list of monsters conditional resistances
     *
     * @see condition()
     * @return array
     */
    public function condition()
    {
        if (!$this->condition) {
            $this->condition = array();
            foreach (monsterToCondition::select('ctype', 'condition')->where('mid', '=', $this->id)->get() as $r) {
                $this->condition[]  = $r->condition;
            };
        }
        return $this->condition;
    }

    /**
     * store for monsters damage resistances
     *
     * @see damage()
     * @var array
     */
    private $damage;

    /**
     * ruturn list of monsters damage resistances
     *
     * @return array
     */
    public function damage()
    {
        if (!$this->damage) {
            $this->damage = array(
                'resistant' => array(),
                'immunity'  => array()
            );
            foreach (monsterToDamage::select('dtype', 'damage')->where('mid', '=', $this->id)->get() as $r) {
                if ($r->dtype == 'immunities') {
                    $this->damage['immunity'][]  = $r->damage;
                } else {
                    $this->damage['resistant'][] = $r->damage;
                }
            };
        }
        return $this->damage;
    }

    /**
     * store for monsters saving throws
     *
     * @see savingThrow()
     * @var array
     */
    private $savingThrow;

    /**
     * returns list of monsters saving throws
     *
     * @return array
     */
    public function savingThrow()
    {
        if (!$this->savingThrow) {
            $this->savingThrow = array();
            foreach (monsterToSavingThrow::select('ability', 'value')->where('mid', '=', $this->id)->get() as $s) {
                $this->savingThrow[$s->ability] = $s->value;
            }
        }
        return $this->savingThrow;
    }

    /**
     * store for monsters senses (e.g. passive perception)
     *
     * @see sense()
     * @var array
     */
    private $sense;

    /**
     * return monsters senses (e.g. passive perception)
     *
     * @var array
     */
    public function sense()
    {
        if (!$this->sense) {
            $this->sense = monsterToSense::select('sense', 'distance')->where('mid', '=', $this->id)->get();
        }
        return $this->sense;
    }

    /**
     * store for monsters skills e.g( STR +1 )
     *
     * @see skill()
     * @var array()
     */
    private $skill;

    /**
     * return monsters skills e.g( STR +1 )
     *
     * @var array()
     */
    public function skill()
    {
        if (!$this->skill) {
            $this->skill = monsterToSkill::select('skill', 'value')->where('mid', '=', $this->id)->get();
        }
        return $this->skill;
    }

    /**
     * return monsters hp values
     *
     * @return void
     */
    protected function hp()
    {
        return [
            'die'           => $this->base()->hp_die,
            'recomended'    => $this->base()->hp,
        ];
    }
}
