<?php

class AIHelper
{
    const MANUSCRIPTS = 1;
    const SOURCES = 2;
    const PROTOCOLS = 3;
    const _3D_IMAGES = 5;
    const CODES = 6;
    const REPOSITORIES = 7;

    public static function getTypeName($type)
    {
        switch ($type) {
            case AIHelper::MANUSCRIPTS:
                return 'manuscript';
            case AIHelper::PROTOCOLS:
                return 'protocol';
            case AIHelper::_3D_IMAGES:
                return '3d image';
            case AIHelper::REPOSITORIES:
                return 'repository';
            case AIHelper::CODES:
                return 'code';
            default:
                return 'source';
        }
    }

    public static function getRegExp($type)
    {
        return '//';

        switch ($type) {
            case self::MANUSCRIPTS:
                return '/^doi:[0-9]+\.[0-9]+\/gigascience\/[a-z]+[0-9]+$/i';
            case self::PROTOCOLS:
                return '/^doi:[0-9]+\.[0-9]+\/protocols\.io\.[a-z0-9]+$/i';
            case self::_3D_IMAGES:
                return '/^https:\/\/skfb\.ly\/[a-z0-9]+$/i';
            case self::REPOSITORIES:
                return '/^https:\/\/github\.com\/[a-z0-9]+$/i';
            case self::CODES:
                return '/^<script[\s\S]*?>[\s\S]*?<\/script>$/i';
            default:
                return '/^doi:[0-9]+\.[0-9]+\/[0-9]+\.[0-9]+$/i';
        }
    }
}