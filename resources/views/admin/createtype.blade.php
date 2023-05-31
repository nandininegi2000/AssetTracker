@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container-fluid">
<h1>Create Asset Type</h1>
<form action="/insert" method="post">
    @csrf()
    <input type="text" name="type" placeholder="Asset Type" value="{{old('type')}}" class="form-control">
    @error('type')
    <div class="text-danger">{{$message}}</div>
    @enderror<br>
    <textarea name="description" placeholder="Description" value="{{old('description')}}" class="form-control"></textarea>
    @error('description')
    <div class="text-danger">{{$message}}</div>
    @enderror<br>
    <input type="submit" name="add" value="Create" class="form-control btn btn-success">
</form>
</div>
</div>
@stop