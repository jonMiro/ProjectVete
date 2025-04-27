<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $guias = Post::where('tipo', 'guia')->with('user')->get();
        $anuncios = Post::where('tipo', 'anuncio')->with('user')->get();
        $experiencias = Post::where('tipo', 'experiencia')->with('user')->get();

        return Inertia::render('Posts/Index', [
            'guias' => $guias,
            'anuncios' => $anuncios,
            'experiencias' => $experiencias,
        ]);
    }

    public function myPosts()
{
    $guias = Post::where('tipo', 'guia')->where('user_id', Auth::id())->with('user')->get();
    $anuncios = Post::where('tipo', 'anuncio')->where('user_id', Auth::id())->with('user')->get();
    $experiencias = Post::where('tipo', 'experiencia')->where('user_id', Auth::id())->with('user')->get();

    return Inertia::render('Posts/Mypost', [
        'guias' => $guias,
        'anuncios' => $anuncios,
        'experiencias' => $experiencias,
    ]);
}



    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'tipo' => 'required|in:guia,anuncio,experiencia',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Si deseas incluir imagen
        ]);

        // Si se sube una imagen, la guardamos
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('images', 'public'); // Cambia el destino si es necesario
        }

        Post::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'tipo' => $request->tipo,
            'imagen' => $imagenPath ?? null,
            'user_id' => Auth::user()->id,
        ]);


        return redirect()->route('posts.myposts')->with('success', '¡Post creado exitosamente!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', '¡Post eliminado correctamente!');
    }
}
