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
                    <h1 class="h2">Products</h1>
                </div>
                <div>
                    <a type="button" href="{{route('product.create')}}" class="btn btn-primary"><i class="fa fa-plus text-white" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <form action="{{route('product.index')}}" method="get">
            <div class="col-12 d-flex align-items-center justify-content-center p-0 mb-5">
              <div class="col-ms-12 col-lg-6 d-flex align-items-center">
                  <input type="text" class="form-control mr-3" name="search" value="">
                  <button type="submit" class="btn btn-outline-primary">Search</button>
              </div>
            </div>
        </form>

        <form action="{{route('product.index')}}" method="get">
            @csrf
            <input type="hidden" id="filter_popular_by" name="filter_popular_by" value="">
            <div class="form-row mb-3 mt-3">
                <div class="custom-control custom-radio col-md-2">
                    <input type="radio"
                           @if( request()->get('filter_popular_by') === 'best_seller') checked @endif
                           class="custom-control-input popular-by-filter"
                           name="popular_by_sort"
                           id="best_seller">&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="custom-control-label" for="best_seller">BESTSELLER</label>
                </div>
                <div class="custom-control custom-radio col-md-2">
                    <input type="radio" class="custom-control-input popular-by-filter"
                           @if( request()->get('filter_popular_by') === 'new_arrival') checked @endif
                           name="popular_by_sort"
                           id="new_arrival">&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="custom-control-label" for="new_arrival">NEW ARRIVAL</label>
                </div>
                <div class="custom-control custom-radio col-md-2">
                    <input type="radio" class="custom-control-input popular-by-filter"
                           @if( request()->get('filter_popular_by') === 'top_rated') checked @endif
                           name="popular_by_sort"
                           id="top_rated">&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="custom-control-label" for="top_rated">TOP RATED</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </div>
        </form>

        <div class="">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Old Price</th>
                    <th scope="col">Price</th>
                    <th scope="col">Viewed</th>
                    <th scope="col">Active</th>
                    <th scope="col">Sizes</th>
                    <th scope="col">Stars_rate</th>
                    <th scope="col">Created At</th>

                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->brand->name}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->slug}}</td>
                        <td><img height="100" src="{{asset('storage/'.$product->img)}}" alt=""></td>
                        <td>{{$product->old_price}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->viewd}}</td>
                        <td>{{$product->active}}</td>
                        <td>{{implode(',',$product->sizes->pluck('name')->toArray()) }}</td>
                        <td>{{$product->stars_rate}}</td>
                        <td>{{$product->created_at}}</td>
                        <td><a href="product/{{$product->id}}/edit/{{$products->currentPage()}}" type="button"
                               class="btn btn-outline-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            {{ $products->appends(['filter_popular_by' => request()->get('filter_popular_by')])->links() }}
        </div>

    </main>
@endsection
