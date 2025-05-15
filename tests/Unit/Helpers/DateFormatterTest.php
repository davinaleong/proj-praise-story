<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\DateFormatter;
use Carbon\Carbon;

/**
 * @group unit
 * @group helper
 * @group date-formatter
 */
class DateFormatterTest extends TestCase
{
    public function test_format_returns_database_format(): void
    {
        $date = '2025-05-12';
        $formatted = DateFormatter::format($date, DateFormatter::FORMAT_DATABASE);
        $this->assertSame('2025-05-12', $formatted);
    }

    public function test_format_returns_input_format(): void
    {
        $date = '2025-05-12';
        $formatted = DateFormatter::format($date, DateFormatter::FORMAT_INPUT);
        $this->assertSame('2025-05-12', $formatted);
    }

    public function test_format_returns_display_format(): void
    {
        $date = '2025-05-12';
        $formatted = DateFormatter::format($date, DateFormatter::FORMAT_DISPLAY);
        $this->assertSame('Mon, 12 May 2025', $formatted);
    }

    public function test_format_accepts_carbon_instance(): void
    {
        $carbon = Carbon::create(2025, 5, 12);
        $formatted = DateFormatter::format($carbon, DateFormatter::FORMAT_INPUT);
        $this->assertSame('2025-05-12', $formatted);
    }

    public function test_helpers_to_display_and_to_database(): void
    {
        $date = '2025-05-12';

        $this->assertSame('2025-05-12', DateFormatter::toDatabase($date));
        $this->assertSame('2025-05-12', DateFormatter::toInput($date));
        $this->assertSame('Mon, 12 May 2025', DateFormatter::toDisplay($date));
    }

    public function test_invalid_date_returns_fallback(): void
    {
        $result = DateFormatter::format('not-a-date');
        $this->assertSame('Invalid date', $result);
    }
}
