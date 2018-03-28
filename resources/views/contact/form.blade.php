@extends('alpaca::layout')

@section('content')
    <h1>{{ trans('alpaca::contact.contact') }}</h1>

    <form action="{{ config('alpaca.contact.path') }}" method="post" accept-charset="UTF-8">
        {!! Honeypot::generate('form_name', 'form_time')  !!}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">{{ trans('alpaca::contact.name') }}<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">{{ trans('alpaca::contact.email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="subject">{{ trans('alpaca::contact.subject') }}</label>
            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}">
        </div>


        <div class="form-group">
            <label for="text">{{ trans('alpaca::contact.message') }}<span class="text-danger">*</span></label>
            <textarea class="form-control" id="text" rows="15" name="text" required>
                {{ old('text') }}
            </textarea>
        </div>

        <button type="submit" class="btn btn-primary float-right">{{ trans('alpaca::contact.send') }}</button>

    </form>

@endsection
