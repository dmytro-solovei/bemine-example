<div class="row color-size-block">
    <div class="form-group col-md-4">
        <label for="colors">Color Of Images</label>
        <select class="form-control" id="colors" name="gallery[{{$galleryCount ?? 1}}][color]"
                required>
            <option value="" disabled selected>Choose</option>
            @foreach($colors as $color)
                <option value="{{$color->id}}">{{$color->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-8">
        <label for="sizes">Available Sizes</label>
        <select class="form-control" id="sizes" name="gallery[{{$galleryCount ?? 1}}][sizes][]"
                multiple required>
            <option value="" disabled selected>Choose</option>
            @foreach($sizes as $size)
                <option value="{{$size->id}}">{{$size->name}}</option>
            @endforeach
        </select>
    </div>
</div>
