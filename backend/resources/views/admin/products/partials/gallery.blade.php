<div class="d-flex align-items-center mb-3">
    <h1>Gallery</h1>
    <button type="button" id="add_gallery" class="ml-3 w-auto btn btn-sm bg-primary d-block py-1 px-2"><i class="fa fa-plus text-white" aria-hidden="true"></i></button>
</div>
<div id="gallery_block">
    @if(isset($editData))
        @include('admin.products.partials.existing_gallery')
    @endif

    {{--  Dynamically adding part   --}}
    @if(!isset($editData))
        @include('admin.products.partials.add_gallery')
    @endif
</div>
<hr>
