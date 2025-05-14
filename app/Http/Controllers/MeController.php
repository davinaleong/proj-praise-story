<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimony;
use App\Helpers\Setting;
use App\Helpers\Status;

class MeController extends Controller
{
    public function index()
    {
        $items_per_page = Setting::ITEMS_PER_PAGE_100;

        $testimonies = Testimony::where('user_id', auth()->id())
            ->whereIn('status',            [
                Status::STATUS_TESTIMONY_PUBLIC,
                Status::STATUS_TESTIMONY_PRIVATE
            ])
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate($items_per_page);

        return view('me.index', compact('testimonies'));
    }

    public function show(string $uuid)
    {
        $testimony = $this->getTestimony($uuid);

        return view('me.show', compact('testimony'));
    }

    private function getTestimony(string $uuid): Testimony
    {
        $testimony = Testimony::where('uuid', $uuid)
            ->whereIn('status', [Status::STATUS_TESTIMONY_PUBLIC, Status::STATUS_TESTIMONY_PRIVATE])
            ->firstOrFail();

        if ($testimony->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return $testimony;
    }
}
