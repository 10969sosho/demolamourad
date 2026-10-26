<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\NavMenu;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $content = json_decode((string) file_get_contents(database_path('content.json')), true);

        $settings = [
            'theme' => $content['theme'],
            'navbar.brandName' => $content['navbar']['brandName'],
            'navbar.brandSub' => $content['navbar']['brandSub'],
            'hero' => $content['hero'],
            'intro' => $content['intro'],
            'cta' => $content['cta'],
            'footer.about' => $content['footer']['about'],
            'footer.copyright' => $content['footer']['copyright'],
            'footer.socialLinks' => $content['footer']['socialLinks'],
            'footer.columns' => $content['footer']['columns'],
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        foreach ($content['navbar']['links'] as $i => $link) {
            NavMenu::create(['label' => $link['label'], 'href' => $link['href'], 'sort_order' => $i]);
        }

        foreach ($content['products'] as $i => $product) {
            Product::create($product + ['sort_order' => $i]);
        }

        foreach ($content['articles'] as $i => $article) {
            Article::create($article + ['sort_order' => $i]);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@liefmarket.com',
            'password' => 'password123',
        ]);
    }
}
