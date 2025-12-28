<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $user = (new UserModel())
                ->where('email', $this->request->getPost('email'))
                ->first();

            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                session()->set([
                    'id'    => $user['id'],
                    'email' => $user['email'],
                    'role'  => $user['role'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/dashboard');
            }
            return redirect()->back()->with('error', 'Email atau Password salah');
        }
        return view('auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $role = $this->request->getPost('role');

            // Validasi
            if (!$email || !$password || !$role) {
                return redirect()->back()
                    ->with('error', 'Semua field harus diisi')
                    ->withInput();
            }

            if (strlen($password) < 6) {
                return redirect()->back()
                    ->with('error', 'Password minimal 6 karakter')
                    ->withInput();
            }

            if (!in_array($role, ['pelamar', 'perusahaan'])) {
                return redirect()->back()
                    ->with('error', 'Role tidak valid')
                    ->withInput();
            }

            // Cek email sudah terdaftar
            $userModel = new UserModel();
            $existingUser = $userModel->where('email', $email)->first();
            if ($existingUser) {
                return redirect()->back()
                    ->with('error', 'Email sudah terdaftar')
                    ->withInput();
            }
            
            // Insert user
            $result = $userModel->insert([
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $role,
                'status' => 'active'
            ]);

            if (!$result) {
                return redirect()->back()
                    ->with('error', 'Gagal menyimpan ke database')
                    ->withInput();
            }

            return redirect()->to('/login')
                ->with('success', 'Registrasi berhasil. Silakan login.');
        }

        return view('auth/register');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
