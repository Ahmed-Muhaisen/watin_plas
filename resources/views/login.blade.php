

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" >
  </head>
  <body class="p-5">

<div class="text-start mt-5 border p-5 w-50 m-auto">
    <h1 class="m-5 mt-0 text-center">Login page</h1>

    <form action="{{route('login_validate')}}" method="post" class="">
        @csrf
        <div class="my-3 ">

                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old("email")}}" placeholder="email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="my-3 " >
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <a href="{{ route('register') }}" class="">I am new user</a>
        <br>
<button type="submit" class= "m-auto mt-3 p-3 px-5 btn btn-info d-block" >Login</button>
</form>


</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>
