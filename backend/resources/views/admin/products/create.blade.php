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
                    <p>Create a product</p>
                </div>

                <div class="container">
                    @include('admin.partials.errors')

                    <form class="pt-3" method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="brand">Brand</label>
                                <select class="form-control" id="brand" name="brand" required>
                                    <option value="" disabled selected>Choose</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="sections">Sections</label>
                                <select class="form-control select2" name="sections[]" required multiple>
                                        @foreach($sections as $section)
                                            <?php $dash=''; ?>
                                        <option value="{{ $section->id }}">
                                            {{ $section->name['en'] ?? $section->name['ru'] ?? $section->name['am'] ?? '' }}
                                        </option>
                                        @if(count($section->subSections))
                                                @include('admin.products.subCategoryList_option',['subSections' => $section->subSections])
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tags">Tags</label>
                                <select class="form-control select2" id="tags" multiple name="tags[]">
                                    <option value="" disabled selected>Choose</option>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="stars_rate">Sort</label>
                                <input
                                    type="number"
                                    value="{{ $productSortBigCount + 1 }}"
                                    class="form-control" name="sort" id="stars_rate" min="1"
                                >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="old_price">Old Price</label>
                                <input type="number" class="form-control" name="old_price" id="old_price">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" name="price" id="price" min="0" step="0.1"
                                       required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="viewed">Viewed</label>
                                <input type="number" class="form-control" name="viewed" id="viewed" min="0">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="stars_rate">Stars_rate</label>
                                <input type="number" class="form-control" name="stars_rate" id="stars_rate" min="1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="avatar">Avatar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input gallery_image" id="avatar" name="avatar"
                                           required>
                                    <label class="custom-file-label" for="avatar">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-md-3 avatar_preview">
                                <img class="" src="" alt="" height="100">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"
                                          required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input checked class="form-check-input" type="checkbox" name="active"
                                               id="active">
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border p-2 product-gallery">
                            @include('admin.products.partials.gallery')
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>

            </div>
        </div>
    </main>
    {{--    @include('admin.products.partials.add_gallery')--}}
    {{--    @include('admin.products.partials.add_size_color')--}}
@endsection

