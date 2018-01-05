<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Models\Article;
use App\Repositories\ArticlesRepository;
use App\Repositories\ImagesRepository;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    protected $articlesRepo;
    protected $imagesRepo;

    /**
     * ArticlesController constructor.
     */
    public function __construct(ArticlesRepository $articlesRepo, ImagesRepository $imagesRepo)
    {
        $this->articlesRepo = $articlesRepo;
        $this->imagesRepo = $imagesRepo;
        $this->middleware(['auth','admin'],['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allarticles = Article::orderBy('created_at','desc')->get();
        $articles = array();
        foreach ($allarticles as $key => $article){
            $timestamp = strtotime($article->created_at);
            $timekey = date('Y年m月',$timestamp);
            $article->date = date('m月d日',$timestamp);
            $article->index = $key;
            $articles[$timekey][] = $article;
        }
        return view('index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        $this->articlesRepo->createArticle($request);
        return redirect()->back()->with('success','发布文章成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $article = Article::where('uuid',$uuid)->firstOrFail();
        $article->viewnum++;
        $article->save();
        $page_title = $article->title;
        $wx = array(
            'title' => str_replace("\"","'",$page_title),
            'desc' => trim(str_replace(array(" ","　","\t","\n","\r"),"",$article->excerpt)),
            'link' => 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
            'imgUrl' => 'https://'.config('filesystems.disks.qiniu.domain').'/logo.png'
        );
        return view('articles.show',compact('article','page_title','wx'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $article = Article::where('uuid',$uuid)->firstOrFail();
        return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(EditArticleRequest $request, $uuid)
    {
        $this->articlesRepo->editArticle($request,$uuid);
        return redirect()->back()->with('success','编辑文章成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $this->articlesRepo->deleteArticle($uuid);
        return redirect('/')->with('success','删除文章成功！');
    }

    /**
     * 上传图片文件到七牛
     */
    public function uploadImg(Request $request){
        if(!$request->hasFile('editormd-image-file')){
            return response()
                ->json(['success' => 0, 'message' => '图片上传失败', 'url' => '']);
        }
        $url = $this->imagesRepo->uploadImg($request);
        return response()
            ->json(['success' => 1, 'message' => '图片上传成功', 'url' => $url]);
    }
}
