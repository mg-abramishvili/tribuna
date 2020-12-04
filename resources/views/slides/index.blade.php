@extends('layouts.app')
@section('content')

    <div class="container py-4">
        <div class="row align-items-center mb-4">
            <div class="col-6">
                <h1>Слайды</h1>
            </div>
            <div class="col-6" style="text-align: right;">
                <a href="/slides/create" class="btn btn-lg btn-primary">Создать слайд</a>
                <form action="/refresh" method="post" style="display:inline-block; margin-left: 10px;">
                    <input type="hidden" name="msg" value="refresh">
                    <input type="submit" value="Обновить" class="btn btn-lg btn-success">
                </form>
            </div>
        </div>

        <div class="page">
        
            <table class="table table-bordered table-hover">
                @forelse($slides as $slide)
                <form action="/sender" method="post">
                <tr>
                    <td style="text-align: left; padding-left: 20px; padding-right: 20px;">
                        {{$slide->title}}
                    </td>
                    <td>     
                        <input type="hidden" name="message" value="{{ $slide->id }}">
                        <input type="submit" value="Пуск" class="btn btn-md btn-success">
                        <a href="/slides/{{$slide->id}}/edit" class="btn btn-md btn-warning">Правка</a>
                        <a href="/slides/delete/{{$slide->id}}" class="btn btn-md btn-danger">Удалить</a>
                    </td>
                </tr>
                </form>
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