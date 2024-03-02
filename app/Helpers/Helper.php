<?php

namespace App\Helpers;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '' )
    {
        $html = '';

        foreach ($menus as $key => $menu){
            if($menu->parent_id == $parent_id){
                $html .=
                    '
            <tr>
                <th>'.$menu->id.'</th>
                <th>'.$char.$menu->name.'</th>
                <th>'.$menu->active.'</th>
                <th>'.$menu->updated_at.'</th>
                <th>&nbsp;</th>
            </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id,$char .'--');
            }
        }
        return $html;
    }
}
