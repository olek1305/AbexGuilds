<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Revolution\Google\Sheets\Facades\Sheets;

class ExcelUsersController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Excel/Create');
    }

    //Copying users from Excel to save in the database
    public function store(Request $request)
    {
        $spreadsheetId = env('SPREADSHEET_ID');
        $sheetName = $request->input('sheetName');
        $columnName = $request->input('columnName');

        $rows = Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->get();

        $header = $rows->pull(0);
        $values = Sheets::collection(header: $header, rows: $rows);

        $userNames = [];
        foreach ($values as $item) {
            if (isset($item['user'])) {
                $userNames[] = $item['user'];
            } else {
                logger('Klucz "user" nie istnieje w wierszu.');
            }
        }

        foreach ($userNames as $userName) {
            if ($userName) {
                if (!User::where('name', $userName)->exists()) {
                    $newUser = new User();
                    $newUser->name = $userName;
                    $randomPassword = Str::random(10);
                    $newUser->password = Hash::make($randomPassword);
                    $newUser->save();
                }
            }
        }


        return Inertia::location('/excel');
    }
}
