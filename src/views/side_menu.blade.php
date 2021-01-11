<div class="accordion side-menu" id="accordion-side-menu">
    @foreach($menus as $menu)
        @php
            $isMenuActive = isset($menu->active) && $menu->active;
            $encodedName = str_replace(' ', '', $menu->name);
        @endphp
        <div class="card">
            <h6 class="card-header{{($isMenuActive) ? ' bg-primary text-white' : ''}}" id="heading{{ $encodedName }}">
                <a data-toggle="collapse" data-target="#collapse{{ $encodedName }}" class="d-flex btn-block{{$isMenuActive ? '' : ' collapsed'}}">
                    @if(! is_null($menu->icon))
                        <i class="{{$menu->icon}}"></i>
                    @endif
                    {{ $menu->name }}
                    @if($menu->options->count()>0)
                        <i class="ml-auto fas fa-chevron-{{$isMenuActive ? 'down' : 'up'}}"></i></span>
                    @endif
                </a>
            </h6>
            @if($menu->options->count()>0)
                <div id="collapse{{ $menu->name }}" data-parent="#accordion-side-menu" class="collapse{{$isMenuActive ? ' show' : ''}}">
                    <div class="card-body">
                        <div class="side-menu-options">
                            @foreach($menu->options as $option)
                                <a href="{{ action($option->action) }}" class="dropdown-item{{ ((isset($option->active) && $option->active) ? ' active-menu-link' : '' )}}">
                                    {{ $option->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>