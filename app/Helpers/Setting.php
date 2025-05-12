<?php

namespace App\Helpers;

class Setting
{
    const ITEMS_PER_PAGE_100 = 100;
    const ITEMS_PER_PAGE_200 = 200;
    const ITEMS_PER_PAGE_500 = 500;
    const ITEMS_PER_PAGE_1000 = 1000;

    const ITEMS_PER_PAGE = [
        self::ITEMS_PER_PAGE_100,
        self::ITEMS_PER_PAGE_200,
        self::ITEMS_PER_PAGE_500,
        self::ITEMS_PER_PAGE_1000,
    ];
}
