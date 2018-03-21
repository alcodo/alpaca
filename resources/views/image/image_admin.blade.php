<div class="card">
    <a class="is-popup text-center" href="{{ Storage::url($image->filepath) }}">
        <img class="img-fluid"
             src="{{ powerimage(Storage::url($image->filepath), ['w'=> 300, 'h' => 300, 'fit' => 'crop'])  }}" alt=""/>
    </a>

    @if (!empty($image->copyright_source_url))
        <div class="card-body">
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
        </div>
    @elseif (!empty($image->copyright_simple))
        <div class="card-body">
            <small>{{ $image->copyright_simple }}</small>
        </div>
    @endif


    @if($showAction)

        <div class="card-footer">
            @include('alpaca::image.sub.action', ['image' => $image])
        </div>

    @endif
</div>