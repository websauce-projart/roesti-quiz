<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;

class BackofficeController extends Controller
{
    public function showBackofficeView() {
        return view('backoffice/home_backoffice');
    }

    public function displayAddAdminView() {
        dd('create');
    }

    public function createAdmin(Request $request) {
        dd('store');
    }

    public function indexAdmin() {
        dd('index');
    }

    public function editAdmin($user_id) {
        dd('edit');
    }

    public function updateAdmin(UserUpdateRequest $request, $id) {
        dd('update');
    }
}
