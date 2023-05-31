@extends('admin.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
</head>
<body>
<div class="content-wrapper">
<div class="container-fluid">
<?php $id=1?>
<div class="text-center p-3"><a href="add" class="btn btn-primary ">Create Asset Type</a></div>
<table id="mytable" border=1 class="table table-bordered table-hover table-striped">
    <tr>
        <td>Id</td>
        <td>Asset Type</td>
        <td>Asset Description</td>
        <td>Created At</td>
        <td>Updated At</td>
        <td>Action</td>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{$id}}</td>
        <td>{{$d['type']}}</td>
        <td>{{$d['description']}}</td>
        <td>{{$d['created_at']}}</td>
        <td>{{$d['updated_at']}}</td>
        <td><a href="edit/{{$d['id']}}" class="btn btn-warning">Edit</a>
        <a href="delete/{{$d['id']}}" class="btn btn-danger" onclick="return showConfirm();">Delete</a></td>

    </tr>
    <?php $id++;?>
    @endforeach
</table>
<span class="p-2">
    {{ $data->links() }}
</span>
<style>
    .w-5{
        display: none;
    }
</style>
</div>
</div>
@stop
<script>
    $(document).ready( function () {
    $('#mytable').DataTable();
    } );
    function showConfirm(){
        return confirm("Are You sure!");
    }
</script>

</body>
</html>