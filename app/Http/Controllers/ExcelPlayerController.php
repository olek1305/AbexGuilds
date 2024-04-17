<?php

namespace App\Http\Controllers;

use App\Models\PlayerSeason;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class ExcelPlayerController extends Controller
{
    //Copy Players with season from database for rendering on the excel
    public function store(Request $request)
    {
        $request->validate([
            'sheetName' => 'required|string',
            'id_season' => 'required|numeric'
        ]);

        $spreadsheetId = env('SPREADSHEET_ID');
        $sheetName = $request->input('sheetName');
        $season = $request->input('id_season');

        Sheets::spreadsheet($spreadsheetId)->addSheet($sheetName);

        $players = PlayerSeason::with('user')->where('season', $season)->get();
        $countPlayers = 0;

        $rows = [];
        foreach ($players as $player) {
            if ($player->season == $season) {
                $countPlayers++;
                $rows[] = [
                    'id' => $player->user->id,
                    'user_name' => $player->user->name,
                    'damage' => $player->damage,
                    'guild' => $player->guild->name,
                    'is_observer' => $player->is_observer,
                    'is_star' => $player->is_star,
                    'season' => $player->season
                ];
            }
        }

        $headers = ['id', 'user_name', 'damage', 'guild', 'is_observer', 'is_star', 'season'];
        Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->append([$headers]);

        $data = Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->append($rows);
        return redirect()->route('excel.index')
            ->with(
                'success', 'Dane zostały pobrane z bazy danych do sheet: ' . $sheetName . ',' . ' w sumie ' . $countPlayers . ' players trafiło do excela.'
            );
    }
}
