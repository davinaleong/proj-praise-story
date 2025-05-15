<?php

namespace Tests\Unit\Helpers;

use PHPUnit\Framework\TestCase;
use App\Helpers\Status;

/**
 * @group unit
 * @group helper
 * @group status
 */
class StatusTest extends TestCase
{
    public function test_get_select_options_returns_valid_key_value_pairs(): void
    {
        $options = Status::getSelectOptions();

        $expected = [
            Status::STATUS_TESTIMONY_DRAFT => 'Draft',
            Status::STATUS_TESTIMONY_PUBLISHED => 'Published',
            Status::STATUS_TESTIMONY_PRIVATE => 'Private',
            Status::STATUS_TESTIMONY_PUBLIC => 'Public',
        ];

        $this->assertSame($expected, $options);
    }

    public function test_get_human_name_returns_correct_label(): void
    {
        $this->assertEquals('Draft', Status::getHumanName(Status::STATUS_TESTIMONY_DRAFT));
        $this->assertEquals('Published', Status::getHumanName(Status::STATUS_TESTIMONY_PUBLISHED));
        $this->assertEquals('Private', Status::getHumanName(Status::STATUS_TESTIMONY_PRIVATE));
        $this->assertEquals('Public', Status::getHumanName(Status::STATUS_TESTIMONY_PUBLIC));
    }
}
