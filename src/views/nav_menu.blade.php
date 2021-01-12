<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="Main Menu">Main Menu</a>
<div class="dropdown-menu">
    @foreach($menus as $option)
        <a class="dropdown-item" href="{{(! is_null($option->action)) ? action($option->action) : '#' }}">
            @if(isset($option->icon))
                <i class="{{$option->icon}} pr-1"></i>
            @endif
            {{$option->name}}
        </a>
    @endforeach
</div>