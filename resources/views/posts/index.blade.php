@extends('layouts.app')

@section('content')

    <div class="container">
        {{-- Start Insert Post  --}}
        <form action="{{route('posts.store')}}" method="POST">
            @csrf
            <div class="form-group">
                @php $input = "title" @endphp
                <label for="">Post Title</label>
                <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{old($input)}}">
                @error($input)
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                @php $input = "description" @endphp
                <label for="">Post Description</label>
                <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{old($input)}}">
                @error($input)
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                @php $input = "category_id" @endphp
                <label for="">Categories</label>
                <select class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="">
                    <option disabled selected>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error($input)
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <input type="submit" value="Save" class="btn btn-primary my-2 btn-block">
        </form>
        {{-- End Insert Post  --}}

        {{-- Start Categories List  --}}
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $index=>$post)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>
                        <!-- Edit Post -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenter{{$post->id}}">
                            Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter{{$post->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="{{$post->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{$post->id}}">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('posts.update', $post->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                @php $input = "title" @endphp
                                                <label for="">Post Title</label>
                                                <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{old($input) ?? $post->$input}}">
                                                @error($input)
                                                <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                @php $input = "description" @endphp
                                                <label for="">Post Description</label>
                                                <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{old($input) ?? $post->$input}}">
                                                @error($input)
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                @php $input = "category_id" @endphp
                                                <label for="">Categories</label>
                                                <select class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="">
                                                    <option disabled selected>Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}"{{$post->{$input} == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error($input)
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <input type="submit" value="Save changes" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Post -->
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#exampleModal{{$post->id}}">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="{{$post->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{$post->id}}">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                            <h4>Are you sure to delete <b>{{$post->title}}</b> ?!</h4>
                                            @csrf
                                            @method('Delete')
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <input type="submit" value="Delete Post" class="btn btn-danger">
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
