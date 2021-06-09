<div class="avatar-sm float-left mr-2">
    <img src="{{ asset('assets/img/profile.jpg') }}" alt="..."
        class="avatar-img rounded-circle">
</div>
<div class="info">
    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
        <span>
            {{ auth()->user()->name }}
            <span class="user-level">Administrator</span>
            <span class="caret"></span>
        </span>
    </a>
    <div class="clearfix"></div>

    <div class="collapse in" id="collapseExample">
        <ul class="nav">
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>
                {{-- <a href="#settings">
                    <span class="link-collapse">Settings</span>
                </a> --}}
            </li>
        </ul>
    </div>
</div>