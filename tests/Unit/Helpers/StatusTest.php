<?php

namespace Tests\Feature\Helpers;

use Tests\TestCase;
use App\Helpers\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        // Testimony
        $this->assertEquals('Draft', Status::getHumanName(Status::STATUS_TESTIMONY_DRAFT));
        $this->assertEquals('Published', Status::getHumanName(Status::STATUS_TESTIMONY_PUBLISHED));
        $this->assertEquals('Private', Status::getHumanName(Status::STATUS_TESTIMONY_PRIVATE));
        $this->assertEquals('Public', Status::getHumanName(Status::STATUS_TESTIMONY_PUBLIC));

        // Subscription
        $this->assertEquals('Active', Status::getHumanName(Status::STATUS_SUBSCRIPTION_ACTIVE));
        $this->assertEquals('Inactive', Status::getHumanName(Status::STATUS_SUBSCRIPTION_INACTIVE));
        $this->assertEquals('Canceled', Status::getHumanName(Status::STATUS_SUBSCRIPTION_CANCELED));

        // User
        $this->assertEquals('Active', Status::getHumanName(Status::STATUS_USER_ACTIVE));
        $this->assertEquals('Suspended', Status::getHumanName(Status::STATUS_USER_SUSPENDED));
        $this->assertEquals('Banned', Status::getHumanName(Status::STATUS_USER_BANNED));
        $this->assertEquals('Pending', Status::getHumanName(Status::STATUS_USER_PENDING));

        // Unknown
        $this->assertEquals('Unknown', Status::getHumanName('non-existent-status'));
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

    public function test_get_user_select_options(): void
    {
        $options = Status::getUserSelectOptions();

        $this->assertSame([
            Status::STATUS_USER_ACTIVE => 'Active',
            Status::STATUS_USER_SUSPENDED => 'Suspended',
            Status::STATUS_USER_BANNED => 'Banned',
            Status::STATUS_USER_PENDING => 'Pending',
        ], $options);
    }

    public function test_get_specific_human_name_methods(): void
    {
        $this->assertEquals('Active', Status::getUserHumanName(Status::STATUS_USER_ACTIVE));
        $this->assertEquals('Published', Status::getTestimonyHumanName(Status::STATUS_TESTIMONY_PUBLISHED));
        $this->assertEquals('Canceled', Status::getSubscriptionHumanName(Status::STATUS_SUBSCRIPTION_CANCELED));
    }
}
