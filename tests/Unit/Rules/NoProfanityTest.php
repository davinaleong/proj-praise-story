<?php

namespace Tests\Unit\Rules;

use App\Rules\NoProfanity;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

/**
 * @group unit
 * @group rule
 * @group no-profanity
 */
class NoProfanityTest extends TestCase
{
    public function test_it_blocks_profanity()
    {
        $rule = new NoProfanity();

        $this->assertFalse($rule->passes('content', 'This contains 2 girls 1 cup'));
        $this->assertFalse($rule->passes('content', 'You are such an asshat!'));
        $this->assertFalse($rule->passes('content', 'A55hole behavior.'));
    }

    public function test_it_allows_clean_content()
    {
        $rule = new NoProfanity();

        $this->assertTrue($rule->passes('content', 'This is a perfectly clean sentence.'));
        $this->assertTrue($rule->passes('content', 'Hello world! Jesus loves you.'));
    }
}
