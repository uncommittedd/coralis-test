<?php

namespace App\Controllers;

use App\Models\Users;

class Login extends BaseController
{
    public function index()
    {
        return view('pages/login');
    }

    public function auth()
    {
        $session = session();
        $model = new Users();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $data_session = [
                    'id'       => $data['id'],
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'logged_in'     => TRUE
                ];
                $session->set($data_session);
                return redirect()->to(base_url() . '/dashboard');
            } else {
                $this->session->setFlashdata('message', '<div class="alert alert-danger mb-3" role="alert">wrong password!</div>');
                return redirect()->to(base_url() . '/login');
            }
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger mb-3" role="alert">Email not Found!</div>');
            return redirect()->to(base_url() . '/login');
        }
    }
}
