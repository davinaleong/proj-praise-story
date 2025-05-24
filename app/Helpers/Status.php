<?php

namespace App\Helpers;

class Status
{
    const STATUS_TESTIMONY_DRAFT = 'draft';
    const STATUS_TESTIMONY_PUBLISHED = 'published';
    const STATUS_TESTIMONY_PRIVATE = 'private';
    const STATUS_TESTIMONY_PUBLIC = 'public';

    const STATUSES_TESTIMONY = [
        self::STATUS_TESTIMONY_DRAFT,
        self::STATUS_TESTIMONY_PUBLISHED,
        self::STATUS_TESTIMONY_PRIVATE,
        self::STATUS_TESTIMONY_PUBLIC,
    ];

    const STATUS_SUBSCRIPTION_INACTIVE = 'inactive';
    const STATUS_SUBSCRIPTION_ACTIVE = 'active';
    const STATUS_SUBSCRIPTION_CANCELED = 'canceled';

    const STATUSES_SUBSCRIPTION = [
        self::STATUS_SUBSCRIPTION_INACTIVE,
        self::STATUS_SUBSCRIPTION_ACTIVE,
        self::STATUS_SUBSCRIPTION_CANCELED,
    ];

    public static function getHumanName(string $status): string
    {
        return match($status) {
            self::STATUS_TESTIMONY_DRAFT => 'Draft',
            self::STATUS_TESTIMONY_PUBLISHED => 'Published',
            self::STATUS_TESTIMONY_PRIVATE => 'Private',
            self::STATUS_TESTIMONY_PUBLIC => 'Public',
            self::STATUS_SUBSCRIPTION_ACTIVE => 'Active',
            self::STATUS_SUBSCRIPTION_INACTIVE => 'Inactive',
            self::STATUS_SUBSCRIPTION_CANCELED => 'Canceled',
        };
    }

    public static function getTestimonyHumanName(string $status): string
    {
        return match($status) {
            self::STATUS_TESTIMONY_DRAFT => 'Draft',
            self::STATUS_TESTIMONY_PUBLISHED => 'Published',
            self::STATUS_TESTIMONY_PRIVATE => 'Private',
            self::STATUS_TESTIMONY_PUBLIC => 'Public',
            default => 'Unknown'
        };
    }

    public static function getTestimonySelectOptions(): array
    {
        return [
            self::STATUS_TESTIMONY_DRAFT => self::getHumanName(self::STATUS_TESTIMONY_DRAFT),
            self::STATUS_TESTIMONY_PUBLISHED => self::getHumanName(self::STATUS_TESTIMONY_PUBLISHED),
            self::STATUS_TESTIMONY_PRIVATE => self::getHumanName(self::STATUS_TESTIMONY_PRIVATE),
            self::STATUS_TESTIMONY_PUBLIC => self::getHumanName(self::STATUS_TESTIMONY_PUBLIC),
        ];
    }

    public static function getSubscriptionHumanName(string $status): string
    {
        return match($status) {
            self::STATUS_SUBSCRIPTION_INACTIVE => 'Inactive',
            self::STATUS_SUBSCRIPTION_ACTIVE => 'Active',
            self::STATUS_SUBSCRIPTION_CANCELED => 'Canceled',
        };
    }

    public static function getSubscriptionSelectOptions(): array
    {
        return [
            self::STATUS_SUBSCRIPTION_INACTIVE => self::getHumanName(self::STATUS_SUBSCRIPTION_INACTIVE),
            self::STATUS_SUBSCRIPTION_ACTIVE => self::getHumanName(self::STATUS_SUBSCRIPTION_ACTIVE),
            self::STATUS_SUBSCRIPTION_CANCELED => self::getHumanName(self::STATUS_SUBSCRIPTION_CANCELED),
        ];
    }

}
