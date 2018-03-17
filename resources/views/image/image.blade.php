<div class="col-12 col-md-3 pull-left text-center mb-1">

    {{--image--}}
    <a class="is-popup text-center" href="{{ asset($image->filepath) }}">
        <img class="rounded img-fluid"
             src="{{ powerimage(asset($image->filepath), ['w'=> 300, 'h' => 300, 'fit' => 'crop'])  }}"
             alt="">
    </a>

    {{--copyright information--}}
    @if (!empty($image->copyright_source_url))
            <small>
                <a target="_blank" href="{{ $image->copyright_source_url }}" rel="nofollow">
                    {{ $image->copyright_title }}
                </a>
                / {{ $image->copyright_author }} /
                <a target="_blank" href="{{ $image->copyright_license_url }}" rel="nofollow">
                    {{ $image->copyright_license_tag }}
                </a>
                @if(!empty($image->copyright_modification))
                    / {{ $image->copyright_modification }}
                @endif
            </small>
    @elseif (!empty($image->copyright_simple))
            <small>{{ $image->copyright_simple }}</small>
    @endif

</div>