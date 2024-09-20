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
                            <p>Edit brand</p>
                        </div>
                        <div>
                            <form action="{{route('brand.destroy', $brand->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button id="delete" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o fa-lg"></i></button>
                            </form>
                        </div>
                        <div class="col-md-1">
                            <form action="{{route('brand.inactive', $brand->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                @if($brand->active)
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

                    <form class="pt-3" method="POST" action="{{route('brand.update', $brand->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{$brand->name}}" name="name" id="name">
                            </div>
                        </div>

                        <div class="form-group col-md-6 p-0">
                            <?php $categoryIds = $brand->categories->pluck('id')->toArray() ?>

                            <label>Categories</label>
                            <select class="form-control select2" name="categories[]" required multiple>

                                @foreach($categories as $category)
                                        <?php $dash = ''; ?>
                                    <option
                                        @if(in_array($category->id, $categoryIds)) selected @endif
                                    value="{{$category->id}}"
                                    > {{ $category->name['en'] ?? $category->name['ru'] ?? $category->name['am'] ?? '' }}
                                    </option>
                                    @if(count($category->subSections))
                                        @include('admin.sections.subCategoryList_option',['subCategories' => $category->subSections])
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="avatar">Avatar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input gallery_image" id="avatar"
                                           name="avatar">
                                    <label class="custom-file-label" for="avatar">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-md-5 avatar_preview">
                                <img class="" src="{{asset('storage/'.$brand->avatar)}}" alt="" height="150">
                            </div>
                        </div>


{{--                        <div class="form-group">--}}
{{--                            <div class="row">--}}
{{--                                <div class="form-group col-md-4">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input @if($brand->active) checked @endif class="form-check-input"--}}
{{--                                               type="checkbox" name="active"--}}
{{--                                               id="active">--}}
{{--                                        <label class="form-check-label" for="active">--}}
{{--                                            Active--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection
