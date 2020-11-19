@extends('layouts.app')
@section('content')

    <div class="px-4 py-4">
        <div class="row align-items-center mb-4">
            <div class="col-6">
                <h1>Слайды</h1>
            </div>
            <div class="col-6" style="text-align: right;">
                <a href="/slides/create" class="btn btn-primary">Создать слайд</a>
            </div>
        </div>

        <div class="page">
        
            <table class="table table-bordered table-hover">
                @forelse($slides as $slide)
                <tr>
                    <td style="width: 135px;">
                        <img src="{{$slide->image}}" style="height: 60px; max-width: 130px;">
                    </td>
                    <td style="text-align: left; padding-left: 20px; padding-right: 20px;">
                        {{$slide->title}}
                    </td>
                    <td style="width: 200px;">
                        <a href="/slides/{{$slide->id}}/edit" class="btn btn-sm btn-warning">Правка</a>
                        <a href="/slides/delete/{{$slide->id}}" class="btn btn-sm btn-danger">Удалить</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td style="text-align: center;">
                        Пусто &#9785;
                    </td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
@endsection