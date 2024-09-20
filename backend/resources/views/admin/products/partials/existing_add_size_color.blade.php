<div class="row color-size-block">
    <div class="form-group col-md-6">
        <label for="colors">Color Of Images</label>
        <select class="form-control" id="colors" name="existing_gallery[{{$gallery['block']}}][color]"
                required>
            @foreach($colors as $color)
                <option @if($gallery['color_id'] == $color->id) selected @endif value="{{$color->id}}">{{$color->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="sizes">Available Sizes</label>
        <select class="form-control" id="sizes" name="existing_gallery[{{$gallery['block']}}][sizes][]"
                multiple required>
            @foreach($sizes as $size)
                <option @if(in_array($size->id, $gallery['sizes'])) selected @endif value="{{$size->id}}">{{$size->name}}</option>
            @endforeach
        </select>
    </div>
</div>
