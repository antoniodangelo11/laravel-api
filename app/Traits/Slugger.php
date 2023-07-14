<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger
{
    public static function slugger($string)
    {

        // generare lo slug base
        $baseSlug = Str::slug($string);
        $i = 1;

        $slug = $baseSlug;

        while (self::where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}