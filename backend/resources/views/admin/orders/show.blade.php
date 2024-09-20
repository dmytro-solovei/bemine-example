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
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <p>Show Order</p>
                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>
                </div>

                <div class="container">
                    @include('admin.partials.errors')

                    <div class="row">
                        <table class="table col-md-10">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Color</th>
                                <th scope="col">Count</th>
                                <th scope="col">Address</th>
                                <th scope="col">Product Avatar</th>
                                <th scope="col">User Name</th>
                                <th scope="col">User Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">{{$order->id}}</th>
                                <td>
                                    <a target="_blank"
                                       href="{{route('product.edit', $order->product->id)}}">{{$order->product->title}}
                                    </a>
                                </td>
                                <td>{{$order->size->name}}</td>
                                <td>{{$order->color->name}}</td>
                                <td>{{$order->count}}</td>
                                <td>{{$order->address}}</td>
                                <td><img height="100" src="{{asset('storage/'.$order->product->img)}}" alt=""></td>
                                <td>{{$order->guest->name}}</td>
                                <td>{{$order->guest->phone}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="form-group col-md-2">
                            <form action="{{route('change-order-status')}}" method="post">
                                @method('put')
                                @csrf
                                <input type="hidden" name="order" value="{{$order->id}}">
                                <label for="brand">Status</label>
                                <select class="form-control order-status" name="status" required>
                                    @foreach($statuses as $status)
                                        <option
                                            @if($order->status == $status) selected @endif
                                        value="{{$status}}">{{str_replace('_', ' ',$status)}}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <h5>Other Orders of this user</h5>
                    <table class="table col-md-10">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Size</th>
                            <th scope="col">Color</th>
                            <th scope="col">Count</th>
                            <th scope="col">Address</th>
                            <th scope="col">Product Avatar</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->guest->orders as $order)
                            <tr>
                                <th scope="row">{{$order->id}}</th>
                                <td>
                                    <a target="_blank"
                                       href="{{route('product.edit', $order->product->id)}}">{{$order->product->title}}
                                    </a>
                                </td>
                                <td>{{$order->size->name}}</td>
                                <td>{{$order->color->name}}</td>
                                <td>{{$order->count}}</td>
                                <td>{{$order->address}}</td>
                                <td><img height="100" src="{{asset('storage/'.$order->product->img)}}" alt="">
                                </td>
                                <td>{{$order->guest->name}}</td>
                                <td>{{$order->guest->phone}}</td>
                                <td>
                                    <form action="{{route('change-order-status')}}" method="post">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="order" value="{{$order->id}}">
                                        <select class="form-control order-status" name="status" required>
                                            @foreach($statuses as $status)
                                                <option
                                                    @if($order->status == $status) selected @endif
                                                value="{{$status}}">{{str_replace('_', ' ',$status)}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
