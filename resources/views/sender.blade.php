<form action="/sender" method="post">
{{ csrf_field() }}
    <input type="text" name="message">
    <input type="submit" value="Send">
</form>