@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container-fluid">
<h1>Update Asset Type</h1>
<form action="{{url('edit')}}" method="post">
    @csrf()
    <input type="hidden" name="id" value="{{$data['id']}}"><br>
    <input type="text" name="type" value="{{$data['type']}}" class="form-control"><br>
    <textarea  name="description"  class="form-control">{{$data['description']}}</textarea><br>
    <input type="submit" name="update" class="form-control btn btn-success">
</form>
</div>
</div>
@stop