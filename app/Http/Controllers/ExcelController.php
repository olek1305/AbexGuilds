<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Revolution\Google\Sheets\Facades\Sheets;

class ExcelController extends Controller
{
    public function index(): Response
    {
        $spreadsheetId = env('SPREADSHEET_ID');
        return Inertia::render('Excel/Index', [
            'sheetID' => $spreadsheetId
        ]);
    }

    //Reading from Excel for rendering on the web
    public function show($sheetName)
    {
        $spreadsheetId = env('SPREADSHEET_ID');

        $sheet = Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->get();
        $header = $sheet->pull(0);
        $data = $sheet->all();

        array_shift($data);

        return Inertia::render('Excel/Show', [
            'nameColumns' => $header,
            'data_sheets' => $data
        ]);
    }

    //Copy Users from database for rendering on the excel
    public function store(Request $request)
    {
        $spreadsheetId = env('SPREADSHEET_ID');
        $sheetName = $request->input('sheetName');
        Sheets::spreadsheet($spreadsheetId)->addSheet($sheetName);

        $users = User::with('PlayerSeasons')->get();

        $rows = [];
        foreach ($users as $user) {
            foreach ($user->playerSeasons as $playerSeason) {
                $guildName = $playerSeason->guild->name;
                $rows[] = [
                    'user_name' => $user->name,
                    'damage' => $playerSeason->damage,
                    'guild' => $guildName
                ];
            }
        }

        $headers = ['user_name', 'damage', 'guild'];
        Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->append([$headers]);

        $data = Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->append($rows);
        return Inertia::location('/excel');
    }
}
