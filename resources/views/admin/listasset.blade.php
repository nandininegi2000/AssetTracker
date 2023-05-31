@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container-fluid">
<?php $id=1?>
<div class="text-center p-3"><a href="addasset" class="btn btn-primary ">Create Asset</a></div>
<table border=1 class="table table-bordered table-hover table-striped">
    <tr>
        <td>Id</td>
        <td>Asset Name</td>
        <td>Asset Code</td>
        <td>Asset Type</td>
        <td>Images</td>
        <td>Is Active</td>
        <td>Created At</td>
        <td>Updated At</td>
        <td>Action</td>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{$id}}</td>
        <td>{{$d['name']}}</td>
        <td>{{$d['code']}}</td>
        <td>{{$d['type']}}</td>
        <td><a href="images\{{$d['id']}}">Click here</a></td>
        <td>{{ $d['isActive'] }}</td>
        <td>{{$d['created_at']}}</td>
        <td>{{$d['updated_at']}}</td>
        <td><a href="editasset/{{$d['id']}}" class="btn btn-warning">Edit</a>
        <a href="deleteasset/{{$d['id']}}" class="btn btn-danger" onclick="return showConfirm();">Delete</a></td>

    </tr>
    <?php $id++;?>
    @endforeach
</table>
<span>
    {{$data->links()}}
</span>
<style>
    .w-5{
        display: none;
    }
</style>
<a href="download"  id="export" class="btn btn-primary">Download</a>
</div>
</div>
@stop
<script>
    function showConfirm(){
        return confirm("Are You sure!");
    }
    
</script>