@extends('layout.main')
@section('content');
<form action="{{ route("login.store") }}" method="post">
@csrf
<label for="email" >email</label>
<input type="email" name="email" id= "email">
<label for="password">password</label>
<input type="password" name="password" id="password">
<button type="submit">login</button>
</form>

@endsection