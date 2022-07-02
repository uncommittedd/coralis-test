<?php

namespace App\Controllers;

use App\Models\Users;

class Dashboard extends BaseController
{
    public function index()
    {
        $data_session = $this->session->get();

        $model = new Users();
        $data = $model->where('id', $data_session['id'])->first();
        return view('pages/dashboard', $data);
    }

    public function sign_out()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url() . '/');
    }
}
