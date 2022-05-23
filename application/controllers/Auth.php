<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('auth_model', 'auth');
    }
    // ------------------------------------ login page ---------------------
    public function index()
    {
        //jika session sudah ada email
        if ($this->session->has_userdata('email')) {

            redirect('admin/dashboard');
        }
        // validasi email
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email tidak boleh kosong!',
            'valid_email' => 'Email tidak valid!'
        ]);
        // validasi password
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password tidak boleh kosong!',
        ]);

        if ($this->form_validation->run() == false) { // jika form validasi salah

            $data['title'] = 'Login Page';

            $this->load->view('v_auth_login', $data); // load view

        } else {

            $dt['email']     = $this->input->post('email');
            $dt['password']  = $this->input->post('password');

            $this->auth->getLoginData($dt);
        }
    }

    // ------------------------------------ cek profile ------------------

    public function profile()
    {
        $data['title'] = 'Profile';

        $this->render('user/profile', $data);
    }

    // ------------------------ End cek profile---------------------------

    // ------------------------------------- logout---------------------------------
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil keluar!</div>');
        redirect('auth');
    }

    // ---------------------------------  end logout ---------------------------------

}
