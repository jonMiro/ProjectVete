<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;

class PostsWorkersController extends Controller
{
    public function index()
    {
        $guias = Post::where('tipo', 'guia')->with('user')->get();
        $anuncios = Post::where('tipo', 'anuncio')->with('user')->get();
        $experiencias = Post::where('tipo', 'experiencia')->with('user')->get();

        return Inertia::render('PostsWorkers/Index', [
            'guias' => $guias,
            'anuncios' => $anuncios,
            'experiencias' => $experiencias,
        ]);
    }
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('postsworkers.index')->with('success', '¡Post eliminado correctamente!');


    }


    }


