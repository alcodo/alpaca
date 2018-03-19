{{ trans('alpaca::contact.send_from', ['Name' => Config::get('app.name')]) }}

<br/><br/>
{{ trans('alpaca::contact.name') }}: {{ $name }}<br/>
{{ trans('alpaca::contact.email') }}: {{ $email }}<br/>
{{ trans('alpaca::contact.subject') }}: {{ $subject }}<br/>
<br/>
<br/>
{{ trans('alpaca::contact.message') }}:<br/>
{{ $text }}