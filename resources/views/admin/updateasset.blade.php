@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container-fluid">
<h1>Update Asset</h1>
<form action="/editasset" method="post" enctype="multipart/form-data">
    @csrf()
    <input type="hidden" value="{{$dt->id}}" name="id">
    Asset Name: <input type="text" name="name" class="form-control" value="{{$dt->name}}">
    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror<br>
    <?php 
    $cd = '';
    for($i = 0; $i < 16; $i++)
    $cd .= mt_rand(0, 9);
    ?>
    Asset Code: <input type="text" name="code" value="{{$dt->code}}" class="form-control" readonly>
    @error('code')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br>
    Asset Type: <select class="form-control" name="type">
        <option value="">Select Asset Type</option>
        @foreach($data as $d)
            <option value="{{$d->type}}" <?php if($dt->type==$d->type) echo "selected";?>>{{$d->type}}
            </option>
        @endforeach
        
    </select>
    @error('type')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br>
    Asset Image:<br>
    @foreach($astimg as $pic)
<img src="{{asset('/files/'.$pic->image)}}" alt="pic" width="100" height="100">
@endforeach
<br><br>
 <input type="file" name="filenames[]" multiple>
    @error('filenames')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br><br>
    Is Active:  Yes <input type="radio" name="isactive" value="true" <?php if($dt->isActive=="true") echo "checked";?>>
    No <input type="radio" name="isactive" value="false" <?php if($dt->isActive=="false") echo "checked";?>>
    <br><br>
    
    <input type="submit" name="add" value="Update" class="form-control btn btn-success">
</form>
</div>
</div>
@stop