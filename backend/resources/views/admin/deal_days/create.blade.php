@extends('admin.layouts.main')

@section('content')
    <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">

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
                    <p>Create a deal day</p>
                </div>
                <div class="container">
                    @include('admin.partials.errors')
                    <p id="add-deal-day">plus</p>

                    <form class="pt-3" method="POST" action="{{route('deal-day.store')}}">
                        @csrf
                        <div id="deal-days">
                            @include('admin.deal_days.partials.add_deal_day')
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@section('scripts')
    <script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>
@endsection
@endsection
