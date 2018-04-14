<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'uuid', 'column', 'excerpt','content','content_html'
    ];

    /**
     * 生成摘要
     *
     * @param $body
     * @return string
     * @throws \Exception
     */
    public static function makeExcerpt($body)
    {
        $Extra = new \ParsedownExtra();
        $html = $Extra->text($body);
        $excerpt = trim(preg_replace('/\s\s+/', ' ', strip_tags($html)));
        return str_limit($excerpt, 200);
    }
}
