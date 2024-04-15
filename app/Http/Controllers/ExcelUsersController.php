<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sheetName' => 'required|string',
            'columnName' => 'required|string'
        ]);

        $spreadsheetId = env('SPREADSHEET_ID');
        $sheetName = $request->input('sheetName');
        $columnName = $request->input('columnName');

        $rows = Sheets::spreadsheet($spreadsheetId)->sheet($sheetName)->get();

        $header = $rows->pull(0);
        $values = Sheets::collection(header: $header, rows: $rows);

        $userNames = [];
        foreach ($values as $item) {
            if (isset($item[$columnName])) {
                $userNames[] = $item[$columnName];
            } else {
                logger("Klucz " . $columnName . " nie istnieje w wierszu.");
            }
        }

        $countUsers = 0;
        $countErrors = 0;

        foreach ($userNames as $userName) {
            if ($userName) {
                if (!User::where('name', $userName)->exists()) {
                    $newUser = new User();
                    $newUser->name = $userName;
                    $randomPassword = Str::random(10);
                    $newUser->password = Hash::make($randomPassword);
                    $newUser->save();
                    $countUsers++;
                } else {
                    $countErrors++;
                }
            }
        }

        return redirect()->route('excel.index')
            ->with(
                'success', 'Dane zostały pobrane z Sheet: ' . $sheetName . ',' . ' w sumie ' . $countUsers . ' users trafiło do bazy danych.
                Łącznie: ' . $countErrors . ' graczy nie powiodło się.'
            );
    }
}
