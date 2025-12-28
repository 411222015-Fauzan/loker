<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Dijalankan SEBELUM controller
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1️⃣ Jika belum login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // 2️⃣ Jika route membutuhkan role tertentu
        if ($arguments !== null) {
            $userRole = session()->get('role');

            // Jika role user tidak sesuai
            if (!in_array($userRole, $arguments)) {
                return redirect()->to('/dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
            }
        }
    }

    /**
     * Dijalankan SETELAH controller
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak digunakan
    }
}
