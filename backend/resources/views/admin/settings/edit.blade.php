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
                    <p>Update setting</p>
                </div>

                <div class="container">
                    @include('admin.partials.errors')

                    <div class="form-row">
                        <div class="col-md-10">
                            <form class="pt-3" method="POST" action="{{route('setting.update', $setting->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label for="main_color">Main color</label>
                                        <div class="example-content-widget">
                                            <input id="main_color" name="main_color" type="color" class="form-control"
                                                   required value="{{$setting->main_color}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Currency value</label>
                                        <select class="form-control" name="currency_value" id="currency_value" required>
                                            <option selected>{{$setting->currency_value}}</option>
                                            <option>$</option>
                                            <option>€</option>
                                            <option>₽</option>
                                            <option>֏</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
