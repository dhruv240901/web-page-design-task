<aside>
    <div class="side-nav-content">
        <ul class="nav-list">
            @foreach ($sidebarElements as $element)
                <li class="nav-list-item">
                    <i class="{{ $element['icon'] }}"></i>
                    <span>
                        <a href="#" class="sidenav-link">{{ $element['text'] }}</a>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
