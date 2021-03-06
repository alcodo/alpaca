<nav class="navbar navbar-expand-md navbar-light alpaca-header">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            {{--Left navbar side--}}
            @include('alpaca::navbar.left')

            {{--Right navbar side--}}
            @include('alpaca::navbar.right')

            {{--Block for mobile view--}}
            <div class="d-sm-block d-md-none">

                <hr>
                {!! Block::getMobileMenuBlocks() !!}

            </div>

        </div>
    </div>
</nav>