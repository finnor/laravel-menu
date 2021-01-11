<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" title="Main Menu">Main Menu</a>
<div class="dropdown-menu">
    @foreach($menu as $option)
        <a class="dropdown-item" href="{{(! is_null($option->action)) ? action($option->action) : '#' }}">
            @if(isset($option->icon))
                <i class="{{$option->icon}}"></i>
                {{$option->name}}
            @endif
        </a>
    @endforeach
</div>