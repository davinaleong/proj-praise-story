<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestimonyExportController extends Controller
{
    public function export()
    {
        // Fetch all testimonies (adjust columns if needed)
        $testimonies = DB::table('testimonies')->get();

        $fileName = 'testimonies_export_' . now()->format('Y_m_d_His') . '.csv';

        return response()->streamDownload(function () use ($testimonies) {
            $handle = fopen('php://output', 'w');

            if ($testimonies->isNotEmpty()) {
                // First row → headers
                fputcsv($handle, array_keys((array) $testimonies->first()));

                // Loop rows
                foreach ($testimonies as $row) {
                    fputcsv($handle, (array) $row);
                }
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
