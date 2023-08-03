<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ComicModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $data = [
            'comic' => count(ComicModel::all()),
            'user' => count(UsersModel::all())
        ];

        return view('admin.dashboard.dashboard', compact('data'));
    }
}
