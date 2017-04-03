<?php

namespace App\Repositories;


use App\Models\Article;
use Webpatser\Uuid\Uuid;

class ArticlesRepository
{


    /**
     * 新建文章
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function createArticle($request)
    {
        Article::create([
            'title' => $request->title,
            'uuid' => Uuid::generate()->string,
            'excerpt' => Article::makeExcerpt($request->content),
            'content' => $request->content,
            'content_html' => $request->content_html,
        ]);
    }


    /**
     * 编辑文章
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function editArticle($request,$uuid)
    {
        $article = Article::where('uuid',$uuid)->firstOrFail();
        $article->title = $request->title;
        $article->excerpt = Article::makeExcerpt($request->content);
        $article->content = $request->content;
        $article->content_html = $request->content_html;
        $article->save();
    }


    /**
     * 删除文章
     *
     * @param  $uuid
     */
    public function deleteArticle($uuid)
    {
        Article::where('uuid',$uuid)->delete();
    }

}
