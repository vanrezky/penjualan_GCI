<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Transaksi_model extends CI_Model
{


    public function get_no_resi() // buat kode barang secara otomatis
    {

        $this->db->select('RIGHT(tb_transaksi.no_resi,4) as kode', FALSE);
        $this->db->order_by('no_resi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_transaksi');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "BRX-" . $kodemax;
        return $kodejadi;
    }

    function search_blog($nama) //autocomplete transaksi barang
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_satuan', 'tb_barang.satuan_id=tb_satuan.satuan_id', 'inner');
        $this->db->like('nama_barang', $nama, 'both');
        $this->db->order_by('nama_barang', 'ASC');
        $this->db->limit(10);
        $info = $this->db->get();
        return $info->result();
    }

    public function getNamaDanKode($nm) // ambil nama dan kode barang
    {
        $this->db->select('kode_barang, nama_barang');
        $this->db->from('tb_barang');
        $this->db->like('nama_barang', $nm);
        // $this->db->like('hide', 'x');
        $this->db->or_like('kode_barang', $nm);
        // $this->db->like('hide', 'x');
        $this->db->limit(10);
        return $this->db->get();
    }

    public function get_all_transaksi() //ambil data dari tabel transaksi
    {
        // $date = date('y-m-d');
        
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        // if ($this->session->has_userdata('KASIR')) {
            
        //     $this->db->where('date_created', $date);
        // }
        
        $info = $this->db->get();
        return $info->result_array();
    }

    public function get_transaksi() //ambil data dari tabel transaksi dan total penujualan
    {
        $this->db->select('SUM(total) as max_trans, date_created');
        $this->db->from('tb_transaksi');
        $this->db->group_by('date_created');
        $this->db->order_by('no_resi', 'asc');
        $info = $this->db->get();
        return $info->result_array();
    }

    public function getTransaksi() //ambil total dari tabel transaksi
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $info = $this->db->get();
        return $info->result_array();
    }

    public function get_transaksi_id($id) //ambil total dari tabel transaksi
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('no_resi', $id);
        $info = $this->db->get();
        return $info->row_array();
    }

    public function get_subtransaksi_id($id) //ambil total dari tabel transaksi
    {
        $this->db->select('*');
        $this->db->from('tb_sub_transaksi');
        $this->db->join('tb_barang', 'tb_sub_transaksi.barang_id=tb_barang.id', 'LEFT');
        $this->db->join('tb_satuan', 'tb_barang.satuan_id=tb_satuan.satuan_id', 'LEFT'); 
        $this->db->where('no_resi', $id);
        $info = $this->db->get();
        return $info->result_array();
    }

    public function get_single_barang($id) //ambil data dari tabel transaksi berdasarkan id
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_satuan', 'tb_barang.satuan_id=tb_satuan.satuan_id', 'LEFT');
        $this->db->where('id', $id);
        $info = $this->db->get();
        return $info->row_array();
    }

    public function save_transaksi_info($odata) // save data ke database tb_transaksi
    {
        return $this->db->insert('tb_transaksi', $odata);
    }

    public function save_sub_transaksi_info($odata) // save data ke database sub transaksi
    {
        return $this->db->insert('tb_sub_transaksi', $odata);
    }

    public function sisa_stock_info($barang_id, $sisa_stock) //simpan sisa stock
    {
        $this->db->where('id', $barang_id);
        return $this->db->update('tb_barang', $sisa_stock);

    }

    public function delete_transaksi_info($id) // delate transaksi
    {
        $this->db->where('no_resi', $id);
        return $this->db->delete('tb_transaksi');
    }

}