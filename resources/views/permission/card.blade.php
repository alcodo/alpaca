<div class="row">

    @foreach($permissions as $module)

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card" style="border: 1px solid silver;">
                <div class="card-header">
                    {{ $module->title }}
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($module->permissions as $perm)

                        <li class="list-group-item">

                            <div class="media">
                                <label class="media-body " for="{{ $module->slug }}.{{ $perm->name }}">
                                    {{ $perm->name }}
                                </label>
                                <div class="ml-4 form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="{{ $module->slug }}.{{ $perm->name }}"
                                           id="{{ $module->slug }}.{{ $perm->name }}">
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    @endforeach

</div>
