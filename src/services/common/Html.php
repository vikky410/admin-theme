<?php

namespace Service\Common;

class Html
{
    public static $roles = array (
        USER_ROLE_SUPER_ADMIN => 'Super Administrator',
        USER_ROLE_ADMIN => 'Administrator',
        USER_ROLE_USER => 'Ordinary users' 
    );

    public static function select($id, $name, $categories, $checked = null, $default_value = false, $className = null, $style = null) {
        
        $output = '<select id="' . $id . '" name="' . $name . '"';
        if( ! is_null($className)) {
            $output .= ' class="' . $className . '"';
        }
        if( ! is_null($style)) {
            $output .= ' style="' . $style . '"';
        }
        $output .= '>';
        
        if($default_value != false) {
            $output .= '<option value="0">' . $default_value . '</option>';
        }
        
        foreach($categories as $k => $v) {
            $output .= '<option value="' . $k . '"';
            if( ! is_null($checked) && $checked == $k) {
                $output .= ' selected="selected"';
            }
            $output .= '>';
            $output .= $v;
            $output .= '</option>';
        }
        
        $output .= '</select>';
        
        return $output;
    }
}