<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tribuna</title>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/flickity.css') }}">
    <script src="{{ asset('js/flickity.pkgd.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/flickity-fade.css') }}">
    <script src="{{ asset('js/flickity-fade.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="slider">
            @foreach($slides as $slide)
                <div class="slide slide{{$slide->id}}">
                    <div class="slide-inner">

                        @foreach($slide->types as $type)
                            @if ($type->id == '1')
                                {!! $slide->text !!}
                            @elseif ($type->id == '2')
                                <img src="{{ $slide->logo }}" style="width:90%; display: block; margin: 0 auto;">
                            @elseif ($type->id == '3')
                                <img src="{{ $slide->image }}" style="width:100%;">
                            @elseif ($type->id == '4')
                                <video nocontrols autoplay muted loop style="width:100%;">
                                    <source src="{{ $slide->video }}" type="video/mp4" />
                                </video>
                            @endif
                        @endforeach
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="red" style="width: 100px; height: 100px;"></div>

    <script src="js/app.js"></script>

    <script>
    var flkty = new Flickity( '.slider', {
        autoPlay: 10000,
        fade: true,
        imagesLoaded: true
    });

    window.Echo.channel('my-channel')
        .listen('FormSubmitted', (e) => {
        var theDiv = document.getElementById("red");
        var content = document.createTextNode(e.message);
        theDiv.appendChild(content);
        
        flkty.selectCell('.slide' + e.message);
        });
    </script>

    <script>
    window.Echo.channel('my-channel-refresh')
        .listen('FormSubmittedRefresh', (e) => {
            location.reload();
        });
    </script>
</body>
</html>