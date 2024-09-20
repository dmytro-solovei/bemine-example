@extends('admin.layouts.main')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="chartjs-size-monitor"
             style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
            <div class="chartjs-size-monitor-expand"
                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
            </div>
            <div class="chartjs-size-monitor-shrink"
                 style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <div class="row">
                <div class="">
                    <p>Create a user</p>
                </div>

                <div class="container">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif

                    <form class="pt-3" method="POST" action="{{route('users.update', $user->id)}}"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" autocomplete="new-email" id="email"
                                       name="email" value="{{$user->email}}"
                                       placeholder="...">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                       value="{{$user->username}}">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="avatar">Avatar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                        <label class="custom-file-label" for="avatar">Choose file</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="custom-file">
                                        <img height="100" src="{{asset('storage/'.$user->avatar)}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{$user->address}}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" value="{{$user->city}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                       value="{{$user->phone}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" @if($user->active) checked
                                               @endif  type="checkbox" name="active" id="active">
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input @if($user->verified) checked @endif class="form-check-input"
                                               type="checkbox" name="verified" id="verified">
                                        <label class="form-check-label" for="verified">
                                            Verified
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
