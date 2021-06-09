<div class="sidebar-content">
    <div class="user">
        @livewire("left-menu.left-menu-user-item")
    </div>
    <ul class="nav nav-primary">
        @foreach ($menus as $menuItem)
            @livewire("left-menu.left-menu-{$menuItem['type']}-item", ['data' => $menuItem])
        @endforeach
    </ul>
</div>
