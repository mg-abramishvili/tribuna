@foreach(\App\Models\Slide::all() as $slide)
<form action="/sender" method="post">
{{ csrf_field() }}
    {{ $slide->title }}
    <input type="hidden" name="message" value="{{ $slide->id }}">
    <input type="submit" value="Пуск">
</form>
@endforeach