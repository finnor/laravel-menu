<div class="accordion side-menu" id="accordion-side-menu">
    @foreach($menus as $menu)
        @php
            $isMenuActive = isset($menu->active) && $menu->active;
            $encodedName = str_replace(' ', '', $menu->name);
        @endphp
        <div class="card">
            <h6 class="card-header{{($isMenuActive) ? ' bg-primary text-white' : ' bg-white'}}" id="heading{{ $encodedName }}">
                @if($menu->options->count()>0 && (! is_null($menu->action)))
                    <div class="d-flex align-items-center pointer">
                        <i data-toggle="collapse" data-target="#collapse{{ $encodedName }}" class="mr-1 py-2 pl-2 fas fa-chevron-{{$isMenuActive ? 'down' : 'right collapsed'}}"></i>
                        <a href="{{action($menu->action)}}" class="w-100 py-2">
                            @if(! is_null($menu->icon))
                                <i class="{{$menu->icon}} pr-1"></i>
                            @endif
                            {{ $menu->name }}
                        </a>
                    </div>
                @elseif($menu->options->count()>0 && is_null($menu->action))
                    <div data-toggle="collapse" data-target="#collapse{{ $encodedName }}" class="d-flex align-items-center pointer py-2{{$isMenuActive ? '' : ' collapsed'}}">
                        <i class="mr-1 pl-2 fas fa-chevron-{{$isMenuActive ? 'down' : 'right'}}"></i>
                        @if(! is_null($menu->icon))
                            <i class="{{$menu->icon}} pr-1"></i>
                        @endif
                        {{ $menu->name }}
                    </div>
                @elseif(! is_null($menu->action))
                    <div class="d-flex align-items-center pointer">
                        <a href="{{action($menu->action)}}" class="d-flex align-items-center w-100 pl-3 py-2">
                            @if(! is_null($menu->icon))
                                <i class="{{$menu->icon}} pr-1"></i>
                            @endif
                            {{ $menu->name }}
                        </a>
                    </div>
                @else
                    <div class="d-flex align-items-center pointer">
                        <div class="pl-3 py-2">
                            @if(! is_null($menu->icon))
                                <i class="{{$menu->icon}} pr-1"></i>
                            @endif
                            {{ $menu->name }}
                        </div>
                    </div>
                @endif
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