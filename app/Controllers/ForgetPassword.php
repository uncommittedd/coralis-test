<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\UserToken;

class ForgetPassword extends BaseController
{
    public function index()
    {
        return view('pages/forget_password');
    }

    public function submit_forget_password()
    {
        $email = $this->request->getVar('email');

        $model = new Users();

        $data = $model->where('email', $email)->first();

        if ($data === null) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger mb-3" role="alert">Email not found!</div>');
            return redirect()->to(base_url() . '/forget-password');
        }

        $model_user_token = new UserToken();
        $token_from_table = $model_user_token->where('email', $data['email'])->first();
        $tempt_token = base64_encode(random_bytes(32));

        if ($token_from_table == null) {
            $data_for_token = [
                'email' => $data['email'],
                'token' => $tempt_token
            ];
            $model_user_token->save($data_for_token);
            $token = $tempt_token;
        } else {
            $token = $token_from_table['token'];
        }

        $message = "Click here to update your password " . base_url() . "/update-password?email=" . $data['email'] . "&token=" . $token;
        $email = \Config\Services::email();
        $email->setFrom('lminerale362@gmail.com', 'Le Minerale');
        $email->setTo($data['email']);
        $email->setSubject('Forget password');
        $email->setMessage($message);

        if ($email->send()) {
            $this->session->setFlashdata('message', '<div class="alert alert-success mb-3" role="alert">Email successfully sent! please check your inbox or spam folder.</div>');
            return redirect()->to(base_url() . '/forget-password');
        } else {
            $this->session->setFlashdata('message', '<div class="alert alert-danger mb-3" role="alert">Email unsuccessfully sent!</div>');
            return redirect()->to(base_url() . '/forget-password');
        }
    }
}
