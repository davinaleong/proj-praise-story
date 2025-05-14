<?php

namespace App\Http\Controllers\Me;

use App\Helpers\Setting;
use App\Helpers\Status;
use App\Models\Testimony;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class TestimonyController extends Controller
{
    public function index()
    {
        $statuses = [Status::STATUS_TESTIMONY_DRAFT];
        $items_per_page = Setting::ITEMS_PER_PAGE_100;

        $testimonies = Testimony::where('user_id', auth()->id())
            ->whereNotIn('status', $statuses)
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate($items_per_page);

        return view('me.published.index', compact('testimonies'));
    }

    public function show(string $uuid)
    {
        $testimony = $this->getTestimony($uuid);

        return view('me.published.show', compact('testimony'));
    }

    private function getTestimony(string $uuid): Testimony
    {
        $statuses = Status::STATUS_TESTIMONY_DRAFT;
        $testimony = Testimony::where([
                'uuid' => $uuid
            ])
            ->whereNot('status', $statuses)
            ->firstOrFail();

        if ($testimony->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return $testimony;
    }
}
