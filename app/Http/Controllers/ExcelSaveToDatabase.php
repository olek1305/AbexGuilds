<?php

namespace App\Http\Controllers;

use App\Models\PlayerSeason;
use App\Models\User;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class ExcelSaveToDatabase extends Controller
{
    //Copies data from excel to database
    public function store(Request $request)
    {
        $request->validate([
            'sheetName' => 'required|string'
        ]);

        $spreadsheetId = env('SPREADSHEET_ID');
        $sheetName = $request->input('sheetName');

        $rows = Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->get();

        $header = $rows->pull(0);
        $values = Sheets::collection(header: $header, rows: $rows);

        $countPlayers = 0;
        $countErrors = 0;

        foreach ($values as $item) {
            $user = User::where('name', $item['name'] ?? null)->first();
            if (!$user) {
                $countErrors++;
                logger('User not found for name: ' . ($item['name'] ?? ''));
                continue;
            }

            $playerSeason = new PlayerSeason();
            $playerSeason->player_id = $user->id;

            $playerSeason->damage = $item['damage'] ?? null;
            $playerSeason->season = $item['season'] ?? null;
            $playerSeason->is_observer = $item['is_observer'] ?? false;
            $playerSeason->is_star = $item['is_star'] ?? false;
            $playerSeason->guild_id = $item['guild_id'] ?? null;

            if ($playerSeason->save()) {
                $countPlayers++;
            } else {
                logger('Error saving player season: ' . print_r($playerSeason->errors(), true));
            }
        }
        $errorMessage = ($countErrors > 2) ? 'Brak użytkownika, nie ma graczy.' : '';

        return redirect()->route('excel.index')
            ->with(
                'success', 'Dane zostały pobrane z Sheet: ' . $sheetName . ',' . ' w sumie ' . $countPlayers . ' graczy trafiło do bazy danych.
                Łącznie: ' . $countErrors . ' graczy nie powiodło się. ' . $errorMessage
        );
    }
}
