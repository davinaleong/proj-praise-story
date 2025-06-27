<?php

namespace Tests\Unit\Rules;

use App\Rules\NoProfanityWholePhrases;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

/**
 * @group unit
 * @group rule
 * @group no-profanity-whole-phrases
 */
class NoProfanityWholePhrasesTest extends TestCase
{
    public function test_it_blocks_exact_profanity_phrases()
    {
        $rule = new NoProfanityWholePhrases();

        $this->assertFalse($rule->passes('content', 'You are such an ass.'));
        $this->assertFalse($rule->passes('content', 'This contains 2 girls 1 cup.'));
        $this->assertFalse($rule->passes('content', 'That guy is an asshat!'));
    }

    public function test_it_allows_clean_sentences()
    {
        $rule = new NoProfanityWholePhrases();

        $this->assertTrue($rule->passes('content', 'This is a good and decent sentence.'));
        $this->assertTrue($rule->passes('content', 'Let’s go for a walk in the park.'));
    }

    public function test_it_does_not_block_substrings_or_safe_words()
    {
        $rule = new NoProfanityWholePhrases();

        $this->assertTrue($rule->passes('content', 'Let’s pass the test together.')); // 'ass' in 'pass'
        $this->assertTrue($rule->passes('content', 'The class is starting soon.')); // 'ass' in 'class'
        $this->assertTrue($rule->passes('content', 'We need to compile and push it.')); // 'sh' in 'push'
    }
}
