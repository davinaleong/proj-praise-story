<?php

namespace App\Helpers;

class Status
{
    const STATUS_TESTIMONY_DRAFT = 'draft';
    const STATUS_TESTIMONY_PRIVATE = 'private';
    const STATUS_TESTIMONY_PUBLIC = 'public';

    public static function getHumanName(string $status): string
    {
        return match($status) {
            self::STATUS_TESTIMONY_DRAFT => 'Draft',
            self::STATUS_TESTIMONY_PRIVATE => 'Private',
            self::STATUS_TESTIMONY_PUBLIC => 'Public',
        };
    }
}
