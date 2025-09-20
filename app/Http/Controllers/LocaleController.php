<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function changeLocale($language_slug)
{
    if (in_array($language_slug, ['en', 'nl'])) {
        session(['locale' => $language_slug]);
    }

    // Redirect to the page we came from, or homepage as fallback
    $redirect = request()->get('redirect', url()->previous());

    return redirect($redirect);


    }
    /* public function changeLocale(Request $request)
    {

        $this->validate($request, ['locale' => 'required|in:nl,en']);

        \Session::put('locale', $request->locale);

        return redirect()->back();
    } */
}
