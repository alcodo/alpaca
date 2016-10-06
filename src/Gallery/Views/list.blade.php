@extends('app')

@section('scripts')
    <script defer src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <h1>{{ $title }}</h1>

            <div class="row">
                <div class="col-md-9">
                    <p class="text-muted">{{ $description }}</p>

                </div>
                @if($permissions['create'])
                    <div class="col-md-3">

                        <p class="text-right">
                            <a class="btn btn-primary btn-sm" href="{{ $create['url'] }}">
                                {{ $create['text'] }}
                            </a>
                        </p>

                    </div>
                @endif
            </div>

            <div class="row">
                @foreach ($entries as $index => $entry)

                    <div class="col-md-3 col-sm-4 col-xs-6" style="padding-bottom: 15px;">
                        @include('gallery::wrapperGallery', ['image' => $entry])

                        <a data-toggle="modal" data-target="#galleryModal-{{$index}}"
                           title="{{ trans('gallery::gallery.bind') }}"
                           class="btn btn-sm btn-success pull-left" href="#">
                            <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                        </a>

                        @if($permissions['show'])
                            <a class="crud-control-buttons pull-left btn btn-default btn-sm"
                               title="{{ trans('crud::crud.show') }}"
                               href="{{ $entry->showUrl  }}">
                                <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span>

                            </a>
                        @endif
                        @if($permissions['edit'])
                            <a class="crud-control-buttons pull-left btn btn-info btn-sm"
                               title="{{ trans('crud::crud.edit') }}"
                               href="{{ $entry->editUrl  }}">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                        @endif
                        @if($permissions['destroy'])
                            <form method="POST" action="{{ $entry->destroyUrl  }}" accept-charset="UTF-8"
                                  class="pull-left">
                                <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}
                                <button class="crud-control-buttons btn btn-danger btn-sm" type="submit">
                                            <span class="glyphicon glyphicon-remove"
                                                  title="{{ trans('crud::crud.delete') }}"
                                                  aria-hidden="true"></span>
                                </button>
                            </form>
                        @endif

                        <div class="modal fade" id="galleryModal-{{$index}}" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            {{ trans('gallery::gallery.html') }}
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                                <pre class="prettyprint">
{{ $entry->getHtmlOutput() }}
                                                </pre>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            {{ trans('gallery::gallery.close') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                @endforeach
            </div>

            <div class="row">
                @if($permissions['create'])
                    <div class="col-md-12">

                        <p class="text-right">
                            <a class="btn btn-primary btn-sm" href="{{ $create['url'] }}">
                                {{ $create['text'] }}
                            </a>
                        </p>

                    </div>
                @endif
            </div>

        </div>

    </div>
@endsection