@extends('layouts.layout')
@section('content')
<div style="position:absolute;top:30px;left:100px">
    <h1>
    Welcome {{$_SESSION['username']}} to the page!
    </h1>
</div>
@endsection