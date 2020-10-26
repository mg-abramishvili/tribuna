<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Pusher Test</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
  .gray {
    background-color: gray;
  }
</style>
</head>
<body>

  <ul>
    @foreach($slides as $slide)
    <li>
      <h2>{{ $slide->title }}</h2>
      {{ $slide->text }}
    </li>
    @endforeach
  </ul>
  
  <div id="red" style="width: 100px; height: 100px;"></div>

  <script src="js/app.js"></script>

  <script>

    window.Echo.channel('my-channel')
    .listen('FormSubmitted', (e) => {
      document.getElementById("red").setAttribute("id", e.message);
      var element = document.getElementById(e.message);
      element.classList.add(e.message);
    });
  </script>
</body>
</html>