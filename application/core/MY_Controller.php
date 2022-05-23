<?php
    class MY_Controller extends CI_Controller{

    function __construct(){ 
        parent::__construct();
        $this->load->model('auth_model','auth');
        $this->load->model('menu_model', 'menu');
        }

    function render ($view,$data){

        $role_id = decode($this->session->userdata('role_id'));

        $data['user'] = $this->auth->get_user_login();
        
        $menu_array = array();
        $acces_menu = $this->menu->get_access_menu($role_id);
        foreach ($acces_menu as $row => $value) {
            $id = $value['id_um'];
            $menu_array[] = array(
                'menu_utama' => $value,
                'sub' => $this->menu->get_sub_menu($id)
            );
        }

        var_dump($menu_array);
        die;

        $sidebar['menu_array'] = $menu_array;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $sidebar);
        $this->load->view($view, $data);
        $this->load->view('templates/footer');
    }

    function public ($view, $data)
    {
        $this->load->view($view, $data);
    }
}