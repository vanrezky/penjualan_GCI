<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Barang_model extends CI_Model
{
    function get_barang_info($number, $offset, $search="")
    {
        return $query = $this->db->join('tb_satuan', 'tb_barang.satuan_id=tb_satuan.satuan_id', 'left')
                                 ->like('nama_barang', $search, 'both')
                                 ->get('tb_barang', $number, $offset)
                                 ->result_array();
    }

    public function set_kode_barang() // buat kode barang secara otomatis
    {
        $this->db->select('RIGHT(tb_barang.kode_barang,4) as kode', FALSE);
        $this->db->order_by('kode_barang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_barang');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "B-P-" . $kodemax;
        return $kodejadi;
    }

    public function save_barang_info($data) // save data ke database tb_barang
    {
        return $this->db->insert('tb_barang', $data);
    }

    public function save_transaksi_info($data) // save data ke database tb_transaksi
    {
        return $this->db->insert('tb_transaksi', $data);
    }

    public function get_date_barang() //get tanggal input barang
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->group_by('YEAR(tb_barang.date_created)');
        $info = $this->db->get();
        return $info->result_array();

    }

    public function get_all_satuan() //ambil data dari tabel satuan
    {

        $this->db->select('*');
        $this->db->from('tb_satuan');
        $info = $this->db->get();
        return $info->result_array();
    }

    public function get_single_barang($id) // ambil data barang berdasarkan id
    {

        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_satuan', 'tb_barang.satuan_id=tb_satuan.satuan_id', 'inner');
        $this->db->where('tb_barang.id', $id);
        $info = $this->db->get();
        return $info->row_array();
    }



    public function update_barang_info($data, $param) // update barang
    {
        $this->db->where('id', $param);
        return $this->db->update('tb_barang', $data);
    }

    public function update_stock_info($databarang, $barang_id) // update Stock
    {
        $this->db->where('id', $barang_id);
        return $this->db->update('tb_barang', $databarang);
    }

    public function delete_barang_info($id) // delate barang
    {
        $this->db->where('id', $id);
        return $this->db->delete('tb_barang');
    }
}