<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Auth_model extends CI_Model
{

    public function get_user_login()
    {
        $email = (decode($this->session->userdata('email')));
        
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_user_role', 'tb_user.role_id=tb_user_role.id', 'left');
        $this->db->where('email', $email);
        $info = $this->db->get();
        return $info->row_array();
    }


    public function getLoginData($data)

    {

        $email = $this->input->post('email'); // dari form input email
        $password = $this->input->post('password'); //dari form input password

        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array(); //ambil data berdasarkan email

        //jika user ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => (encode($user['email'])),
                        'role_id' => (encode($user['role_id'])),
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email ini belum diaktivasi! Silahkan cek email anda </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar! </div>');
            redirect('auth');
        }
    }
}
