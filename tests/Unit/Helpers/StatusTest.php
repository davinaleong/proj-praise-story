<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\Status;

/**
 * @group unit
 * @group helper
 * @group status
 */
class StatusTest extends TestCase
{
    public function test_get_human_name_returns_draft_for_draft_status(): void
    {
        $this->assertSame('Draft', Status::getHumanName(Status::STATUS_TESTIMONY_DRAFT));
    }

    public function test_get_human_name_returns_private_for_private_status(): void
    {
        $this->assertSame('Private', Status::getHumanName(Status::STATUS_TESTIMONY_PRIVATE));
    }

    public function test_get_human_name_returns_public_for_public_status(): void
    {
        $this->assertSame('Public', Status::getHumanName(Status::STATUS_TESTIMONY_PUBLIC));
    }

    public function test_get_human_name_throws_error_for_invalid_status(): void
    {
        $this->expectException(\UnhandledMatchError::class);

        Status::getHumanName('invalid_status');
    }

    public function test_get_select_options_returns_valid_key_value_pairs(): void
    {
        $options = Status::getSelectOptions();

        $expected = [
            Status::STATUS_TESTIMONY_DRAFT => 'Draft',
            Status::STATUS_TESTIMONY_PRIVATE => 'Private',
            Status::STATUS_TESTIMONY_PUBLIC => 'Public',
        ];

        $this->assertSame($expected, $options);
    }
}
