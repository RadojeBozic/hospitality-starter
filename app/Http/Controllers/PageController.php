<?php
namespace App\Http\Controllers;

use App\Domain\Cms\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function show(string $locale, string $slug)
    {
        // JSON path mora da citira ključeve sa crticama: $."sr-Latn-RS"
        $jsonPath = '$."'.$locale.'"';

        $page = Page::whereRaw(
            'JSON_UNQUOTE(JSON_EXTRACT(`slug`, ?)) = ?',
            [$jsonPath, $slug]
        )->firstOrFail();

        return Inertia::render('PageView', [
            'title' => $page->getTranslation('title', $locale),
            'body'  => $page->getTranslation('body',  $locale),
            'slug'  => $slug,
        ]);
    }
}
