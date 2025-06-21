<?php

namespace App\Enums;

enum ItemType: string
{
    case Text = 'text';
    case Link = 'link';
    case Video = 'video';
    case CustomHtml = 'custom_html';
}
