<?php

namespace App\Http\Controllers;

class BackofficeController extends Controller
{
    public function showBackofficeView() {
        return view('backoffice/home_backoffice');
    }
}
