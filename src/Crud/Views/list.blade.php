@extends('app')

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
                <p class="col-md-12">

                <table class="table table-striped table-border is-datatables clearfix" cellspacing="0" width="100%"
                       data-lang="{{ App::getLocale() }}">
                    <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <th class="">{{ $column['label'] }}</th>
                        @endforeach
                        <th class="col-md-4">{{ trans('crud::crud.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($entries as $entry)
                        <tr>
                            @foreach ($columns as $column)
                                @if(method_exists($entry, $column['modelValue']))
                                    <td>{{ $entry->{$column['modelValue']}() }}</td>
                                @else
                                    <td>{{ $entry->{$column['modelValue']} }}</td>
                                @endif
                            @endforeach
                            <td>
                                @if($permissions['show'])
                                    <a class="crud-control-buttons pull-left btn btn-default btn-sm"
                                       href="{{ $entry->showUrl  }}">
                                        <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span>
                                        {{ trans('crud::crud.show') }}
                                    </a>
                                @endif
                                @if($permissions['edit'])
                                    <a class="crud-control-buttons pull-left btn btn-info btn-sm "
                                       href="{{ $entry->editUrl  }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        {{ trans('crud::crud.edit') }}
                                    </a>
                                @endif
                                @if($permissions['destroy'])
                                    <form method="POST" action="{{ $entry->destroyUrl  }}" accept-charset="UTF-8"
                                          class="pull-left">
                                        <input name="_method" type="hidden" value="DELETE">
                                        {{ csrf_field() }}
                                        <button class="crud-control-buttons btn btn-danger btn-sm" type="submit">
                                            <span class="glyphicon glyphicon-remove"
                                                  aria-hidden="true"></span> {{ trans('crud::crud.delete') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                @if($permissions['create'])
                    <p class="text-right">
                        <a class="btn btn-primary btn-sm" href="{{ $create['url'] }}">
                            {{ $create['text'] }}
                        </a>
                    </p>
                @endif

            </div>
        </div>

    </div>
    </div>
    </div>
@endsection