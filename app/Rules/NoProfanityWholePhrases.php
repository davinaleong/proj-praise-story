<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Helpers\ProfanityList;

class NoProfanityWholePhrases implements Rule
{
    public function passes($attribute, $value): bool
    {
        $lower = strtolower($value);

        foreach (ProfanityList::BAD_PHRASES as $word) {
            // Escape regex special characters in the word or phrase
            $escapedWord = preg_quote($word, '/');

            // Match whole word or exact phrase using \b boundaries for single words
            // or wrapping with (^|[\s\W]) and ($|[\s\W]) for phrases and symbols
            if (preg_match('/(^|[\s\W])' . $escapedWord . '($|[\s\W])/i', $lower)) {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'The :attribute contains inappropriate language.';
    }
}
