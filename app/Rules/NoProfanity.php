<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Helpers\ProfanityList;

class NoProfanity implements Rule
{
    public function passes($attribute, $value): bool
    {
        $normalized = strtolower(preg_replace('/\s+/', ' ', trim($value)));

        foreach (ProfanityList::BAD_PHRASES as $phrase) {
            $bad = strtolower(trim($phrase));
            if (str_contains($normalized, $bad)) {
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
