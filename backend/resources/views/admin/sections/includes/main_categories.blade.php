<div class="accordion">
    @foreach($sections->whereNull('parent_id') as $section)
        <div class="card mt-3">
            <div class="card-header" data-id="{{ $section->id }}">
               @foreach($section->name as $key => $name)
                   <span class="title">{{strtoupper($key)}}: {{$name}}</span>
               @endforeach
                <span
                    class="accicon ml-2 open-edit-form"
                    data-toggle="collapse"
                    data-id="{{$section->id}}"
                    data-target="#collapse_{{$section->id}}"
                >
                    <i class="fas fa-pen"></i>
                </span>

                <form class="accicon ml-1 d-inline-block" action="{{route('section.destroy', $section->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <i class="fas fa-trash ml-1 remove-item" ></i>
                </form>
                <span class="accicon collapsed collapsed-content" data-toggle="collapse" data-target="#collapse_{{$section->id}}"
                      aria-expanded="true"><i class="fas fa-angle-down rotate-icon"></i></span>
            </div>
            <div id="collapse_{{$section->id}}" class="collapse">
                <div class="d-flex justify-content-end col-12 px-3">
                    @include('admin.sections.includes.create_button')
                </div>
                <div class="card-body mt-3">
                    @if($section->subSections->isNotEmpty())
                        <div class="pl-3 subcategories">
                            @include('admin.sections.includes.subcategories', ['sections' => $section->subSections])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-flex create-block justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 float-right" data-id="{{ $section->id ?? null }}">
        <div class="row">
            <div class="create-block-content">
                <form class="pt-3" method="POST" action="{{route('section.store')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-row d-flex align-items-end">
                        <div class="form-group col-md-8 append-input mb-0">

                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
