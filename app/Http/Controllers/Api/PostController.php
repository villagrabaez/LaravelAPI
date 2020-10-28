<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResources;
use App\Http\Resources\PostCollection;
use App\Http\Requests\Post as PostRequests;

class PostController extends Controller
{
    protected $post;

    /**
     * 1XX: ERRORES INFORMATIVOS
     * 2XX: EXITO
     * 3XX: REDIRECCION
     * 4XX: ERRORES DEL CLIENTE "NAVEGADOR"
     * 5XX: ERRORES DEL SERVIDOR
     */

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new PostCollection($this->post->orderBy('id', 'desc')->get()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequests $request)
    {
        $post = $this->post->create($request->all());

        return response()->json(new PostResources($post), 201); // status 201: Recurso creado correctamente
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json(new PostResources($post), 200);
        /*
            return [
                'id'        => $post->id,
                'post_name' => strtoupper($post->title),
                'post_body' => strtoupper(substr($post->body, 0, 240) . "..."),
            ];
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequests $request, Post $post)
    {
        $post->update($request->all());

        return response()->json(new PostResources($post), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204); // status 204: recurso eliminado correctamente
    }
}
