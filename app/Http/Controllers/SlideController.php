<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Type;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::get();
        return view('slides.index', compact('slides'));
    }

    public function create()
    {
        $types = Type::all();
        return view('slides.create', compact('types'));
    }

    public function edit($id)
    {
        $slides = Slide::find($id);
        $types = Type::all();
        return view('slides.edit', compact('slides', 'types'));
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

        if (request()->file('logo')) {
            $file = request()->file('logo');

            $filename = md5(time() . rand(1, 100000)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads', $filename);

            return \Response::make('/uploads/' . $filename, 200, [
                'Content-Disposition' => 'inline',
            ]);
        }

        if (request()->file('video')) {
            $file = request()->file('video');

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
        $slides->types()->detach();
        return redirect('/slides');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
        ]);

        $data = request()->all();
        $slides = new Slide();
        $slides->title = $data['title'];
        if (!empty($data['text'])) {
            $slides->text = $data['text'];
        }
        if (!empty($data['logo'])) {
            $slides->logo = $data['logo'];
        }
        if (!empty($data['video'])) {
            $slides->video = $data['video'];
        }
        if (!empty($data['image'])) {
            $slides->image = $data['image'];
        }
        $slides->save();
        $slides->types()->attach($request->types, ['slide_id' => $slides->id]);
        return redirect('/slides');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $data = request()->all();
        $slides = Slide::find($data['id']);
        $slides->title = $data['title'];
        if (!empty($data['text'])) {
            $slides->text = $data['text'];
        }
        if (!empty($data['logo'])) {
            $slides->logo = $data['logo'];
        }
        if (!empty($data['video'])) {
            $slides->video = $data['video'];
        }
        if (!empty($data['image'])) {
            $slides->image = $data['image'];
        }
        $slides->save();
        $slides->types()->detach();
        $slides->types()->attach($request->types, ['slide_id' => $slides->id]);
        return redirect('/slides');
    }
}
