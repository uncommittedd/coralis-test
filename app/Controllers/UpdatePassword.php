<?php

namespace App\Controllers;

use App\Models\UserToken;
use App\Models\Users;

class UpdatePassword extends BaseController
{
    public function index()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $model_user_token = new UserToken();

        $data = $model_user_token->where('email', $email)->first();

        if ($data == null) {
            return redirect()->to(base_url() . '/login');
        } else {
            if ($data['token'] != $token) {
                return redirect()->to(base_url() . '/login');
            } else {
                return view('pages/update_password', $data);
            }
        }
    }

    public function save()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $rules = [
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url() . '/login')->withInput()->with('validation', $validation);
        }

        $model_user = new Users();
        $model_user_token = new UserToken();
        $data_user = $model_user->where('email', $email)->first();

        $data = [
            'email' => $data_user['email'],
            'name' => $data_user['name'],
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'image_profile' => $data_user['image_profile']
        ];

        $model_user->update($data_user['id'], $data);
        $model_user_token->where('email', $email)->delete();

        $this->session->setFlashdata('message', '<div class="alert alert-success mb-3" role="alert">password successfully changed!</div>');
        return redirect()->to(base_url() . '/login');
    }
}
