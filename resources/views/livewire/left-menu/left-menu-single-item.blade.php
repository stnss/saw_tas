<li class="nav-item {{ request()->url() === $data['url'] ? "active" : "" }}">
    <a href="{{ $data['url'] }}">
        <i class="{{ $data['icon'] }}"></i>
        <p>{{ $data['name'] }}</p>
        {{-- <span class="badge badge-success">4</span> --}}
    </a>
</li>