<?php

namespace App\Http\Livewire\LeftMenu;

use App\Models\Kriteria;
use Livewire\Component;

class LeftMenu extends Component
{
    public $menus = [];

    public function mount()
    {
        $this->menus = [
            [
                'name' => 'Dashboard',
                'type' => 'single',
                'url' => route('main'),
                'icon' => 'la flaticon-home',
                'subItem' => [
                    [
                        'name' => '',
                        'url' => ''
                    ]
                ]
            ],
            [
                'name' => 'Kriteria',
                'type' => 'dropdown',
                'url' => 'kriterias',
                'icon' => 'la flaticon-file-1',
                'subItem' => [
                    [
                        'name' => 'List Kriteria',
                        'url' => route('kriterias.index'),
                        'icon' => 'la flaticon-list',
                    ],
                    [
                        'name' => 'Tambah Kriteria',
                        'url' => route('kriterias.create'),
                        'icon' => 'la flaticon-add'
                    ]
                ]
            ],
            [
                'name' => 'Alternatif',
                'type' => 'dropdown',
                'url' => 'alternatifs',
                'icon' => 'la flaticon-file-1',
                'subItem' => [
                    [
                        'name' => 'List Alternatif',
                        'url' => route('alternatifs.index'),
                        'icon' => 'la flaticon-list',
                    ],
                    [
                        'name' => 'Tambah Alternatif',
                        'url' => route('alternatifs.create'),
                        'icon' => 'la flaticon-add'
                    ]
                ]
            ],
            [
                'name' => 'Perhitungan',
                'type' => 'section',
                'url' => '#',
                'icon' => '',
                'subItem' => [
                    [
                        'name' => '',
                        'url' => ''
                    ]
                ]
            ],
            [
                'name' => 'SAW',
                'type' => 'single',
                'url' => route('saw.index'),
                'icon' => 'la flaticon-home',
                'subItem' => [
                    [
                        'name' => '',
                        'url' => ''
                    ]
                ]
            ],
        ];
    }

    public function render()
    {
        return view('livewire.left-menu.left-menu');
    }
}
