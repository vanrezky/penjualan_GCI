<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model', 'admin');
		is_logged_in();
	}


	public function index()
	{
		// ------------------------------ form validasi -------------------
		$this->form_validation->set_rules('role_id', 'Role', 'trim|required', [
			'required' => 'Role tidak Boleh Kosong!'
		]);

		$this->form_validation->set_rules('name', 'Name', 'trim|required', [ 
			'required' => 'Nama tidak Boleh Kosong!'
		]);

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tb_user.email]', [
			'is_unique' => 'Email sudah terdaftar!',
			'required' => 'Email tidak boleh kosong!',
			'valid_email' => 'Email tidak valid!'
		]);

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]', [
			'required' => 'Password tidak boleh kosong!',
			'min_length' => 'Password terlalu singkat!',
			'matches' => 'Password tidak cocok!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]',[
			'required' => 'Retype Password tidak boleh kosong!',
		]);
		

		// --------- end Validasi -----------

		if ($this->form_validation->run() == false) { // jika validasi gagal maka kembali ke halaman user
			
			$data['title'] = 'User'; // title halaman
			$data['allRole'] = $this->admin->get_all_role(); //ambil semua role
			$data['allUser'] = $this->admin->get_all_user(); //ambil semua user
	
			$this->render('user/user_index', $data);

		} else {   // jika validasi benar, maka akan input array ke database.



			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.png',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role_id', true)),
				'is_active' => '1',
				'date_created' => time()
			];

			$this->admin->save_new_user($data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selamat!, Akun anda berhasil didaftarkan. </div>');
			redirect('user');
			

		}
	}

}
