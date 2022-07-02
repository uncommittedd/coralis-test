<?php

namespace App\Controllers;

use App\Models\Users;

class Register extends BaseController
{
    public function index()
    {
        return view('pages/register');
    }

    public function save()
    {
        $email = $this->request->getVar('email');
        $name = $this->request->getVar('name');
        $password = $this->request->getVar('password');
        $image = $this->request->getFile('image');

        $rules = [
            'email' => 'required|is_unique[users.email]|valid_email',
            'name' => 'required',
            'password' => 'required|min_length[8]',
            'image' => 'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]'
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url() . '/register')->withInput()->with('validation', $validation);
        }

        if ($image->getError() == 4) {
            $random_name = 'default-images.png';
        } else {
            $random_name = $image->getRandomName();
            $image->move('assets/images', $random_name);
        }

        $data = [
            'email' => $email,
            'name' => $name,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'image_profile' => $random_name
        ];

        $model = new Users();
        $model->save($data);

        $this->session->setFlashdata('message', '<div class="alert alert-success mb-3" role="alert">Congratulations, you have successfully registered</div>');
        return redirect()->to(base_url() . '/login');
    }
}
