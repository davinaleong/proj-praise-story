<?php

namespace App\Helpers;

class Status
{
    // active, suspended, banned, pending
    const STATUS_USER_ACTIVE = 'active';
    const STATUS_USER_SUSPENDED = 'suspended';
    const STATUS_USER_BANNED = 'banned';
    const STATUS_USER_PENDING = 'pending';

    const STATUSES_USER = [
        self::STATUS_USER_ACTIVE,
        self::STATUS_USER_SUSPENDED,
        self::STATUS_USER_BANNED,
        self::STATUS_USER_PENDING,
    ];

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

    const STATUS_SPECIAL_CONTENT_GROUP_DRAFT = 'draft';
    const STATUS_SPECIAL_CONTENT_GROUP_PUBLISHED = 'published';
    const STATUS_SPECIAL_CONTENT_GROUP_PRIVATE = 'private';
    const STATUS_SPECIAL_CONTENT_GROUP_PUBLIC = 'public';
    const STATUSES_SPECIAL_CONTENT_GROUP = [
        self::STATUS_SPECIAL_CONTENT_GROUP_DRAFT,
        self::STATUS_SPECIAL_CONTENT_GROUP_PUBLISHED,
        self::STATUS_SPECIAL_CONTENT_GROUP_PRIVATE,
        self::STATUS_SPECIAL_CONTENT_GROUP_PUBLIC,
    ];

    public static function getHumanName(string $status): string
    {
        return match($status) {
            self::STATUS_USER_ACTIVE => 'Active',
            self::STATUS_USER_SUSPENDED => 'Suspended',
            self::STATUS_USER_BANNED => 'Banned',
            self::STATUS_USER_PENDING => 'Pending',
            self::STATUS_TESTIMONY_DRAFT => 'Draft',
            self::STATUS_TESTIMONY_PUBLISHED => 'Published',
            self::STATUS_TESTIMONY_PRIVATE => 'Private',
            self::STATUS_TESTIMONY_PUBLIC => 'Public',
            self::STATUS_SUBSCRIPTION_ACTIVE => 'Active',
            self::STATUS_SUBSCRIPTION_INACTIVE => 'Inactive',
            self::STATUS_SUBSCRIPTION_CANCELED => 'Canceled',
            self::STATUS_SPECIAL_CONTENT_GROUP_DRAFT => 'Draft',
            self::STATUS_SPECIAL_CONTENT_GROUP_PUBLISHED => 'Published',
            self::STATUS_SPECIAL_CONTENT_GROUP_PRIVATE => 'Private',
            self::STATUS_SPECIAL_CONTENT_GROUP_PUBLIC => 'Public',
            default => 'Unknown'
        };
    }

    public static function getUserHumanName(string $status): string
    {
        return match($status) {
            self::STATUS_USER_ACTIVE => 'Active',
            self::STATUS_USER_SUSPENDED => 'Suspended',
            self::STATUS_USER_BANNED => 'Banned',
            self::STATUS_USER_PENDING => 'Pending',
            default => 'Unknown'
        };
    }

    public static function getUserSelectOptions(): array
    {
        return [
            self::STATUS_USER_ACTIVE => self::getHumanName(self::STATUS_USER_ACTIVE),
            self::STATUS_USER_SUSPENDED => self::getHumanName(self::STATUS_USER_SUSPENDED),
            self::STATUS_USER_BANNED => self::getHumanName(self::STATUS_USER_BANNED),
            self::STATUS_USER_PENDING => self::getHumanName(self::STATUS_USER_PENDING),
        ];
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

    public static function getSpecialContentGroupName(string $status): string
    {
        return match($status) {
            self::STATUS_SPECIAL_CONTENT_GROUP_DRAFT => 'Draft',
            self::STATUS_SPECIAL_CONTENT_GROUP_PUBLISHED => 'Published',
            self::STATUS_SPECIAL_CONTENT_GROUP_PRIVATE => 'Private',
            self::STATUS_SPECIAL_CONTENT_GROUP_PUBLIC => 'Public',
            default => 'Unknown'
        };
    }

    public static function getSpecialContentGroupSelectOptions(): array
    {
        return [
            self::STATUS_SPECIAL_CONTENT_GROUP_DRAFT => self::getHumanName(self::STATUS_SPECIAL_CONTENT_GROUP_DRAFT),
            self::STATUS_SPECIAL_CONTENT_GROUP_PUBLISHED => self::getHumanName(self::STATUS_SPECIAL_CONTENT_GROUP_PUBLISHED),
            self::STATUS_SPECIAL_CONTENT_GROUP_PRIVATE => self::getHumanName(self::STATUS_SPECIAL_CONTENT_GROUP_PRIVATE),
            self::STATUS_SPECIAL_CONTENT_GROUP_PUBLIC => self::getHumanName(self::STATUS_SPECIAL_CONTENT_GROUP_PUBLIC),
        ];
    }

}
