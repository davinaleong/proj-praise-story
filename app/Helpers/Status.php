<?php

namespace App\Helpers;

class Status
{
    const STATUS_TESTIMONY_DRAFT = 'draft';
    const STATUS_TESTIMONY_PRIVATE = 'private';
    const STATUS_TESTIMONY_PUBLIC = 'public';

    const STATUSES_TESTIMONY = [
        self::STATUS_TESTIMONY_DRAFT,
        self::STATUS_TESTIMONY_PRIVATE,
        self::STATUS_TESTIMONY_PUBLIC,
    ];

    public static function getHumanName(string $status): string
    {
        return match($status) {
            self::STATUS_TESTIMONY_DRAFT => 'Draft',
            self::STATUS_TESTIMONY_PRIVATE => 'Private',
            self::STATUS_TESTIMONY_PUBLIC => 'Public',
        };
    }

    public static function getSelectOptions(): array
    {
        return [
            self::STATUS_TESTIMONY_DRAFT => self::getHumanName(self::STATUS_TESTIMONY_DRAFT),
            self::STATUS_TESTIMONY_PRIVATE => self::getHumanName(self::STATUS_TESTIMONY_PRIVATE),
            self::STATUS_TESTIMONY_PUBLIC => self::getHumanName(self::STATUS_TESTIMONY_PUBLIC),
        ];
    }

}
