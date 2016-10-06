{{ trans('contact::contact.send_from', ['Name' => Config::get('app.name')]) }}

<br/><br/>
{{ trans('contact::contact.name') }}: {{ $name }}<br/>
{{ trans('contact::contact.email') }}: {{ $email }}<br/>
{{ trans('contact::contact.subject') }}: {{ $subject }}<br/>
<br/>
<br/>
{{ trans('contact::contact.message') }}:<br/>
{{ $text }}