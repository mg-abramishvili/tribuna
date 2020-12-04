<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Type;

class FrontController extends Controller
{
    public function index() {
        $slides = Slide::with('types')->get();
        return view('welcome', compact('slides'));
    }
}
