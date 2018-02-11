<div class="row">

    @foreach($permissions as $module)

        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card mb-3" style="border: 1px solid silver;">
                <div class="card-header">
                    {{ $module->title }}
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($module->permissions as $perm)

                        <li class="list-group-item">

                            <div class="media">
                                <label class="media-body " for="{{ $role->id }}.{{ $module->slug }}.{{ $perm->name }}">
                                    {{ $perm->name }} <i v-b-tooltip.hover
                                                         title="ID: {{ $module->slug . '.' . $perm->slug }}"
                                                         class="fa fa-info-circle text-info"></i>
                                </label>
                                <div class="ml-4 form-check">
                                    <input type="hidden" value="0" name="{{ $module->slug }}[{{ $perm->slug }}]">
                                    <input class="form-check-input" type="checkbox"
                                           id="{{ $role->id }}.{{ $module->slug }}.{{ $perm->name }}"
                                           name="{{ $module->slug }}[{{ $perm->slug }}]"
                                           value="1"
                                           @if($role->hasPermissionTo($module->slug . '.' . $perm->slug))
                                           checked
                                            @endif>
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    @endforeach

</div>