<?php

namespace ctf\Utils;


class RuleValidation
{
    /**
     * @return string
     */
    public static function nickname()
    {
        return "required | string | max:64 | min:2 | regex: /^[a-zA-Z0-9_#@?\-]+$/";
    }

    /**
     * @return string
     */
    public static function avatarUrl()
    {
        return "string | url | max: 512";
    }

    /**
     * @return string
     */
    public static function flag()
    {
        return "required | regex: /" . getenv('FLAG_PATTERN') . "{.*}/";
    }

}