<?php
namespace Main\DB\Medoo;
class Medoo extends \medoo{
    // rewrite
    protected function column_quote($string)
    {
        // fix * in array
        if($string == "*") return $string;
        // fix " to `
        else $string = '`' . str_replace('.', '`.`', preg_replace('/(^#|\(JSON\))/', '', $string)) . '`';
        return str_replace('`*`', '*', $string);
    }
}
