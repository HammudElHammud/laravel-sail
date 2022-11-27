@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div
                        class="card-header">@if(isset($author)) {{$author['first_name']}} {{$author['last_name']}} @endif </div>
                    <div class="card-body">
                        <p> Gender : {{ucfirst($author['gender'])}} </p>
                        <p> Biography : {{$author['biography']}} </p>
                        <p> Place of birth : {{$author['place_of_birth']}} </p>
                        <div class="row ">
                            @if(isset($author['books']) && !empty($author['books']))
                                <h6>Books:</h6>
                                @foreach($author['books'] as $book)
                                    <div class="col-sm-4" style="margin-bottom: 4px">
                                        <div class="card ">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$book['title']}}</h5>
                                                <p class="card-text">{{$book['description']}}</p>
                                                <form
                                                    action="{{route('book.delete' , ['id' => $book['id'], 'author_id' =>  $author['id']])}}"
                                                    method='POST'>
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove Books</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @else
                                <h5> There no Books</h5>
                            @endif

                            <div class="col-lg-12 d-flex justify-content-end">
                                <a href="{{route('home')}}" class="btn btn-outline-danger">Back</a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
