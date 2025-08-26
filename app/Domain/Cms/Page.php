<?php
namespace App\Domain\Cms;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    protected $fillable = ['slug','title','body','meta_title','meta_description','published_at'];

    public $translatable = ['slug','title','body','meta_title','meta_description'];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
