@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Author</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form
                            method="POST"
                            action="{{ route('author.store') }}"
                        >
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Enter first name"
                                       value="{{ old('first_name') }}" required/>
                                @if($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter last name"
                                       value="{{ old('last_name') }}" required/>
                                @if($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('last_name')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Birth Date</label>
                                <input type="date" class="form-control" name="birthday" placeholder="Enter birth date"
                                       value="{{ old('birthday') }}" required/>
                                @if($errors->has('birthday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('birthday')}} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @if($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('gender')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Birth Place</label>
                                <input type="text" class="form-control" name="place_of_birth"
                                       placeholder="Enter place of birth" value="{{ old('place_of_birth') }}" required/>
                                @if($errors->has('place_of_birth'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('place_of_birth')}} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Biography</label>
                                <textarea type="text" class="form-control" name="biography"
                                          placeholder="Enter biography"> {{ old('biography') }} </textarea>
                                @if($errors->has('biography'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('biography')}} </strong>
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
