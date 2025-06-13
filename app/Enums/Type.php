<?php

namespace App\Enums;

enum Type: string
{
    case Text = 'text';
    case Link = 'link';
    case Video = 'video';
    case CustomHtml = 'custom_html';
}
