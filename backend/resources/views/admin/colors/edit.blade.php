@extends('admin.layouts.main')

@section('content')
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">

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
                    <p>Update color</p>
                </div>

                <div class="container">
                    @include('admin.partials.errors')

                    <div class="form-row">
                        <div class="col-md-10">
                            <form class="pt-3" method="POST" action="{{route('color.update', $color->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               value="{{$color->name}}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label for="code">Code</label>
                                        <div class="example-content-widget">
                                            <input id="color_code" name="code" type="color" class="form-control"
                                                   required value="{{$color->code}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Description</label>
                                        <input type="text" class="form-control" name="description" id="description"
                                               value="{{$color->description}}" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                        <div class="col-md-1">
                            <div style="background-color: {{$color->code}}; height: 50px;width: 50px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
