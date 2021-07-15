<?php

namespace App\Helpers;

class monsterHelper
{
    /**
     * check if user is trying to seach somthing
     *
     * @param [type] $request
     * @return void
     */
    public static function checkSearchParams($request)
    {
        switch (!NULL) {
            case $request->getParam('name'):
            case $request->getParam('cr'):
            case $request->getParam('type'):
            case $request->getParam('size'):
            case $request->getParam('ac'):
            case $request->getParam('hp'):
            case $request->getParam('align'):
            case $request->getParam('wildshape'):
            case $request->getParam('challenge'):
                return 1;
            default:
                return 0;
        }
    }
}
