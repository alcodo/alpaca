@extends('alpaca::layout')

@section('content')

    {{--create--}}
    <a href="#" class="btn btn-info float-right" v-b-modal.modalcreatemenu>
        {{ trans('alpaca::block.create_block') }}
    </a>
{{--    @include('alpaca::menu.sub.create')--}}



    {{--$menus = Menu::orderBy('title', 'asc')->pluck('title', 'id');--}}
    {{--$menus->prepend(trans('menu::menu.no_menu'), '');--}}

    {{--$formFields = [--}}
    {{--'id' => $form->hidden('id'),--}}
    {{--'name' => $form->text(trans('crud::crud.name'), 'name'),--}}
    {{--'title' => $form->text(trans('crud::crud.title'), 'title'),--}}
    {{--'active' => $form->checkbox(trans('page::page.active'), 'active')->defaultToChecked(),--}}
    {{--'mobile_view' => $form->checkbox(trans('block::block.mobile_view'), 'mobile_view')->defaultToChecked(),--}}
    {{--'desktop_view' => $form->checkbox(trans('block::block.desktop_view'), 'desktop_view')->defaultToChecked(),--}}
    {{--'desktop_view_force' => $form->checkbox(trans('block::block.desktop_view_force'), 'desktop_view_force'),--}}
    {{--'area' => $form->select(trans('block::block.area'), 'area')--}}
    {{--->options($this->getAreaChoice())--}}
    {{--->select($selectedArea),--}}
    {{--'range' => $form->select(trans('block::block.range'), 'range')--}}
    {{--->options(Block::RANGES)--}}
    {{--->select($selectedRange),--}}
    {{--'menu_id' => $form->select(trans('menu::menu.menu'), 'menu_id')--}}
    {{--->options($menus)--}}
    {{--->select($selectedMenu),--}}
    {{--'html' => $form->textarea(trans('crud::crud.body'), 'html')->addClass('is-summernote'),--}}

    {{--// exception--}}
    {{--'exception_rule_exclude' => $form->radio(trans('block::block.exclude_site'), 'exception_rule', Block::EXCEPTION_EXCLUDE)->checked(),--}}
    {{--'exception_rule_only' => $form->radio(trans('block::block.include_site'), 'exception_rule', Block::EXCEPTION_ONLY),--}}
    {{--'exception' => $form->textarea(trans('block::block.exception'), 'exception')--}}
    {{--->helpBlock(trans('block::block.exception_help_text')),--}}


{{----}}
    {{--<h1>--}}
        {{--{{ trans('alpaca::menu.menu_index') }}--}}
    {{--</h1>--}}

    {{--<div class="row">--}}
        {{--@foreach($menus as $menu)--}}

            {{--<div class="col-sm-6">--}}
                {{--<div class="card" style="border: 1px solid silver">--}}
                    {{--<div class="card-header">--}}
                        {{--{{ $menu->title }}--}}
                        {{--@include('alpaca::menu.sub.action')--}}
                    {{--</div>--}}

                    {{--links--}}
                    {{--@if($menu->links->isEmpty())--}}
                        {{--<div class="card-body">--}}
                            {{--{{ trans('alpaca::menu.no_links_exists') }}--}}
                        {{--</div>--}}
                    {{--@else--}}
                        {{--<ul class="list-group list-group-flush">--}}
                            {{--@foreach($menu->links as $link)--}}

                                {{--<div class="list-group-item">--}}
                                    {{--@include('alpaca::menu.link.link', ['link' => $link, 'class' => ''])--}}
                                    {{--@include('alpaca::menu.link.action')--}}
                                {{--</div>--}}

                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--@endif--}}
                    {{--<div class="card-footer">--}}

                        {{--<a href="#" class="btn btn-info btn-sm float-right" title="{{ trans('alpaca::alpaca.link') }}"--}}
                           {{--v-b-modal.modalcreatelink{{ $menu->id }}>--}}
                            {{--<i class="fa fa-plus" aria-hidden="true"></i> {{ trans('alpaca::alpaca.link') }}--}}
                        {{--</a>--}}
                        {{--@include('alpaca::menu.link.create', ['menu' => $menu])--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--@endforeach--}}
    {{--</div>--}}

@endsection