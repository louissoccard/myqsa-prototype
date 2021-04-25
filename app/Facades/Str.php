<?php


namespace App\Facades;


class Str extends \Illuminate\Support\Str
{
    public static function namePlural(string $name): string
    {
        if ($name !== '') {
            if (substr($name, -1) === 's') {
                return $name."'";
            } else {
                return $name."'s";
            }
        }

        return '';
    }
}
