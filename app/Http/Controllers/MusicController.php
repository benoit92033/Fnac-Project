<?php

namespace App\Http\Controllers;

use App\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function all() {
        return view("musics", ['musics'=>Music::all() ]);
    }
}
