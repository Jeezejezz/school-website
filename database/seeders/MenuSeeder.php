<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'title' => 'Home',
                'route_name' => 'home',
                'icon' => 'fas fa-home',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'About Us',
                'route_name' => 'about',
                'icon' => 'fas fa-info-circle',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Academics',
                'route_name' => 'academics',
                'icon' => 'fas fa-graduation-cap',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Gallery',
                'route_name' => 'gallery',
                'icon' => 'fas fa-images',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'News',
                'route_name' => 'news',
                'icon' => 'fas fa-newspaper',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Contact',
                'route_name' => 'contact',
                'icon' => 'fas fa-envelope',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['title' => $menu['title']],
                $menu
            );
        }
    }
}
