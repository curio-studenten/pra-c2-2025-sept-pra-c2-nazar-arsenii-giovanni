<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function store(Request $request)
    {
        $data = [
            'Naam' => $request->name,
            'E-mailadres' => $request->email,
            'Bericht' => $request->message,
            'Datum' => now()->toDateTimeString(),
        ];

        $txt = "e";
        foreach ($data as $key => $value) {
            $txt .= "$key: $value\n";
        }
        $txt .= "--------------------------\n";

        file_put_contents(storage_path('app/contactform.txt'), $txt, FILE_APPEND);

        return back();
    }
}