<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function index()
    {
        $redirectTo = auth()->id() ? 'orders.index' : 'orders.create';

        return redirect()->route($redirectTo);
    }
}
