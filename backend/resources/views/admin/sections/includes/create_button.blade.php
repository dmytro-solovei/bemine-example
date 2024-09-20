<div
    class="d-flex create-block justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 float-right" data-id="{{ $section->id }}">
    <div class="row">
        <div class="create-block-content">
            <div class="edit-form">

            </div>
            <form class="pt-3" method="POST" action="{{route('section.store')}}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="parent_id" value="{{$section->id}}">
                <div class="form-row d-flex align-items-end">
                    <div class="append-input">

                    </div>
                    <div class="form-group ml-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
