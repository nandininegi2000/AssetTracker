@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container-fluid">
@foreach($img as $pic)
<img src="{{asset('/files/'.$pic->image)}}" width="150" height="150">
@endforeach
</div>
</div>
@stop