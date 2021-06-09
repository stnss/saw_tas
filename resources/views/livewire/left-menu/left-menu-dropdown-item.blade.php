<li class="nav-item">
    <a data-toggle="collapse" href="#{{ $data['url'] }}" class="collapsed" aria-expanded="{{ request()->segment(2) === $data['url'] ? "true" : "false"}}">
        <i class="{{ $data['icon'] }}"></i>
        <p>{{ $data['name'] }}</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ request()->segment(2) === $data['url'] ? "show" : ""}}" id="{{ $data['url'] }}">
        <ul class="nav nav-collapse">
            @foreach ($data['subItem'] as $item)
                <li class="{{ request()->url() === $item['url'] ? "active" : "" }}">
                    <a href="{{ $item['url'] }}">
                        <i class="{{ $item['icon'] }}"></i> {{ $item['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>
