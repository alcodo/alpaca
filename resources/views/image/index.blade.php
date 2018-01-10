@extends('alpaca::layout')

@section('scripts')
    <script defer src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
@endsection

@section('content')

    {{--create--}}
    <a href="#" class="btn btn-info float-right" v-b-modal.modalcreateimage>
        {{ trans('alpaca::image.add_image') }}
    </a>
    @include('alpaca::image.sub.create')


    <h1>
        {{ trans('alpaca::image.images') }}
    </h1>

    <div class="row">
        @foreach($images as $image)

            <div class="col-md-4 col-sm-6 col-xs-12">
                @include('alpaca::image.image', ['image' => $image, 'showAction' => true])
            </div>

        @endforeach
    </div>

@endsection