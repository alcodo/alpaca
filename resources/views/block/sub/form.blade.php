{{ csrf_field() }}

<div class="form-group">
    <label for="title">{{ trans('alpaca::alpaca.title') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="title" name="title"
           value="{{ old('title', isset($block) ? $block->title : '') }}" required>
</div>

<div class="form-group">
    <label for="area">{{ trans('alpaca::block.area') }}<span class="text-danger">*</span></label>
    <select id="area" class="form-control" name="area" required>
        @foreach(\Alpaca\Models\Block::AREAS as $key => $value)
            <option value="{{ $key }}"
                    @if ($key == old('area', isset($block) ? $block->area : ''))
                    selected="selected"
                    @endif
            >{{ $value }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="position">{{ trans('alpaca::menu.position') }}<span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="position" name="position"
           value="{{ old('position', isset($block) ? $block->position : '') }}" required>
</div>

<b-tabs v-cloak>
    <b-tab title="Menu" active>

        <div class="form-group">
            <select id="menu_id" class="form-control" name="menu_id">
                @foreach($menues as $key => $value)
                    <option value="{{ $key }}"
                            @if ($key == old('menu_id', isset($block) ? $block->menu_id : ''))
                            selected="selected"
                            @endif
                    >{{ $value }}</option>
                @endforeach
            </select>
        </div>

    </b-tab>
    <b-tab title="{{ trans('alpaca::block.htmltext') }}">

        <div class="form-group">
            <textarea class="form-control" id="content" rows="15" name="html">
                {{ old('content', isset($block) ? $block->html : '') }}
            </textarea>
        </div>

    </b-tab>
</b-tabs>

<hr>


<div class="form-group row">
    <div class="col-sm-2">{{ trans('alpaca::block.exception') }}</div>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exception_rule" id="exception_rule1"
                   value="{{ \Alpaca\Models\Block::EXCEPTION_EXCLUDE }}"
                   @if (\Alpaca\Models\Block::EXCEPTION_EXCLUDE == old('exception_rule', isset($block) ? $block->exception_rule : ''))
                   checked
                    @endif>
            <label class="form-check-label" for="exception_rule1">
                {{ trans('alpaca::block.exclude_site') }}
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exception_rule" id="exception_rule2"
                   value="{{ \Alpaca\Models\Block::EXCEPTION_ONLY }}"
                   @if (\Alpaca\Models\Block::EXCEPTION_ONLY == old('exception_rule', isset($block) ? $block->exception_rule : ''))
                   checked
                    @endif>
            <label class="form-check-label" for="exception_rule2">
                {{ trans('alpaca::block.include_site') }}
            </label>
        </div>
    </div>
</div>


<div class="form-group">
    <label for="exception">{{ trans('alpaca::block.exception') }}</label>
    <textarea class="form-control" id="exception" rows="3" name="exception"></textarea>
    <small id="passwordHelpBlock" class="form-text text-muted">
        {{ trans('alpaca::block.exception_help_text') }}
    </small>
</div>

<div class="form-check">
    <label class="form-check-label">
        <input type="hidden" name="active" value="0">
        <input type="checkbox" class="form-check-input" name="active" value="1"
               @if(old('active', isset($block) ? $block->active : true) == true) checked @endif>
        {{ trans('alpaca::alpaca.active') }}
    </label>
</div>

<button type="submit" class="btn btn-info btn-block">{{ trans('alpaca::alpaca.save') }}</button>