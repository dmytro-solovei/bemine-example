@foreach($languages as $language)
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">{{ $language->name }}</span>
        </div>
        <input type="text" class="form-control" name="{{ $language->name }}">
    </div>
@endforeach
