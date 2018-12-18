<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news.index', [
            'News' => News::active()->orderBy('pubDate','desc')->paginate(10)
        ]);
    }
    
    /**
     * Display a listing of the resources, paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiPaginate()
    {

        try {
            $news = News::active()->orderBy('pubDate','desc')->paginate(10);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => "Nenhuma notícia encontrada"], 404);
        }
        return $news;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $news = News::active()->findorFail($request->id);
        return view('news.show', ['news' => $news]);
    }

    /**
     * Display the specified resource as JSON format
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function showJSON(Request $request)
    {
        //
        try {
            $news = News::active()->findorFail($request->id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => "Notícia não existe"], 404);
        }
        return $news;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
