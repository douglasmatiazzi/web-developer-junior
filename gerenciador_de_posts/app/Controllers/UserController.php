<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Post;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function registerForm()
    {
        helper(['form']);
        return view('auth/register');
    }

    public function register()
    {
        helper(['form']);

        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validator,
            ]);
        }

        // Eloquent: cria novo usuário
        User::create([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login')->with('success', 'Conta criada com sucesso!');
    }

    public function loginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        helper(['form']);

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Eloquent: busca usuário pelo e-mail
        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            session()->set([
                'user_id'   => $user->id,
                'name'      => $user->name,
                'email'     => $user->email,
                'logged_in' => true,
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'E-mail ou senha inválidos.');
    }

    public function dashboard()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        // Carrega os posts com os dados do usuário relacionado
        $posts = Post::with('user')->get();

        return view('auth/dashboard', ['posts' => $posts]);
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
