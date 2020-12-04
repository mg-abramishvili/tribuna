@extends('layouts.app')
@section('content')

    <div class="container py-4">
        <div class="row align-items-center mb-4">
            <div class="col-6">
                <h1>{{$slides->title}}</h1>
            </div>
        </div>

        <form class="page" action="/slides/{{$slides->id}}" method="post" enctype="multipart/form-data">@csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$slides->id}}">

            <div class="row align-items-center mb-2">
                <dt class="col-sm-3">
                    Тип слайда
                </dt>
                <dd class="col-sm-9">
                <div class="row">
                    @foreach($types as $type)
                        <div class="col-3">
                        <div class="radio">
                        <input name="types" id="{{ $type->id }}" type="radio" @foreach($slides->types as $t)@if($type->id == $t->id)checked @endif @endforeach value="{{ $type->id }}">
                        <label for="{{ $type->id }}">
                            {{ $type->title }}
                        </label>
                        </div>
                        </div>
                    @endforeach
                    </div>   
                </dd>
            </div>

            <div class="row align-items-center mb-2">    
                <dt class="col-sm-3">
                    Название слайда
                </dt>
                <dd class="col-sm-9">
                    <input type="text" class="form-control" id="exampleFormControlInput1"  name="title" value="{{$slides->title}}">
                </dd>
            </div>

            <div class="row align-items-center mb-2 block-text">
                <dt class="col-sm-3">
                    Текст
                </dt>
                <dd class="col-sm-9">
                    <textarea rows="7" type="text" id="text" class="form-control" name="text">{{$slides->text}}</textarea>
                    @if ($errors->has('title'))
                        <div class="alert alert-danger">
                            Укажите название слайда
                        </div>
                    @endif
                </dd>
            </div>

            <div class="row align-items-center mb-2 block-image">
                <dt class="col-sm-3">
                    Картинка
                </dt>
                <dd class="col-sm-9">
                    <input class="image" type="file" name="image" x-ref="image">
                    Формат JPG, JPEG, PNG!
                </dd>
            </div>

            <div class="row align-items-center mb-2 block-logo">
                <dt class="col-sm-3">
                    Логотип
                </dt>
                <dd class="col-sm-9">
                    <input class="logo" type="file" name="logo" x-ref="logo">
                    Формат JPG, JPEG, PNG!
                </dd>
            </div>

            <div class="row align-items-center mb-2 block-video">
                <dt class="col-sm-3">
                    Видео
                </dt>
                <dd class="col-sm-9">
                    <input class="video" type="file" name="video" x-ref="video">
                    Формат MP4, макс. размер 100Мб!
                </dd>
            </div>

            <button type="submit" class="btn btn-lg btn-success">Сохранить</button>
            <a href="/slides/" class="btn btn-lg btn-secondary">Назад</a>
        </form>
    </div>

    <script>
        $( document ).ready(function() {
            setInterval(function()  {
                if($('#1').is(':checked')) {
                    $('.block-logo').hide();
                    $('.block-video').hide();
                    $('.block-image').hide();
                    $('.block-text').show();
                }
                if($('#2').is(':checked')) {
                    $('.block-text').hide();
                    $('.block-video').hide();
                    $('.block-image').hide();
                    $('.block-logo').show();
                }
                if($('#3').is(':checked')) {
                    $('.block-text').hide();
                    $('.block-logo').hide();
                    $('.block-video').hide();
                    $('.block-image').show();
                }
                if($('#4').is(':checked')) {
                    $('.block-text').hide();
                    $('.block-logo').hide();
                    $('.block-image').hide();
                    $('.block-video').show();
                }
            }, 100);
        });
    </script>

    @if(!empty($slides->image))
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        $('.image').filepond({
            allowMultiple: false,
            allowReorder: false,
            imagePreviewHeight: 140,
            labelIdle: 'Нажмите для загрузки файлов',
            labelFileProcessing: 'Загрузка',
            labelFileProcessingComplete: 'Загружено',
            labelTapToCancel: '',
            labelTapToUndo: '',

            server: {
                remove: (filename, load) => {
                    load('1');
                    return  ajax_delete('deleteimage');
                },
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    const request = new XMLHttpRequest();
                    request.open('POST', '/slides/file/upload');
                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };
                    request.onload = function() {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                        }
                        else {
                            error('oh no');
                        }
                    };
                    request.send(formData);
                    return {
                        abort: () => {
                            request.abort();
                            abort();
                        }
                    };
                },
                revert: (filename, load) => {
                    load(filename)
                },
                load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                },
            },

            files: [
                {
                    source: '{{ $slides->image }}',
                    options: {
                        type: 'local',
                    }
                }
            ]

        });

        function ajax_delete(methos){
            $.ajax({
               url:'/slides/file/'+methos,
                method:'POST'
            });
        }
    </script>
    @else
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);

        $('.image').filepond({
            allowMultiple: false,
            allowReorder: false,
            imagePreviewHeight: 140,
            labelIdle: 'Нажмите для загрузки файлов',
            labelFileProcessing: 'Загрузка',
            labelFileProcessingComplete: 'Загружено',
            labelTapToCancel: '',
            labelTapToUndo: '',

            server: {
                remove: (filename, load) => {
                    load('1');
                    return  ajax_delete('deleteimage');

                },
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    const request = new XMLHttpRequest();
                    request.open('POST', '/slides/file/upload');
                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };
                    request.onload = function() {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                        }
                        else {
                            error('oh no');
                        }
                    };
                    request.send(formData);
                    return {
                        abort: () => {
                            request.abort();
                            abort();
                        }
                    };
                },
                revert: (filename, load) => {
                    load(filename)
                },
                load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                },
            },
        });

        function ajax_delete(methos){
            $.ajax({
                url:'/slides/file/'+methos,
                method:'POST'
            });
        }
    </script>
    @endif






    @if(!empty($slides->logo))
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        $('.logo').filepond({
            allowMultiple: false,
            allowReorder: false,
            imagePreviewHeight: 140,
            labelIdle: 'Нажмите для загрузки файлов',
            labelFileProcessing: 'Загрузка',
            labelFileProcessingComplete: 'Загружено',
            labelTapToCancel: '',
            labelTapToUndo: '',

            server: {
                remove: (filename, load) => {
                    load('1');
                    return  ajax_delete('deletelogo');
                },
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    const request = new XMLHttpRequest();
                    request.open('POST', '/slides/file/upload');
                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };
                    request.onload = function() {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                        }
                        else {
                            error('oh no');
                        }
                    };
                    request.send(formData);
                    return {
                        abort: () => {
                            request.abort();
                            abort();
                        }
                    };
                },
                revert: (filename, load) => {
                    load(filename)
                },
                load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                },
            },

            files: [
                {
                    source: '{{ $slides->logo }}',
                    options: {
                        type: 'local',
                    }
                }
            ]

        });

        function ajax_delete(methos){
            $.ajax({
               url:'/slides/file/'+methos,
                method:'POST'
            });
        }
    </script>
    @else
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);

        $('.logo').filepond({
            allowMultiple: false,
            allowReorder: false,
            imagePreviewHeight: 140,
            labelIdle: 'Нажмите для загрузки файлов',
            labelFileProcessing: 'Загрузка',
            labelFileProcessingComplete: 'Загружено',
            labelTapToCancel: '',
            labelTapToUndo: '',

            server: {
                remove: (filename, load) => {
                    load('1');
                    return  ajax_delete('deletelogo');

                },
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    const request = new XMLHttpRequest();
                    request.open('POST', '/slides/file/upload');
                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };
                    request.onload = function() {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                        }
                        else {
                            error('oh no');
                        }
                    };
                    request.send(formData);
                    return {
                        abort: () => {
                            request.abort();
                            abort();
                        }
                    };
                },
                revert: (filename, load) => {
                    load(filename)
                },
                load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                },
            },
        });

        function ajax_delete(methos){
            $.ajax({
                url:'/slides/file/'+methos,
                method:'POST'
            });
        }
    </script>
    @endif





    @if(!empty($slides->video))
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        $('.video').filepond({
            allowMultiple: false,
            allowReorder: false,
            imagePreviewHeight: 140,
            labelIdle: 'Нажмите для загрузки файлов',
            labelFileProcessing: 'Загрузка',
            labelFileProcessingComplete: 'Загружено',
            labelTapToCancel: '',
            labelTapToUndo: '',

            server: {
                remove: (filename, load) => {
                    load('1');
                    return  ajax_delete('deletevideo');
                },
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    const request = new XMLHttpRequest();
                    request.open('POST', '/slides/file/upload');
                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };
                    request.onload = function() {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                        }
                        else {
                            error('oh no');
                        }
                    };
                    request.send(formData);
                    return {
                        abort: () => {
                            request.abort();
                            abort();
                        }
                    };
                },
                revert: (filename, load) => {
                    load(filename)
                },
                load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                },
            },

            files: [
                {
                    source: '{{ $slides->video }}',
                    options: {
                        type: 'local',
                    }
                }
            ]

        });

        function ajax_delete(methos){
            $.ajax({
               url:'/slides/file/'+methos,
                method:'POST'
            });
        }
    </script>
    @else
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);

        $('.video').filepond({
            allowMultiple: false,
            allowReorder: false,
            imagePreviewHeight: 140,
            labelIdle: 'Нажмите для загрузки файлов',
            labelFileProcessing: 'Загрузка',
            labelFileProcessingComplete: 'Загружено',
            labelTapToCancel: '',
            labelTapToUndo: '',

            server: {
                remove: (filename, load) => {
                    load('1');
                    return  ajax_delete('deletevideo');

                },
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    const request = new XMLHttpRequest();
                    request.open('POST', '/slides/file/upload');
                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };
                    request.onload = function() {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                        }
                        else {
                            error('oh no');
                        }
                    };
                    request.send(formData);
                    return {
                        abort: () => {
                            request.abort();
                            abort();
                        }
                    };
                },
                revert: (filename, load) => {
                    load(filename)
                },
                load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                },
            },
        });

        function ajax_delete(methos){
            $.ajax({
                url:'/slides/file/'+methos,
                method:'POST'
            });
        }
    </script>
    @endif


    <script>
      $('#text').summernote({
        height: 300,
        toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['height', ['height']]
  ]
      });
    </script>

@endsection