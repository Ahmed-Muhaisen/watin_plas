

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  </head>


<body>


<div class="container card mt-5 py-4">
<div class="d-flex justify-content-between align-items-center" >
        <h2>Create User</h2>
        <a class="btn btn-outline-info h-25" onclick="window.history.back()" >Return Back</a>
    </div>


<form action="@if($page=='Create')
{{ route('admin.User.store') }}
@else
{{ route('admin.User.update',$User->id) }}
@endif
" method="post">
@if($page=='Edit')
@method('put')
@endif

@csrf
<div class="my-3">
<label for="">
    name
</label>
<input type="text" name="name" class="form-control @error('name')
is-invalid
@enderror

" value="{{ old('name',$User->name)}}">
@error('name')
<p class="text-danger">{{$message}}</p>
@enderror
</div>


<div class="my-3">
    <label for="">
        Email
    </label>
    <input type="text" name="email" class="form-control @error('email')
    is-invalid
    @enderror

    " value="{{ old('email',$User->email)}}">
    @error('email')
    <p class="text-danger">{{$message}}</p>
    @enderror
    </div>


    <div class="my-3">
        <label for="">
            password
        </label>
        <input type="text" name="password" class="form-control @error('password')
        is-invalid
        @enderror
        @if($page=='Edit')
        bg-dark bg-opacity-10
@endif
        " value="{{old('password')}}">
       @if($page=='Edit')
        <p class="text-primary">if you dont need change password can make the input impty</p>
    @endif
        @error('password')
        <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
    <button type="submit" class="btn btn-info w-100">Create User</button>
</form>

</div>




