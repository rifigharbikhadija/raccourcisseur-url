<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $links = Link::where('user_id', auth()->id())->withCount('visitors')->paginate(10);

        return view('user.dashboard', compact('links'));
    }
}
