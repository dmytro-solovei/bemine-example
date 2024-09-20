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
                <div class="col-md-6">
                    <h1 class="h2">Settings</h1>
                </div>
            </div>
        </div>

        <div class="">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Main color</th>
                    <th scope="col">Currency value</th>
                </tr>
                </thead>
                <tbody>
                @foreach($settings as $setting)
                    <tr>
                        <th scope="row">{{$setting->id}}</th>
                        <td>
                            <div style="background-color: {{$setting->main_color}}; height: 50px;width: 50px"></div>
                        </td>
                        <td>{{$setting->currency_value}}</td>
                        <td><a href="{{route('setting.edit', $setting->id)}}" type="button" class="btn btn-outline-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>


        <div class="row">
            {{ $settings->links() }}
        </div>

    </main>
@endsection
