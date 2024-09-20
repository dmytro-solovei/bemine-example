@foreach($editData as $key => $gallery)
    <div class="row gallery-block-row existing-gallery-block p-2 border border-black m-2" data-gallery-block-count="{{$gallery['block']}}">
        <div class="mr-3 col-12 row mb-3 gallery-items">
            @foreach($gallery['images'] as $image)
                <div class="form-group col-2">
                    <div class="d-flex align-items-center flex-column">
                        <img class="w-100 mr-3 product-slider-image" src="{{asset('/storage/p/'.$product->slug.'/gallery/small/'.$image['path'])}}" alt="">
                        <button type="button" class="mt-2 remove-btn btn btn-sm btn-danger" data-image="{{$image['path']}}"><i class="fa fa-trash-o fa-lg"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-12 mt-3 mb-3 avatar_preview">
            <img class="" src="" alt="" height="100">
        </div>
        <div class="col-md-12 form-group size-color p-2">
            <div class="form-group">
                <div class="custom-file existing-gallery-input">
                    <input type="file" class="custom-file-input gallery_image"
                           name="existing_gallery[{{ $gallery['block'] }}][images][]" multiple>
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
            @include('admin.products.partials.existing_add_size_color')
        </div>
    </div>
@endforeach


