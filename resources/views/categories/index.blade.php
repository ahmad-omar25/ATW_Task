@extends('layouts.app')

@section('content')

    <div class="container">
        {{-- Start Insert Category  --}}
        <form action="{{route('categories.store')}}" method="POST">
            @csrf
            @php $input = "name" @endphp
            <label for="">Category Name</label>
            <input type="text" class="form-control @error($input) is-invalid @enderror" name="name" value="{{old($input)}}">
            @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="submit" value="Save" class="btn btn-primary my-2 btn-block">
        </form>
        {{-- End Insert Category  --}}

        {{-- Start Categories List  --}}
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $index=>$category)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <!-- Edit Category -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$category->id}}">
                            Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$category->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{$category->id}}">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('categories.update', $category->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            @php $input = "name" @endphp
                                            <label for="">Category Name</label>
                                            <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{old($input) ?? $category->name}}">
                                            @error($input)
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input type="submit" value="Save changes" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Category -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$category->id}}">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$category->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{$category->id}}">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                                            <h4>Are you sure to delete <b>{{$category->name}}</b> ?!</h4>
                                            @csrf
                                            @method('Delete')
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input type="submit" value="Delete Category" class="btn btn-danger">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- End Categories List  --}}
    </div>

@endsection
