<?php

namespace App\Controllers;

use App\Models\Post;
use CodeIgniter\Controller;

class PostController extends Controller
{
    public function index()
    {
        // Eloquent: traz todos os posts
        $posts = Post::all();

        return view('posts/index', ['posts' => $posts]);
    }

    public function create()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }
        return view('posts/create');
    }

    public function store()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        helper(['form']);

        $imageName = null;

        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName(); // Nome seguro e único
            $file->move(FCPATH . 'uploads', $imageName); // Salva em /public/uploads
        }

        $data = [
            'user_id' => session()->get('user_id'),
            'title'   => $this->request->getPost('title'),
            'image'   => $imageName,
            'content' => $this->request->getPost('content'),
        ];

        Post::create($data); // Eloquent

        return redirect()->to('/dashboard');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts/show', ['post' => $post]);
    }

    public function edit($id)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }
        $post = Post::findOrFail($id);

        return view('posts/edit', ['post' => $post]);
    }

    public function update($id)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        helper(['form']);

        $post = Post::findOrFail($id);

        $post->title   = $this->request->getPost('title');
        $post->content = $this->request->getPost('content');
        $post->user_id = session()->get('user_id');

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $imageName);
            $post->image = $imageName;
        }

        $post->save(); // Eloquent

        return redirect()->to('/dashboard');
    }

    public function delete($id)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $post = Post::findOrFail($id);
        $post->delete(); // Eloquent

        return redirect()->to('/dashboard');
    }
}
