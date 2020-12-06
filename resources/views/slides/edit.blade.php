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
                    @if ($errors->has('title'))
                        <div class="alert alert-danger">
                            Укажите название слайда
                        </div>
                    @endif
                </dd>
            </div>

            <div class="row align-items-center mb-2 block-text">
                <dt class="col-sm-3">
                    Текст
                </dt>
                <dd class="col-sm-9">
                    <textarea rows="4" type="text" id="text" onkeyup="myFunction()" class="form-control" name="text">{{$slides->text}}</textarea>
                    
                    <div class="veteran-list-keyboard">
                <div class="keyboard" style="margin-top: 20px;">

    <style>
        .keyboard button {
            width: 50px;
            height: 50px;
            border: 2px solid #ccc;
            box-shadow: none;
            text-align: center;
            line-height: 50px;
            margin-bottom: 5px;
        }
    </style>

                    <div style="text-align: center;">
                        <div class="k-eng">
                        <!--<button value="1" id="v28">1</button>
                        <button value="2" id="v29">2</button>
                        <button value="3" id="v30">3</button>
                        <button value="4" id="v31">4</button>
                        <button value="5" id="v32">5</button>
                        <button value="6" id="v33">6</button>
                        <button value="7" id="v34">7</button>
                        <button value="8" id="v35">8</button>
                        <button value="9" id="v36">9</button>
                        <button value="0" id="v37">0</button>
                        <button value="@" id="v41">@</button>
                        <br>-->
                        <button value="Q" id="v18">Q</button>
                        <button value="W" id="v24">W</button>
                        <button value="E" id="v5">E</button>
                        <button value="R" id="v19">R</button>
                        <button value="T" id="v21">T</button>
                        <button value="Y" id="v26">Y</button>
                        <button value="U" id="v22">U</button>
                        <button value="I" id="v9">I</button>
                        <button value="O" id="v16">O</button>
                        <button value="P" id="v17">P</button>
                        <br>
                        <button value="A" id="v1">A</button>
                        <button value="S" id="v20">S</button>
                        <button value="D" id="v4">D</button>
                        <button value="F" id="v6">F</button>
                        <button value="G" id="v7">G</button>
                        <button value="H" id="v8">H</button>
                        <button value="J" id="v10">J</button>
                        <button value="K" id="v11">K</button>
                        <button value="L" id="v13">L</button>
                        <br>
                        <button value="Z" id="v27">Z</button>
                        <button value="X" id="v25">X</button>
                        <button value="C" id="v3">C</button>
                        <button value="V" id="v23">V</button>
                        <button value="B" id="v2">B</button>
                        <button value="N" id="v15">N</button>
                        <button value="M" id="v14">M</button>
                        
                        <br>
                    </div>
                    <div class="k-rus">
                        <button value="Й" id="rv01">Й</button>
                        <button value="Ц" id="rv02">Ц</button>
                        <button value="У" id="rv03">У</button>
                        <button value="К" id="rv04">К</button>
                        <button value="Е" id="rv05">Е</button>
                        <button value="Н" id="rv06">Н</button>
                        <button value="Г" id="rv07">Г</button>
                        <button value="Ш" id="rv08">Ш</button>
                        <button value="Щ" id="rv09">Щ</button>
                        <button value="З" id="rv10">З</button>
                        <button value="Х" id="rv11">Х</button>
                        <button value="Ъ" id="rv12">Ъ</button>
                        <br>
                        <button value="Ф" id="rv13">Ф</button>
                        <button value="Ы" id="rv14">Ы</button>
                        <button value="В" id="rv15">В</button>
                        <button value="А" id="rv16">А</button>
                        <button value="П" id="rv17">П</button>
                        <button value="Р" id="rv18">Р</button>
                        <button value="О" id="rv19">О</button>
                        <button value="Л" id="rv20">Л</button>
                        <button value="Д" id="rv21">Д</button>
                        <button value="Ж" id="rv22">Ж</button>
                        <button value="Э" id="rv23">Э</button>
                        <br>
                        <button value="Я" id="rv24">Я</button>
                        <button value="Ч" id="rv25">Ч</button>
                        <button value="С" id="rv26">С</button>
                        <button value="М" id="rv27">М</button>
                        <button value="И" id="rv28">И</button>
                        <button value="Т" id="rv29">Т</button>
                        <button value="Ь" id="rv30">Ь</button>
                        <button value="Б" id="rv31">Б</button>
                        <button value="Ю" id="rv32">Ю</button>
                        <br>
                    </div>
                        
                        <button value="." id="v38">.</button>
                        <button value="-" id="v39">-</button>
                        <button value=" " id="v40">_</button>
                        <button value="<br>" id="v41" style="width: 80px;">ENTER</button>
                        <button class="globebutton" style="width: 100px;">RU/EN</button>
                        <button value="" id="backspace">&#x2190</button>
                        <button value="" id="clear">&times;</button>
                    </div>
                </div>
            </div>
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


    <script>/*
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
      });*/
    </script>


<script> // КЛАВИАТУРА
    $(document).ready(function(){
    $('#v1,#v2,#v3,#v4,#v5,#v6,#v7,#v8,#v9,#v10,#v11,#v12,#v13,#v14,#v15,#v16,#v17,#v18,#v19,#v20,#v21,#v22,#v23,#v24,#v25,#v26,#v27,#v28,#v29,#v30,#v31,#v32,#v33,#v34,#v35,#v36,#v37,#v38,#v39,#v40,#v41,#rv01,#rv02,#rv03,#rv04,#rv05,#rv06,#rv07,#rv08,#rv09,#rv10,#rv11,#rv12,#rv13,#rv14,#rv15,#rv16,#rv17,#rv18,#rv19,#rv20,#rv21,#rv22,#rv23,#rv24,#rv25,#rv26,#rv27,#rv28,#rv29,#rv30,#rv31,#rv32,#rv33,#rv34,#rv35,#rv36,#rv37,#rv38,#rv39,#rv40,#rv41').click(function(){
        event.preventDefault();
         var v = $(this).val();
        var total = $('#text').val($('#text').val() + v);
     });
   $('#clear').click(function(){
    event.preventDefault();
       $('#text').val('');
       
     });
   $('#backspace').click(function(){
    event.preventDefault();
       $('#text').val($('#text').val().substring(0, $('#text').val().length - 1));
       
     });
 });
</script>

<script> // ПЕРЕКЛЮЧЕНИЕ КЛАВИАТУРЫ
$('.k-eng').hide();
$('.globebutton').on('click',
function()
{
    event.preventDefault();
    $('.k-rus, .k-eng').toggle()
}
);
</script>
@endsection