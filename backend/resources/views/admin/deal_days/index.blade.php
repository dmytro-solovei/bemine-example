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
        <div class="d-flex col-12 justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <div class="row">
                <div class="mr-2">
                    <h1 class="h2">Deal Day</h1>
                </div>
                <div>
                    <a type="button" href="{{route('deal-day.create')}}" class="btn btn-primary"><i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

        <div class="">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Title</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dealDays as $dealDay)
                    <tr>
                        <th scope="row">{{$dealDay->id}}</th>
                        <td>{{$dealDay->product->title}}</td>
                        <td><img class="" src="{{asset('storage/'.$dealDay->product->img)}}" alt="" height="150"></td>
                        <td>{{$dealDay->date_start}}</td>
                        <td>{{$dealDay->date_end}}</td>
                        <td>
                            <form action="{{route('deal-day.destroy', $dealDay->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-sm btn-danger delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            {{ $dealDays->links() }}
        </div>
    </main>
@endsection
