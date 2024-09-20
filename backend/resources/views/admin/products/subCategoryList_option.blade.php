<?php $dash.='___'; ?>
@foreach($subSections as $key => $subSection)
    @if(isset($sectionsIds))
        <option class="{{$dash}}" value="{{$subSection->id}}"  @if(in_array($subSection->id, $sectionsIds)) selected @endif
        value="{{$subSection->id}}">{{$dash}}{{ $subSection->name['en'] ?? $subSection->name['ru'] ?? $subSection->name['am'] ?? '' }} </option>
        @if(count($subSection->subSections))
            @include('admin.products.subCategoryList_option',['subSections' => $subSection->subSections])
        @endif
    @else
        <option class="{{$dash}}" value="{{$subSection->id}}">{{$dash}}{{ $subSection->name['en'] ?? $subSection->name['ru'] ?? $subSection->name['am'] ?? '' }}</option>
        @if(count($subSection->subSections))
            @include('admin.products.subCategoryList_option',['subSections' => $subSection->subSections])
        @endif
    @endif
@endforeach
