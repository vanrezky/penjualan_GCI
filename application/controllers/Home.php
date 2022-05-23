<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('auth_model','auth');
    }
    public function index()
    {
        $D['title'] = 'Home';
        $this->load->view('public/templates/head');
        $this->load->view('public/templates/header');
        $this->load->view('public/templates/navbar');
        $this->load->view('public/templates/home_slider');
        $this->load->view('public/templates/fitur');
        $this->load->view('public/templates/promotion_area');
        $this->load->view('public/templates/trending_area');
        $this->load->view('public/home_index', $D);
        $this->load->view('public/templates/footer');
    }
}