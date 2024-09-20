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
                    <p>Update Slide Group</p>
                    <div class="col-md-1">
                        <form action="{{route('slide.destroy', $slide->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button id="delete" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o fa-lg"></i></button>
                        </form>
                    </div>
                </div>

                <div class="container">
                    @include('admin.partials.errors')

                    <form class="pt-3" method="POST" action="{{route('slide.update', $slide->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$slide->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="active"
                                               @if($slide->active) checked @endif
                                               id="active">
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
