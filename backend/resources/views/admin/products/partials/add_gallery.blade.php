<div class="row gallery-block-row mt-8 p-2 border border-black m-2" data-gallery-block-count="{{$galleryCount ?? 1}}">
   <div class="col-12 row">
       <div class="form-group col-md-6">
           <label for="">Big Image</label>
           <div class="custom-file">
               <input type="file" class="custom-file-input gallery_image"
                      name="gallery[{{$galleryCount ?? 1}}][images][]" multiple>
               <label class="custom-file-label">Choose file</label>
           </div>
       </div>
       <div class="col-md-6 form-group size-color">
           @include('admin.products.partials.add_size_color')
       </div>
   </div>
    <div class="col-md-12 avatar_preview">
        <img class="" src="" alt="" height="100">
    </div>
</div>
