@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div
                        class="card-header">@if(isset($user)) {{$user['first_name']}} {{$user['last_name']}} @endif </div>
                    <div class="card-body">
                        <p> Email : {{$user['email']}} </p>
                        <p>Email Confirmed : @if($user['email_confirmed'])  Yes @else No @endif </p>
                        <p>Active Status : @if($user['active'])  Yes @else No @endif </p>
                        <p> Role :
                            @foreach($user['roles'] as $role)
                                {{$role}},
                            @endforeach
                        </p>
                        <p> Gender : {{$user['gender']}} </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
