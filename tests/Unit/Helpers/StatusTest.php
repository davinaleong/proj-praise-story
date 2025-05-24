<?php

namespace Tests\Feature\Helpers;

use Tests\TestCase;
use App\Models\User;
use App\Helpers\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

/**
 * @group unit
 * @group helper
 * @group status
 */
class StatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_human_name_returns_correct_label(): void
    {
        $this->assertEquals('Draft', Status::getHumanName(Status::STATUS_TESTIMONY_DRAFT));
        $this->assertEquals('Published', Status::getHumanName(Status::STATUS_TESTIMONY_PUBLISHED));
        $this->assertEquals('Private', Status::getHumanName(Status::STATUS_TESTIMONY_PRIVATE));
        $this->assertEquals('Public', Status::getHumanName(Status::STATUS_TESTIMONY_PUBLIC));
        $this->assertEquals('Active', Status::getHumanName(Status::STATUS_SUBSCRIPTION_ACTIVE));
    }

    public function test_get_testimony_select_options(): void
    {
        $options = Status::getTestimonySelectOptions();

        $this->assertSame([
            Status::STATUS_TESTIMONY_DRAFT => 'Draft',
            Status::STATUS_TESTIMONY_PUBLISHED => 'Published',
            Status::STATUS_TESTIMONY_PRIVATE => 'Private',
            Status::STATUS_TESTIMONY_PUBLIC => 'Public',
        ], $options);
    }

    public function test_get_subscription_select_options(): void
    {
        $options = Status::getSubscriptionSelectOptions();

        $this->assertSame([
            Status::STATUS_SUBSCRIPTION_INACTIVE => 'Inactive',
            Status::STATUS_SUBSCRIPTION_ACTIVE => 'Active',
            Status::STATUS_SUBSCRIPTION_CANCELED => 'Canceled',
        ], $options);
    }
}
