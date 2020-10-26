<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class SlideController extends Controller
{
    public function index() {
        $slides = Slide::all();
        return view('welcome', compact('slides'));
    }
}
