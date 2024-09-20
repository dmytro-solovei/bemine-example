<li>
    @if(isset($submenu['submenus']))
        <ul class="dropdown-menu">
            @foreach($submenu['submenus'] as $submenu)
                @include('partials.submenu', ['submenu' => $submenu])
            @endforeach
        </ul>
    @endif
</li>
