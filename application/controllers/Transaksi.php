<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model', 'barang');
        $this->load->model('transaksi_model', 'transaksi');
        $this->load->library('cart');
        $this->load->library('encryption');
        is_logged_in();
    }

    public function index()
    {
        $data = [
            'url' => 'transaksi/add', //url
            'title' => 'Transaksi', //judul halaman
            'kode_barang' => $this->barang->set_kode_barang(), // generate kode barang otomatis
            'allTransaksi' => $this->transaksi->get_all_transaksi(), //ambil semua data transaksi
        ];
        $this->render('transaksi/transaksi_index', $data);
           
    }

    public function add()
    {

        $data = [
            'url' => "transaksi/add", // url
            'title' => 'Form Transaksi', // judul halaman
        ];
        $this->render('transaksi/transaksi_form', $data);
    }

    function get_autocomplete() // autocomplate barang
    {
        if (isset($_GET['term'])) {
            $result = $this->transaksi->search_blog($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'kode'      => $row->kode_barang,
                        'stock'     => $row->stock,
                        'harga'     => number_format($row->harga_jual, "0", ".", "."),
                        'qty'       => '1',
                        'satuan'    => $row->satuan,
                        'value'     => $row->nama_barang,
                        'label'     => $row->nama_barang,
                        'id'        => $row->id,

                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function save_transaksi()
    {
        $allbarang = $this->cart->contents(); // ambil semua barang di temporary
        $no_resi =  $this->transaksi->get_no_resi();

        $odata = [
            'no_resi' => $no_resi,
            'total' => $this->cart->total(),
            'date_created' => date('Y-m-d')
        ];

        $this->transaksi->save_transaksi_info($odata); // save ke tabel transaksi

        foreach ($allbarang as $barang) { // foreach data barang di temporary

            $barang_id = $barang['id']; // id barang
            $qty = $barang['qty']; // jumlah barang
            $barang = $this->db->get_where('tb_barang', ['id' => $barang_id])->row_array(); // ambil stock berdasarkan id barang

            $sisa_stock = [ // sisa stock
                'stock' => $barang['stock'] - $qty,
            ];

            $data = [
                    'no_resi' => $no_resi,
                    'barang_id' => $barang_id,
                    'qty' => $qty,
                ];

            $this->transaksi->sisa_stock_info($barang_id, $sisa_stock); // simpan ke database sisa stock

            $this->transaksi->save_sub_transaksi_info($data); // save ke tabel sub transaksi
        }

        $this->cart->destroy();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil ditambahkan!</div>');

        redirect('transaksi/add');
        
    }

    public function delete($e_id)
    {

        $id = decode($e_id);
        $this->transaksi->delete_transaksi_info($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil dihapus!</div>');
        redirect('transaksi');
    }

    public function view()
    {
        $id = decode($this->input->post('barang', true));
        $data = [
            'v_data' => $this->transaksi->get_transaksi_id($id),
            'v_subdata' => $this->transaksi->get_subtransaksi_id($id),
        ];
        $this->load->view('transaksi/transaksi_view', $data);
    }

    public function add_to_cart()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $row = $this->transaksi->get_single_barang($id); // ambil data barang bedasarkan jumlah barang

            $data = [
                'id' => $row['id'],
                'name' => $row['nama_barang'],
                'price' => $row['harga'],
                'qty' => $qty,
                'options' => array('satuan' => $row['satuan'])
            ];

            $this->cart->insert($data);
            
        echo $this->show_cart();

    }

    function load_cart()
    {
        echo $this->show_cart();
    }

    function show_cart()
    {
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .= '
                <tr>
                    <td class="center">' . $no . '</td>
                    <td>' . $items['name'] . '</td>
                    <td>' . number_format($items['price']) . '</td>
                    <td>' . $items['qty'] . '</td>
                    <td>' . $items['options']['satuan'] . '</td>
                    <td>' . number_format($items['subtotal']) . '</td>
                    <td><button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-icon btn-sm btn-danger"><i class="fas fa-trash"></i> Batal</button></td>
                </tr>
            ';
        }
        $output .= '
			<tr>
				<th colspan="5">Total</th>
				<th colspan="2">' . 'Rp ' . number_format($this->cart->total()) . '</th>
			</tr>
		';
        return $output;
    }

    function hapus_cart()
    { //fungsi untuk menghapus item cart
        $this->cart->remove($this->input->post('row_id'));
        echo $this->show_cart();
    }

}