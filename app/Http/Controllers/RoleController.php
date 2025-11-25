<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || $user->department !== 'Management') {
            abort(403, 'Toegang geweigerd. Alleen Management heeft toegang tot rollen beheer.');
        }

        return view('management.roles.index');
    }
}
