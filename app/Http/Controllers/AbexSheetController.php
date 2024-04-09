<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Revolution\Google\Sheets\Facades\Sheets;

class AbexSheetController extends Controller
{
    public function index(Request $request)
    {

        $spreadsheetId = env('SPREADSHEET_ID', '');

        $user = $request->user();

        $sheet = Sheets::spreadsheet($spreadsheetId)->sheet('Test')->get();
        $header = $sheet->pull(0);
        $values = Sheets::collection($header, $sheet);
        $data_sheets = array_values($values->ToArray());

        return Inertia::render('Excel/Index', [
                'sheets' => $data_sheets
            ]);

    }
}
