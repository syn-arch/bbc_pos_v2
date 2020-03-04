
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Transaksi_m','t');
		$this->load->model('Master_m','m');
	}

	public function index()
	{
		$data['judul'] = "Transaksi";
		$data['barang'] = $this->m->getAllBarangNoBarcode();
		$data['detil'] = $this->t->getDetailTransaksi();
		$data['kd'] = $this->t->kd_transaksi();
		$data['t_harga'] = $this->t->getTotalHarga();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('transaksi/index', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function add_pesanan()
	{
		 $this->t->addpesanan();
	}

	public function transaksi()
	{
		$data['judul'] = "Transaksi";
		$data['barang'] = $this->m->getAllBarangNoBarcode();
		$data['detil'] = $this->t->getDetailTransaksi();
		$data['kd'] = $this->t->kd_transaksi();
		$data['t_harga'] = $this->t->getTotalHarga();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('transaksi/index.copy.php', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);

	}

	public function getharga()
	{
		$barang = $this->m->getBarangByBar($_POST['id']);

		$diskon = (int) $barang['diskon'];
		$harga = (int) $barang['harga_jual'];

		if ($diskon > 0) {
			$t_diskon = ($diskon / 100) * $harga;
			$t_harga = $harga - $t_diskon;

			$b_barang = [
				'harga_jual' => $t_harga
			];

			echo json_encode($b_barang);

		}else{

			echo json_encode($barang);

		}
	}

	public function stok()
	{
		$data['judul'] = "Pengaturan Stok";
		$data['stok'] = $this->t->getAllStok();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('transaksi/stok', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function tambah_data_stok()
	{
		$this->form_validation->set_rules('tgl', 'tgl', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Tambah Data Stok";
			$data['barang'] = $this->m->getAllBarang();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('transaksi/form-stok', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);
		} else {
			$this->t->addstok();
			$this->session->set_flashdata('message', 'ditambah');
			redirect('transaksi/stok','refresh');
		}
		
	}

	public function hapus_stok($id)
	{
		$this->db->delete('stok', ['id' => $id]);
		$this->session->set_flashdata('message', 'dihapus');
		redirect('transaksi/stok','refresh');
	}

	public function tambah_pesanan()
	{
		$this->t->addpesanan();
		redirect('transaksi','refresh');
	}

	public function auth_delete($id)
	{
		$data['judul'] = "Konfirmasi Hapus Detil";
		$data['kd_barang'] =  $id;

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('transaksi/auth-delete', $data);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function hapus_detil($id = '')
	{
		$post = $this->input->post();

		$id = $post['kd_barang'];

		$pw_admin = $this->db->get_where('user',['id_role' => 4])->row_array()['password'];

		if (!password_verify($post['pw'], $pw_admin)) {
			$this->session->set_flashdata('error','error');
			redirect('transaksi/auth_delete/' . $post['kd_barang'],'refresh');
		}

		// tambahkan stok jika pesanan dibatalkan
		$detil = $this->db->query("SELECT stok,kd_barang FROM detil_transaksi JOIN barang USING(kd_barang) WHERE id = $id")->row_array();
		$stok_baru = $this->db->get_where("detil_transaksi",['id' => $id])->row_array()['qty'];
		$hasil = (int) $detil['stok'] + (int) $stok_baru;

		$this->db->set('stok', $hasil);
		$this->db->where('kd_barang', $detil['kd_barang']);
		$this->db->update('barang');

		// redirect setelah berhasil
		$this->db->delete('detil_transaksi', ['id' => $id]);
		redirect('transaksi','refresh');

	}



	public function tambah_transaksi()
	{
		$kd = $this->db->get_where('detil_transaksi',['status' => 'berlangsung'])->row_array()['kd_transaksi'];

		$this->t->addtransaksi();
	}

	public function invoice($kd_trs)
	{
		$data['kode'] = $kd_trs;
		$this->load->view('transaksi/invoice', $data);
	}

	public function pengembalian()
	{
		$data['judul'] = "Pengembalian";
		$data['kembali'] = $this->t->getAllPengembalian();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('transaksi/kembali', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function tambah_pengembalian()
	{
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Pengembalian Barang";
			$data['barang'] = $this->m->getAllBarang();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('transaksi/form-pengembalian', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->t->addpengembalian();
			$this->session->set_flashdata('message', 'ditambah');
			redirect('transaksi/pengembalian','refresh');
		}

	}

	public function edit_pengembalian($id)
	{
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Pengembalian Barang";
			$data['barang'] = $this->m->getAllBarang();
			$data['kembali'] =$this->t->getKembaliByKd($id);
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('transaksi/form-pengembalian', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->t->updatepengembalian();
			$this->session->set_flashdata('message', 'diubah');
			redirect('transaksi/pengembalian','refresh');
		}	
	}

	public function hapus_kembali($id)
	{
		$this->db->delete('pengembalian', ['kd_kembali' => $id]);
		$this->session->set_flashdata('message', 'dihapus');
		redirect('transaksi/pengembalian','refresh');
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */