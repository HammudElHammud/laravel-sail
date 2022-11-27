@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Book</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form
                            method="POST"
                            action="{{ route('book.store') }}"
                        >
                            @csrf

                            <div class="form-group">
                                <label>Authors</label>
                                <select class="form-control" name="author" required>
                                    <option
                                        value="">Select Author
                                    </option>
                                    @if(isset($authors))
                                        @foreach($authors as $author)
                                            <option
                                                value="{{$author['id']}}">{{$author['first_name'] . ' ' .$author['last_name']}}   </option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('author'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('author')}} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title"
                                       value="{{ old('title') }}" required/>
                                @if($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Release Date</label>
                                <input type="date" class="form-control" name="release_date"
                                       placeholder="Enter release date"
                                       value="{{ old('release_date') }}" required/>
                                @if($errors->has('release_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('release_date')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Isbn</label>
                                <input type="text" class="form-control" name="isbn"
                                       placeholder="Enter isbn" value="{{ old('isbn') }}" required/>
                                @if($errors->has('isbn'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('isbn')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Format</label>
                                <input type="text" class="form-control" name="format"
                                       placeholder="Enter format" value="{{ old('format') }}" required/>
                                @if($errors->has('format'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('format')}} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" name="description"
                                          placeholder="Enter description"> {{ old('description') }} </textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('description')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Number Of Pages</label>
                                <input type="number" class="form-control" name="number_of_pages"
                                       placeholder="Enter number of pages" value="{{ old('number_of_pages') }}"
                                       required/>
                                @if($errors->has('number_of_pages'))
                                    <span class="invalid-feedback">
                                        <strong>{{$errors->first('number_of_pages')}} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary m-2 p-2">Submit</button>
                                <a href="{{route('home')}}" class="btn btn-outline-danger m-2 p-2">Back</a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
