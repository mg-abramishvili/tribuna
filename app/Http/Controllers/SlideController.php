<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::get();
        return view('slides.index', compact('slides'));
    }

    public function create()
    {
        return view('slides.create');
    }

    public function edit($id)
    {
        $slides = Slide::find($id);
        return view('slides.edit', compact('slides'));
    }

    public function file($type)
    {
        switch ($type) {
            case 'upload':
                return $this->upload();
        }

        return \Response::make('success', 200, [
            'Content-Disposition' => 'inline',
        ]);
    }

    public function upload()
    {
        if (request()->file('image')) {
            $file = request()->file('image');

            $filename = md5(time() . rand(1, 100000)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads', $filename);

            return \Response::make('/uploads/' . $filename, 200, [
                'Content-Disposition' => 'inline',
            ]);

        }
    }

    public function delete($id)
    {
        $slides = Slide::find($id);
        $slides->delete();
        return redirect('/slides');
    }

    public function store()
    {
        $data = request()->all();
        $slides = new Slide();
        $slides->title = $data['title'];
        $slides->text = $data['text'];
        $slides->image = $data['image'];
        $slides->save();
        return redirect('/slides');
    }

    public function update()
    {
        $data = request()->all();
        $slides = Slide::find($data['id']);
        $slides->title = $data['title'];
        $slides->text = $data['text'];
        $slides->image = $data['image'];
        $slides->save();
        return redirect('/slides');
    }
}
