<?php $dash.='___'; ?>
@foreach($subCategories as $key => $subCategory)
    @if(isset($categoryIds))
        <option class="{{$dash}}" value="{{$subCategory->id}}"  @if(in_array($subCategory->id, $categoryIds)) selected @endif
        value="{{$subCategory->id}}" >{{$dash}} {{ $subCategory->name['en'] ?? $subCategory->name['ru'] ?? $subCategory->name['am'] ?? '' }}</option>
        @if(count($subCategory->subSections))
            @include('admin.sections.subCategoryList_option',['subCategories' => $subCategory->subSections])
        @endif
    @else
        <option class="{{$dash}}" value="{{$subCategory->id}}">{{$dash}} {{ $subCategory->name['en'] ?? $subCategory->name['ru'] ?? $subCategory->name['am'] ?? '' }}</option>
        @if(count($subCategory->subSections))
            @include('admin.sections.subCategoryList_option',['subCategories' => $subCategory->subSections])
        @endif
    @endif
@endforeach

