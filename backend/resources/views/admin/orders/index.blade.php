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
                    <h1 class="h2">Orders</h1>
                </div>
            </div>
        </div>

        <div class="">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Avatar</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Phone</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->product->title}}</td>
                        <td><img height="100" src="{{asset('storage/'.$order->product->img)}}" alt=""></td>
                        <td>{{$order->guest->name}}</td>
                        <td>{{$order->guest->phone}}</td>
                        <td><a href="{{route('order.show', $order->id)}}" type="button" class="btn btn-outline-primary">Show</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="row">
            {{ $orders->links() }}
        </div>
    </main>
@endsection
