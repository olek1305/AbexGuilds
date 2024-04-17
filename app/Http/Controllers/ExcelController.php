<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
    public function show($sheetName): Response
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

    //Copy Users from database for rendering on the Excel
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sheetName' => 'required|string'
        ]);

        $spreadsheetId = env('SPREADSHEET_ID');
        $sheetName = $request->input('sheetName');
        Sheets::spreadsheet($spreadsheetId)->addSheet($sheetName);

        $users = User::with('PlayerSeasons')->get();
        $countUsers = 0;

        $rows = [];
        foreach ($users as $user) {
            foreach ($user->playerSeasons as $playerSeason) {
                $guildName = $playerSeason->guild->name;
                $countUsers++;
                $rows[] = [
                    'id' => $user->id,
                    'user_name' => $user->name,
                    'damage' => $playerSeason->damage,
                    'guild' => $guildName,
                    'is_observer' => $playerSeason->is_observer,
                    'is_star' => $playerSeason->is_star,
                    'season' => $playerSeason->season
                ];
            }
        }

        $headers = ['id', 'user_name', 'damage', 'guild', 'is_observer', 'is_star', 'season'];
        Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->append([$headers]);

        Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->append($rows);
        return redirect()->route('excel.index')
            ->with(
                'success', 'Dane zostały pobrane z bazy danych do sheet: ' . $sheetName . ',' . ' w sumie ' . $countUsers . ' users trafiło do excela.'
            );
    }
}
