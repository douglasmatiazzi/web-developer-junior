<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\Post;
use CodeIgniter\API\ResponseTrait;

class PostController extends BaseController
{
    use ResponseTrait;

    // GET /api/posts
    public function index()
    {
        $query = $this->request->getGet('q');
        $order = $this->request->getGet('order');
        $creatorId = $this->request->getGet('creator');

        $order = ($order === 'asc') ? 'asc' : 'desc';

        $posts = Post::with('user')
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                ->orWhere('content', 'like', "%$query%");
            })
            ->when($creatorId, function ($q) use ($creatorId) {
                $q->where('user_id', $creatorId);
            })
            ->orderBy('created_at', $order)
            ->get()
            ->map(function ($post) {
                $content = html_entity_decode($post->content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $post->content = str_replace(["\r", "\n", "\t"], '', $content);
                return $post;
            })
            ->toArray();

        return $this->response
            ->setContentType('application/json')
            ->setJSON($posts);
    }

    // GET /api/posts/{id}
    public function show($id = null)
    {
        // Usa with('user') para trazer o autor junto
        $post = Post::with('user')->find($id);

        if (!$post) {
            return $this->failNotFound('Post não encontrado.');
        }

        $content = html_entity_decode($post->content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $post->content = str_replace(["\r", "\n", "\t"], '', $content);

        return $this->respond($post);
    }

}
