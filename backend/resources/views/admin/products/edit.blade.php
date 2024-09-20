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
                            <p>Edit product</p>
                        </div>
                        <div>
                            <form action="{{route('product.destroy', $product->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button id="delete" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o fa-lg"></i></button>
                            </form>
                        </div>
                        <div class="col-md-1">
                            <form action="{{route('product.inactive', $product->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                @if($product->active)
                                    <button id="inactive" type="button" class="btn btn-sm btn-warning">Inactive</button>
                                @else
                                    <button id="activate" type="button" class="btn btn-sm btn-success">Activate</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container">
                    @include('admin.partials.errors')

                    <form class="pt-3" method="POST" action="{{route('product.update', $product->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="page" value="{{$page}}">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" value="{{$product->title}}" name="title"
                                       required id="title">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="brand">Brand</label>
                                <select class="form-control" id="brand" name="brand" required>
                                    <option value="" disabled selected>Choose</option>
                                    @foreach($brands as $brand)
                                        <option @if($product->brand_id == $brand->id) selected
                                                @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <?php $sectionsIds = $product->sections->pluck('id')->toArray() ?>
                                <label for="sections">Sections</label>
                                <select class="form-control select2" name="sections[]" required multiple>
                                    @foreach($sections as $section)
                                            <?php $dash = ''; ?>
                                        <option
                                            @if(in_array($section->id, $sectionsIds)) selected @endif
                                            value="{{$section->id}}"
                                        >
                                            {{ $section->name['en'] ?? $section->name['ru'] ?? $section->name['am'] ?? '' }}
                                        </option>
                                        @if(count($section->subSections))
                                            @include('admin.products.subCategoryList_option',['subSections' => $section->subSections])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <?php $tagsIds = $product->tags->pluck('id')->toArray() ?>
                                <label for="tags">Tags</label>
                                <select class="form-control select2" id="tags" multiple name="tags[]">
                                    <option value="" disabled selected>Choose</option>
                                    @foreach($tags as $tag)
                                        <option
                                            @if(in_array($tag->id, $tagsIds)) selected @endif
                                        value="{{$tag->id}}">{{$tag->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="stars_rate">Sort</label>
                                <input
                                    type="number"
                                    value="{{ $product->sort }}"
                                    class="form-control" name="sort" id="stars_rate" min="1"
                                >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="old_price">Old Price</label>
                                <input type="number" class="form-control" value="{{$product->old_price}}" min="0"
                                       step="0.1"
                                       required name="old_price" id="old_price">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" value="{{$product->price}}" name="price"
                                       min="0" step="0.1"
                                       required id="price">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="viewed">Viewed</label>
                                <input type="number" class="form-control" value="{{$product->viewed}}" name="viewed"
                                       min="0"
                                       id="viewed">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="stars_rate">Stars_rate</label>
                                <input type="number" class="form-control" name="stars_rate" id="stars_rate" min="1" value="{{$product->stars_rate}}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="avatar">Avatar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input gallery_image" id="avatar"
                                           name="avatar">
                                    <label class="custom-file-label" for="avatar">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-md-3 avatar_preview">
                                <img class="" src="{{asset('storage/'.$product->img)}}" alt="" height="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description"
                                          required rows="3">{{$product->productDetails->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group p-3 border">
                            <div id="availability">
                                <label for="">Availability</label>
                                <div class="form-row">
                                    <select class="form-control col-md-3" id="available" name="available">
                                        @foreach($availabilities as $key => $available)
                                            <option
                                                @if($available == $product->available_type) selected @endif
                                            value="{{$available}}">{{str_replace('_', ' ', $key)}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-3 border">
                            <div id="additional_block">
                              <div class="d-flex mb-3">
                                  <label for="">Additional</label>
                                  <button type="button" id="add_additional" class="ml-3 w-auto btn btn-sm bg-primary d-block py-1 px-2"><i class="fa fa-plus text-white" aria-hidden="true"></i></button>
                              </div>
                                @if($product->productDetails->additional ?? false)
                                    @foreach($product->productDetails->additional as $additional)
                                        <div class="form-row d-flex mb-1">
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" name="additional[]"
                                                       value="{{$additional}}">
                                            </div>
                                            <button type="button" class="w-auto delete-additional btn btn-sm btn-danger"><i class="fa fa-trash-o fa-lg"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    @include('admin.products.partials.additional')
                                @endif
                            </div>
                        </div>
                        <div class="form-group p-3 border">
                            <div id="information_block">
                                <div class="d-flex mb-3">
                                    <label for="description">Information</label>
                                    <button type="button" id="add_information" class="ml-3 w-auto btn btn-sm bg-primary d-block py-1 px-2"><i class="fa fa-plus text-white" aria-hidden="true"></i></button>
                                </div>
                                @if($product->productDetails->information ?? false)
                                    @foreach($product->productDetails->information as $key => $information)
                                        <div class="form-row information_blocks mb-1">
                                            <input type="text" class="form-control col-md-3"
                                                   name="information[{{$key}}][key]" value="{{$information['key']}}">
                                            <input type="text" class="form-control col-md-3"
                                                   name="information[{{$key}}][value]"
                                                   value="{{$information['value']}}">
                                            <button type="button" class="w-auto delete-information ml-2 btn btn-sm btn-danger"><i class="fa fa-trash-o fa-lg"></i></button>
                                        </div>
                                    @endforeach
                                @else
                                    @include('admin.products.partials.information')
                                @endif
                            </div>
                        </div>
                        <div class="mb-5 p-3 border">
                            <h1>Popular By</h1>
                            <div class="form-row">
                                <div class="custom-control custom-checkbox col-md-3">
                                    <input type="checkbox" class="custom-control-input"
                                           @if($product->popularsBy->best_seller ?? false) checked @endif
                                           name="popular_by[best_seller]"
                                           id="best_seller">&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="custom-control-label" for="best_seller">BESTSELLER</label>
                                </div>
                                <div class="custom-control custom-checkbox col-md-3">
                                    <input type="checkbox" class="custom-control-input"
                                           @if($product->popularsBy->new_arrival ?? false) checked @endif
                                           name="popular_by[new_arrival]"
                                           id="new_arrival">&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="custom-control-label" for="new_arrival">NEW ARRIVAL</label>
                                </div>
                                <div class="custom-control custom-checkbox col-md-3">
                                    <input type="checkbox" class="custom-control-input" name="popular_by[top_rated]"
                                           @if($product->popularsBy->top_rated ?? false) checked @endif
                                           id="top_rated">&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="custom-control-label" for="top_rated">TOP RATED</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 p-3 border">
                            <h1>Slide Groups</h1>
                            <div class="form-group col-md-8">
                                <label for="sizes">Slides</label>
                                <select class="form-control select2" id="sizes" name="slide_groups[]"
                                        multiple required>
                                    <option value="" disabled selected>Choose</option>
                                    @foreach($slides as $slide)
                                        <option
                                            @if(in_array($slide->id, $product->slideGroups->pluck('id')->toArray()))
                                                selected
                                            @endif
                                            value="{{$slide->id}}">{{$slide->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-5 p-3 border">
                            <h1>Suggested Products</h1>
                            <div class="form-group col-md-8">
                                <label for="suggested_products">Products</label>
                                <select class="form-control select2" id="suggested_products" name="suggested_products[]"
                                        multiple required>
                                    <option value="" disabled selected>Choose</option>
                                    @foreach($allProducts as $allProduct)
                                        <option
                                            @if(in_array($allProduct->id, $product->suggestedProducts->pluck('suggested_id')->toArray()))
                                                selected
                                            @endif
                                            value="{{$allProduct->id}}">{{$allProduct->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-5 p-3 border product-gallery">
                            @include('admin.products.partials.gallery')
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
