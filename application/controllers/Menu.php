<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model', 'menu');
        is_logged_in();
    }

    public function index()
    {
        if ($this->input->post('jenis') == 'menu') {
            $this->form_validation->set_rules('menu', 'Nama Menu', 'trim|required', [
                'required' => 'Nama Menu tidak Boleh Kosong!'
            ]);

        } elseif ($this->input->post('jenis') == 'submenu') {

            $this->form_validation->set_rules('title', 'Title', 'trim|required', [
                'required' => 'Title menu tidak boleh kosong!'
            ]);
            $this->form_validation->set_rules('menu_id', 'menu id', 'trim|required', [
                'required' => 'Pilih menu id telebih dahulu!'
            ]);
            $this->form_validation->set_rules('url', 'Field Url', 'trim|required', [
                'required' => 'Field Url tidak boleh kosong!'
            ]);
            $this->form_validation->set_rules('icon', 'Icon', 'trim|required', [
                'required' => 'Icon tidak boleh kosong!'
            ]);
        } 
        if ($this->form_validation->run() == false) {

            $data = [
                'title' => 'Menu',
                'action' => 'menu',
                'update' => 'menu/update',
                'delete' => 'menu/delete/',
                'v_menu' => $this->menu->get_all_menu(),
                'lvl_user' => $this->db->get('tb_user_role')->result_array(),
            ];
            $this->render('menu/menu_index', $data);
        } else {

            if ($this->input->post('jenis') == 'menu') {
                // simpan data ke database
                $data = [
                    'menu' => htmlspecialchars($this->input->post('menu', true)),
                ];
                $this->menu->save_menu_info($data); //simpan data dengan memanggil fungsi simpan di model

            } else {

                $data = [
                    'menu_id' => htmlspecialchars($this->input->post('menu_id', true)),
                    'title' => htmlspecialchars($this->input->post('title', true)),
                    'field_url' => htmlspecialchars($this->input->post('url', true)),
                    'icon' => htmlspecialchars($this->input->post('icon', true)),
                    'is_active' => htmlspecialchars($this->input->post('is_active', true)),
                ];

                $this->menu->save_submenu_info($data); //simpan data dengan memanggil fungsi simpan di model
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selamat!, data berhasil didaftarkan. </div>');
            redirect('menu');
            
        }       
    }

    public function access()
    {
        $data = [
            'title' => 'Menu Access',
            'role' => $this->db->where_not_in('id', '1')->get('tb_user_role')->result_array(),
        ];
        $this->render('menu/menu_access', $data);
    }

    public function roleaccess($param)
    {
        $id = decode($param);
        $role = $this->db->get_where('tb_user_role', ['id' => $id])->row_array();

        $menu = array();
        $user_menu = $this->db->where_not_in('id_um', '1')->get('tb_user_menu')->result_array();
        foreach ($user_menu as $row => $value) {
            $idum = $value['id_um'];
            $menu[] = array(
                'menu_utama' => $value,
                'access' => $this->db->get_where('tb_user_access_menu', ['menu_id' => $idum, 'role_id' => $id])->row_array(),
            );
        }

        $data = [
            'title' => 'Role Access',
            'role' => $role,
            'menu' => $menu,
        ];
        $this->render('menu/menu_role_access', $data);
    }

    public function ajax_changeaccess()
    {

        $role = decode($this->input->post('roleId'));
        $menu = ($this->input->post('menuId'));

        $data = [
            'role_id' => $role,
            'menu_id' => $menu,
        ];


        $result = $this->db->get_where('tb_user_access_menu', $data)->row_array();

        if (empty($result)) {
           $this->db->insert('tb_user_access_menu', $data);
           $pesan = 'Disimpan';
        } else {
            $this->db->delete('tb_user_access_menu', $data);
            $pesan = 'Dihapus';
        }

        $this->session->set_flashdata('message', "<div class='alert alert-success' role='alert'> Selamat!, access berhasil $pesan . </div>");

    }

    public function ajax_accesscrud()
    {

        $role = decode($this->input->post('v_roleid'));
        $menu = $this->input->post('v_idum');
        $create = $this->input->post('v_create');
        $read = $this->input->post('v_read');
        $update = $this->input->post('v_update');
        $delete = $this->input->post('v_delete');

        $where = [
            'role_id' => $role,
            'menu_id' => $menu,
        ];

        $data = [
            'a_create'  => $create,
            'a_read'  => $read,
            'a_update'  => $update,
            'a_delete'  => $delete,
        ];

    //     $result = $this->db->get_where('tb_user_access_menu', $where)->row_array();

    //    /*  var_dump($result);
    //     die; */

        $this->db->where($where)->update('tb_user_access_menu', $data);
        $pesan = 'Disimpan';

        $this->session->set_flashdata('message', "<div class='alert alert-success' role='alert'> Selamat!, access berhasil $pesan . </div>");
    }


    public function view()
    {
        if (isset($_POST['cari'])) {

            if ($_POST['cari'] == 'add') {

                $data = [
                    'jenis' => $this->input->post('jenis'),
                    'v_menu' => $this->menu->get_all_menu(),
                ];
                $this->load->view('menu/menu_view', $data);

            } else {

                $id = decode($this->input->post('menu'));

                $data = [
                        'jenis' => 'view',
                        'v_data' => $this->menu->get_menu_id($id),
                        'v_subdata' => $this->menu->get_submenu_id($id),
                    ];
                $this->load->view('menu/menu_view', $data);
                
            }
            
        } else {
            echo "Maaf!, Sedang Mengalami Gangguan";
        }
    }
}
