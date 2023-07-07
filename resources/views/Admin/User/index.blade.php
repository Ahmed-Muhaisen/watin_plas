

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

    @if(@session('msg'))
    <div class="alert alert-{{@session('type')}} alert-dismissible fade show" role="alert">
        {{@session('msg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif



    <div class="d-flex justify-content-between align-items-center m-4">

        <h1>{{ ($page=='Trash')?'User Trash':'User Page' }}</h1>
        <a class="btn btn-outline-info h-25" href="{{ route('admin.User.create') }}">Add New User</a>

    </div>




    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Manige User</h6>

            @if($page=='Trash')
            <a class="btn btn-danger py-2 " href="{{ route('admin.User.index') }}"><i class="fa-solid fa-tags"></i>
                Index
                @else
                <a class="btn btn-danger py-2 " href="{{ route('admin.User.trash') }}"><i class="fa-solid fa-trash"></i>
                    Trash
                    @endif

                </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>created at</th>
                            <th>updated at</th>
                            <th>action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($User as $item)

                        <tr>

                            <td>{{ $item->id }}</td>
                            <td>{{$item->name }}</td>
                            <td>{{$item->email }}</td>
                            <td>{{$item->created_at }}</td>
                            <td>{{$item->updated_at }}</td>
                            <td>

                                @if($page=='Trash')
                                <a href="{{ route('admin.User.restore',$item->id) }}" class="btn btn-primary py-2"><i
                                        class="fa-solid fa-trash-restore"></i></a>

                                <form class="d-inline" action="{{ route('admin.User.forcedelete',$item->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="confirm('Are You Sure')" class="btn btn-danger py-2 "> <i
                                            class="fa-solid fa-close"></i>
                                    </button>
                                </form>

                                @else



                                <a href="{{ route('admin.User.edit',$item->id) }}" class="btn btn-primary py-2"><i class="fa-solid fa-pen-to-square"></i></a>

                                <form class="d-inline" action="{{ route('admin.User.destroy',$item->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="confirm('Are You Sure')" class="btn btn-danger py-2 "> <i
                                            class="fa-solid fa-trash"></i>
                                    </button>
                                </form>


                                @endif



                            </td>
                        </tr>


                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="{{ asset('website/assets/vendors/bootstrap/bootstrap.js') }}"></script>


</body>

</html>
