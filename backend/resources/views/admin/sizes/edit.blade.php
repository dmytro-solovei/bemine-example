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
                            <p>Edit size</p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    @include('admin.partials.errors')

                    <form class="pt-3" method="POST" action="{{route('size.update', $size->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{$size->name}}" name="name" id="name">
                            </div>
                            <div class="form-group col-md-7">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" value="{{$size->description}}" name="description" id="description">
                            </div>
                        </div>
                        <div class="form-group col-md-6 p-0">
                            <?php $categoryIds = $size->categories->pluck('id')->toArray() ?>

                            <label class="d-block">Categories</label>
                            <select class="form-control select2" name="categories[]" required multiple>

                                @foreach($categories as $category)
                                        <?php $dash = ''; ?>
                                    <option
                                        @if(in_array($category->id, $categoryIds)) selected @endif
                                    value="{{$category->id}}"
                                    >{{ $category->name['en'] ?? $category->name['ru'] ?? $category->name['am'] ?? '' }}
                                    </option>
                                    @if(count($category->subSections))
                                        @include('admin.sections.subCategoryList_option',['subCategories' => $category->subSections])
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection
