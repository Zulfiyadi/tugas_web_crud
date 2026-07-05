<?php

namespace App\Controllers;

use App\Models\User;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $rules = [
                'username' => 'required|min_length[3]|max_length[50]',
                'password' => 'required|min_length[6]',
            ];

            $messages = [
                'username' => [
                    'required' => 'Username wajib diisi.',
                    'min_length' => 'Username minimal 3 karakter.',
                    'max_length' => 'Username maksimal 50 karakter.',
                ],
                'password' => [
                    'required' => 'Password wajib diisi.',
                    'min_length' => 'Password minimal 6 karakter.',
                ],
            ];

            if ($this->validate($rules, $messages)) {
                $username = trim($this->request->getPost('username'));
                $password = $this->request->getPost('password');

                $user = $this->userModel->where('username', $username)->first();

                if ($user && password_verify($password, $user['password'])) {
                    session()->set([
                        'user_id'   => $user['id'],
                        'username'  => $user['username'],
                        'logged_in' => true,
                    ]);

                    return redirect()->to('/');
                }

                $this->validator->setError('password', 'Username atau password salah.');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('error', 'Username atau password salah!');
        }

        return $this->view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }

    public function register()
    {
        if ($this->request->is('post')) {
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];

            if ($this->userModel->insert($data)) {
                return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil! Silakan login.');
            } else {
                return redirect()->back()->with('error', 'Registrasi gagal!');
            }
        }

        return $this->view('auth/register');
    }
}
