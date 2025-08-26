<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Cms\Page;

class PageSeed extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug->en' => 'how-it-works'], // lookup po EN da ne dupliramo
            [
                'slug' => [
                    'sr-Latn-RS' => 'kako-funkcionise',
                    'sr-Cyrl-RS' => 'како-функционише',
                    'en'         => 'how-it-works',
                ],
                'title' => [
                    'sr-Latn-RS' => 'Kako funkcioniše',
                    'sr-Cyrl-RS' => 'Како функционише',
                    'en'         => 'How it works',
                ],
                'body' => [
                    'sr-Latn-RS' => 'Ovo je demo strana sa prevodom (latinica).',
                    'sr-Cyrl-RS' => 'Ово је демо страна са преводом (ћирилица).',
                    'en'         => 'This is a demo page with translations.',
                ],
                'published_at' => now(),
            ]
        );
    }
}
