<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Scroll_pagination extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model', 'barang');
    }

    public function info_stock_barang()
    {

        $start = $this->input->post('start');
        $limit = $this->input->post('limit');

        $output = '';
        $data = $this->db->where('stock <', '10')->limit($limit, $start)->get('tb_barang');
        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $row) {
                $output .= "<a href='". base_url('barang/update/' . encode($row['id'])) ."'class='dropdown-item dropdown-item-unread'>";
                $output .= "<div class='dropdown-item-icon bg-primary text-white'>";
                $output .= "<i class='fas fa-code'></i>";
                $output .= "</div>";
                $output .= "<div class='dropdown-item-desc'>";
                $output .= "$row[nama_barang]";
                $output .= "</div>";
                $output .= "</a>";
            }
        }

        echo $output;
    }

}