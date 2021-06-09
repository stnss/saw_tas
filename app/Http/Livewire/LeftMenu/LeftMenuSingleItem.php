<?php

namespace App\Http\Livewire\LeftMenu;

use Livewire\Component;

class LeftMenuSingleItem extends Component
{
    public $data = [];
    
    public function render()
    {
        return view('livewire.left-menu.left-menu-single-item');
    }
}
