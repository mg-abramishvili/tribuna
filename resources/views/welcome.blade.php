<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tribuna</title>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/MooTools-Core-1.6.0.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/flickity.css') }}">
    <script src="{{ asset('js/flickity.pkgd.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/flickity-fade.css') }}">
    <script src="{{ asset('js/flickity-fade.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="slider" id="slider">
            @foreach($slides as $slide)
                <div id="slide{{$slide->id}}" class="slide slide{{$slide->id}}" data-duration="10000">
                    <div class="slide-inner">

                        @foreach($slide->types as $type)
                            @if ($type->id == '1')
                                <p id="reppl" style="font-size: 50px; text-align: center; font-weight: bold;">{!! $slide->text !!}</p>
                                
                            @elseif ($type->id == '2')
                                <img src="{{ $slide->logo }}" style="width:90%; display: block; margin: 0 auto;">
                            @elseif ($type->id == '3')
                                <img src="{{ $slide->image }}" style="width:100%;">
                            @elseif ($type->id == '4')
                                <video nocontrols id="videoid{{ $slide->id }}" autoplay muted loop style="width:100%;">
                                    <source src="{{ $slide->video }}" type="video/mp4" />
                                </video>
                                <script>
                                    var myVideoPlayer = document.getElementById('videoid{{ $slide->id }}'),
                                        meta = document.getElementById('meta');

                                    myVideoPlayer.addEventListener('loadedmetadata', function () {
                                        var duration = myVideoPlayer.duration.toFixed(0) * 1000;
                                        //alert(duration.toFixed(0) * 1000);
                                        document.getElementById('slide{{$slide->id}}').setAttribute('data-duration', duration);
                                    });
                                </script>
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
        autoPlay: false,
        fade: true,
        imagesLoaded: true,
        wrapAround: true
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

    <script>
    @foreach ($slides as $slide)
        var myVar;

        var elemToObserve = document.getElementById('slide{{ $slide->id }}');
        var prevClassState = elemToObserve.classList.contains('is-selected');
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if(mutation.attributeName == "class"){
                    var currentClassState = mutation.target.classList.contains('is-selected');
                    if(prevClassState !== currentClassState)    {
                        prevClassState = currentClassState;
                        if(currentClassState) {
                            clearTimeout(myVar);
                            @if($loop->last)
                                setTimeout(function(){ document.getElementById("slide{{ $slide->id }}").style.opacity = "0"; location.reload(); }, document.getElementById('slide{{ $slide->id }}').getAttribute('data-duration'));
                            @else
                                myVar = setTimeout(function(){ flkty.next(true); }, document.getElementById('slide{{ $slide->id }}').getAttribute('data-duration'));
                            @endif
                            console.log("{{ $slide->id }} active!");
                            if (document.getElementById("videoid{{ $slide->id }}")) {
                                var vid = document.getElementById("videoid{{ $slide->id }}");
                                vid.currentTime = 0;
                            }
                        } else {
                            //console.log("2 not active!");
                        }
                    }
                }
            });
        });
        observer.observe(elemToObserve, {attributes: true});
    
    @endforeach
    </script>
    
</body>
</html>