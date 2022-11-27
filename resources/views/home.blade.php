@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p class="align-content-center">Authors</p>
                        <a href="{{route('author.create')}}" class="btn btn-primary"> New Author</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                            @if (session('error'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(isset($authorsResponse['items']))
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($authorsResponse['items'] as $author)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$author['first_name']}}</td>
                                        <td>{{$author['last_name']}}</td>
                                        <td>{{ucfirst($author['gender'])}}</td>
                                        {{--@info would be better if books in comes inside author json to disable delete button here--}}
                                        <td class="d-flex justify-content-center">
                                            <a href="{{route('author.view' , $author['id'])}}" class="btn btn-primary m-1">View </a>
                                            <form action="{{route('author.delete' , $author['id'])}}" method='POST'>
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger m-1">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <div class="d-flex justify-content-center">
                                <p>No Authors to show</p>
                            </div>
                        @endif
                        <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="@if(($authorsResponse['current_page'] - 1) > 0) home?page={{ $authorsResponse['current_page'] - 1 }} @endif">Previous</a>
                                    </li>
                                    @for($num = 1; $num<= $authorsResponse['total_pages']; $num++)
                                        <li class="page-item @if($authorsResponse['current_page'] === $num) active @endif">
                                            <a class="page-link " href="home?page={{ $num }}">{{$num}}</a></li>
                                    @endfor
                                    <li class="page-item"><a class="page-link"
                                                             href="@if(($authorsResponse['current_page'] + 1) <= $authorsResponse['total_pages'])home?page={{ $authorsResponse['current_page'] + 1 }} @endif">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
