@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container-fluid">
<h1>Create Asset</h1>
<form action="/insertasset" method="post" enctype="multipart/form-data">
    @csrf()
    Asset Name: <input type="text" name="name" placeholder="Asset Name" value="{{old('name') }}"class="form-control">
    @error('name')
    <div class="text-danger">{{ $message }}</div>
    @enderror<br>
    <?php 
    $cd = '';
    for($i = 0; $i < 16; $i++)
    $cd .= mt_rand(0, 9);
    ?>
    Asset Code: <input type="text" name="code" value="<?=$cd?>" class="form-control" readonly>
    @error('code')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br>
    Asset Type: <select class="form-control" name="type">
        <option value="">Select Asset Type</option>
        @foreach($data as $d)
            <option value="{{$d->type}}" {{ old('type')==$d->type ? 'selected' : ''  }}>{{$d->type}}
            </option>
        @endforeach
        
    </select>
    @error('type')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br>
    Asset Image: <input type="file" name="filenames[]" multiple>
    @error('filenames')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br><br>
    Is Active:  Yes <input type="radio" name="isactive" value="true" checked>
    No <input type="radio" name="isactive" value="false" {{old('isactive')=='false'?'checked':''}}>
    <br><br>
    
    <input type="submit" name="add" value="Create" class="form-control btn btn-success">
</form>
</div>
</div>
@stop