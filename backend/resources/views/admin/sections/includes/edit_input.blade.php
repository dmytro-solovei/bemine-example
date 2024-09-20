<div class="pt-3 d-flex align-items-end justify-content-end editing-form" contenteditable data-id="{{$section->id}}">
    @csrf
    <div class="form-row d-flex align-items-end justify-content-end col-md-4">
        @foreach($section->name as $key => $name)
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ $key }}</span>
                </div>
                <input type="text" value="{{ $name }}" class="form-control" name="{{ $key }}">
            </div>
        @endforeach
        <div class="form-group ml-3">
            <button class="btn btn-primary update-item">Update</button>
        </div>
    </div>
</div>
