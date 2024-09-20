@extends('admin.layouts.main')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <div class="">
            @include('admin.partials.errors')

            @include('admin.sections.includes.main_categories', ['sections' => $sections])
        </div>
    </main>

    @push('styles')
        <style>
            .card-header .title {
                font-size: 17px;
                color: #000;
            }

            .card-header .accicon {
                float: right;
                font-size: 20px;
                width: 1.2em;
            }

            .card-header {
                cursor: pointer;
                border-bottom: none;
            }

            .card {
                border: 1px solid #ddd;
            }

            .card-body {
                border-top: 1px solid #ddd;
            }

            .accicon:not(.collapsed) .rotate-icon {
                transform: rotate(180deg);
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://kit.fontawesome.com/a91a27e46f.js" crossorigin="anonymous"></script>
    @endpush

@endsection
