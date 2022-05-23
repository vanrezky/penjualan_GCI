<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model', 'barang');
        is_logged_in();
    }

    public function index()
    {

        $search = (!empty($this->input->cookie('fnama_barang')) ? $this->input->cookie('fnama_barang') : '');
        $per_page = (!empty($this->input->cookie('fper_page')) ? $this->input->cookie('fper_page') : '10');

        // ------------------------------ form validasi -------------------

        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'trim|required|is_unique[tb_barang.kode_barang]', [
            'is_unique' => 'Kode Barang sudah terdaftar!',
            'required' => 'Kode Barang tidak boleh kosong!',
            'numeric' => 'Kode Barang tidak valid!'
        ]);
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required', [
            'required' => 'Nama Barang tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
            'required' => 'Keterangan tidak Boleh Kosong!'
        ]);
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required|numeric', [
            'required' => 'Stock tidak Boleh Kosong!',
            'numeric' => 'Stock harus berupa angka!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric', [
            'required' => 'Harga tidak Boleh Kosong!',
            'numeric' => 'Harga harus berupa angka!'
        ]);

        if ($this->form_validation->run() == false) {

            $config["base_url"] = base_url('barang/index');
            $jumlah_data = $this->db->like('nama_barang', $search, 'both')->get('tb_barang')->num_rows();
            $config['total_rows'] = $jumlah_data;
            $config['per_page'] = $per_page;
            $from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $config["uri_segment"] = 3;
            
            // Membuat Style pagination untuk BootStrap v4
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
            // $config['attributes'] = array('class' => 'page-link');
            $this->pagination->initialize($config);
           
            $data = [
                'title' => 'Barang', //judul halaman
                'kode_barang' => $this->barang->set_kode_barang(), // generate kode barang otomatis
                'data' => $this->barang->get_barang_info($config['per_page'], $from, $search),
                'allSatuan' => $this->barang->get_all_satuan(), // ambil semua data satuan
                'jumlah_data' => $jumlah_data,
            ];

            $this->render('barang/barang_index', $data);
        } else {

            // ambil harga beli dan harga jual

            $hargaBeli = htmlspecialchars($this->input->post('harga', true));
            $hargaJual = htmlspecialchars($this->input->post('harga_jual', true));

            //menghilangkan titik ribuan
            $angka1 = str_replace(".", "", $hargaBeli);
            $angka2 = str_replace(".", "", $hargaJual);

            // simpan data ke database
            $data = [
                'kode_barang' => htmlspecialchars($this->input->post('kode_barang', true)),
                'nama_barang' => htmlspecialchars($this->input->post('nama_barang', true)),
                'satuan_id' => htmlspecialchars($this->input->post('satuan_id', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'stock' => htmlspecialchars($this->input->post('stock', true)),
                'harga' => $angka1,
                'harga_jual' =>$angka2,
                'date_created' => time()
            ];

            $this->barang->save_barang_info($data); //simpan data dengan memanggil fungsi simpan di model

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selamat!, Barang anda berhasil didaftarkan. </div>');
            redirect('barang');
        }
    }

    public function update($parama)
    {
        $param = decode($parama); // decrypt\

        // ------------------------------ form validasi -------------------
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required', [
            'required' => 'Nama Barang tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
            'required' => 'Keterangan tidak Boleh Kosong!'
        ]);
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required|numeric', [
            'required' => 'Stock tidak Boleh Kosong!',
            'numeric' => 'Stock harus berupa angka!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric', [
            'required' => 'Harga Beli tidak Boleh Kosong!',
            'numeric' => 'Harga Beli harus berupa angka!'
        ]);
        $this->form_validation->set_rules('satuan_id', 'satuan', 'trim|required|numeric', [
            'required' => 'Satuan tidak Boleh Kosong!',
            'numeric' => 'Satuan harus berupa angka!'
        ]);
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'trim|required|numeric', [
            'required' => 'Harga Jual tidak Boleh Kosong!',
            'numeric' => 'Harga Jual harus berupa angka!'
        ]);

		// --------- end Validasi -----------

        if ($this->form_validation->run() == false) {

            $data = [
                'title' => 'Update Barang', //judul halaman
                'barang' => $this->barang->get_single_barang($param), //get barang berdasarkan id
                'allSatuan' => $this->barang->get_all_satuan() // ambil semua data satuan
            ];

            $this->render('barang/barang_edit', $data);

        } else {

            // ambil harga beli dan harga jual

            $hargaBeli = htmlspecialchars($this->input->post('harga', true));
            $hargaJual = htmlspecialchars($this->input->post('harga_jual', true));

            //menghilangkan titik ribuan
            $angka1 = str_replace(".", "", $hargaBeli);
            $angka2 = str_replace(".", "", $hargaJual);

            $data = [
                'nama_barang' => htmlspecialchars($this->input->post('nama_barang', true)),
                'satuan_id' => htmlspecialchars($this->input->post('satuan_id', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'stock' => htmlspecialchars($this->input->post('stock', true)),
                'harga' => $angka1,
                'harga_jual' => $angka2,
            ];

            $this->barang->update_barang_info($data, $parama);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang berhasil diperbaharui!</div>');
            redirect('barang');
        }
    }

    public function delete($e_id)
    {
        $id = decode($e_id); // decrypt

        $this->barang->delete_barang_info($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang berhasil dihapus!</div>');
        redirect('barang');
    }
}
