<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimony;
use App\Helpers\Setting;
use App\Helpers\Status;

class IndexController extends Controller
{
    public function index()
    {
        $status = Status::STATUS_TESTIMONY_PUBLIC;
        $items_per_page = Setting::ITEMS_PER_PAGE_100;

        $testimonies = Testimony::where('status', $status)
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate($items_per_page);

        return view('testimonies.index', compact('testimonies'));
    }

    public function show(string $uuid)
    {
        $testimony = $this->getTestimony($uuid);

        return view('testimonies.show', compact('testimony'));
    }

    private function getTestimony(string $uuid): Testimony
    {
        $testimony = Testimony::where('uuid', $uuid)->firstOrFail();

        if ($testimony->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return $testimony;
    }
}
