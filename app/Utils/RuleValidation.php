<?php

namespace ctf\Utils;


class RuleValidation
{
    public static function nickname()
    {
        return "required | string | max:64 | min:2 | regex: '^[a-zA-Z0-9_#$*\-?,.|@]{2,64}$'";
    }

    public static function avatarUrl(){
        return "string | url | max: 512";
    }

    public static function flag(){
        return "required| regex:/".getenv('FLAG_PATTERN')."{.*}/";
    }

}