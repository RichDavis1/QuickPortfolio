<?php

namespace App\Traits;

trait Sanitization
{
    /**
     * Sanitize string before saving in the database.
     *
     * @param string|null $string
     * @return string|null
     */
    public function cleanPre(?string $string) : ?string
    {
        if (!is_string($string)) {
            return null;
        }

        $stringOne = preg_replace('@<(script|style|title|img|onmouseover|iframe|body|svg)[^>]*?>.*?</\\1>@si', '', $string);
        $stringTwo = strip_tags($stringOne);
        $stringThree = filter_var($stringTwo, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        $stringFour = htmlentities($stringThree, ENT_COMPAT, 'UTF-8');

        return is_string($stringFour) ? $stringFour : null;
    }

    /**
     * Sanitize string before display.
     *
     * @param string|null $string
     * @return string|null
     */
    public function cleanPost(?string $string) : ?string
    {
        if (!is_string($string)) {
            return null;
        }
        $stringOne = htmlspecialchars_decode($string);
        $stringTwo = preg_replace('@<(script|style|title|img|onmouseover|iframe|body|svg)[^>]*?>.*?</\\1>@si', '', $stringOne);
        $stringThree = strip_tags($stringTwo);
        $stringFour = filter_var($stringThree, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

        return is_string($stringFour) ? $stringFour : null;
    }
}
