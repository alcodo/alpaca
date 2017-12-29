    <a class="is-popup" href="{{ $image->filepath }}">
        <img class="thumbnail-img" src="{{ $image->filepath  }}?w=260&h=260&fit=crop" alt="{{ pathinfo($image->path, PATHINFO_FILENAME) }}" title="{{ $image->title or ''}}">
    </a>
    @if (!empty($image->copyright_source_url))
        <p class="thumbnail-caption">
        <small>
            <a target="_blank" href="{{ $image->copyright_source_url }}" rel="nofollow">{{ $image->copyright_title }}</a>
            / {{ $image->copyright_author }} /
            <a target="_blank" href="{{ $image->copyright_license_url }}" rel="nofollow">{{ $image->copyright_license_tag }}</a>
            @if(!empty($image->copyright_modification))
                / {{ $image->copyright_modification }}
            @endif
        </small>
        </p>
    @elseif (!empty($image->copyright_simple))
        <p class="thumbnail-caption"><small>{{ $image->copyright_simple }}</small></p>
    @endif