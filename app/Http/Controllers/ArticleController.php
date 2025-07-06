<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;



class ArticleController extends Controller 
{
    public function __construct()
    {
        $this->middleware('permission:view articles')->only('index');
        $this->middleware('permission:edit articles')->only('edit', 'update');
        $this->middleware('permission:create articles')->only('create', 'store');
        $this->middleware('permission:delete articles')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles= Article::latest()->paginate(10); //order by created_at DES
        return view ('articles.list' , compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request-> validate([
            'title' => 'required|min:5',
            'author' => 'required|min:5'
        ]);

        if($validated){
            $article= new Article();
            $article->title= $request->title;
            $article->text= $request->text;
            $article->author= $request->author;
            $article-> save();

            return redirect()->route('articles.index')->with('success', 'Article added successfully');

        }else{
            return redirect()->route('articles.create')->withInput()->withError($validated);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $article= Article::findOrFail($id);
        return view('articles.edit' , ['ourArticle'=> $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        

            $validated = $request-> validate([
            'title' => 'required|min:5',
            'author' => 'required|min:5'
        ]);

        if($validated){
            $article= Article::findOrFail($id);
            $article->title= $request->title;
            $article->text= $request->text;
            $article->author= $request->author;
            $article-> save();

            return redirect()->route('articles.index')->with('success', 'Article updated successfully');

        }else{
            return redirect()->route('articles.edit')->withInput()->withError($validated);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $article= Article::findOrFail($id);
        $article-> delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');

    }
}
