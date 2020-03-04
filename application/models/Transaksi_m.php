<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_m extends CI_Model {

	public function getAllStok()
	{
		return $this->db->query("SELECT * FROM stok JOIN barang USING(kd_barang)")->result_array();
	}

	public function addstok()
	{
		$post = $this->input->post();
		$stok_brg = $this->db->get_where('barang',['kd_barang' => $post['kd_barang']])->row_array()['stok'];


		if ($post['status'] == "Stok Masuk") {
			$stok_baru = (int) $stok_brg + (int) $post['jumlah'];
			$this->db->set('stok', $stok_baru);
			$this->db->where('kd_barang', $post['kd_barang']);
			$this->db->update('barang');
		}elseif($post['status'] == "Stok Keluar"){
			$stok_baru = (int) $stok_brg - (int) $post['jumlah'];
			$this->db->set('stok', $stok_baru);
			$this->db->where('kd_barang', $post['kd_barang']);
			$this->db->update('barang');
		}

		$data = [
			'tgl' => $post['tgl'],
			'kd_barang' => $post['kd_barang'],
			'status' => $post['status'],
			'jumlah' => $post['jumlah'],
			'keterangan' => $post['keterangan']
		];

		$this->db->insert('stok', $data);
	}

	public function kd_transaksi()
	{
		return "T-" . date("dmy") . strtoupper(substr(uniqid(),7)) ;
	}

	public function getDetailTransaksi()
	{
		$user = $this->session->userdata('kd_user');
		$query = "SELECT * FROM detil_transaksi JOIN barang USING(kd_barang) WHERE status = 'berlangsung' AND kd_user = '$user' ";
		return $this->db->query($query)->result_array();
	}

	public function test($value='')
	{
		$data['helo'] = 'assalamualaikum';

		echo json_encode($data);
	}

	public function addpesanan()
	{
		$post = $this->input->post();
		$cek = $this->db->get_where('detil_transaksi', ['status' => 'berlangsung'])->result_array();
		$user = $this->session->userdata('kd_user');

		if ($cek) {
			$kd = $this->db->get_where('detil_transaksi', ['status' => 'berlangsung'])->row_array()['kd_transaksi'];
			$kd_trs['kd_transaksi'] = $kd;
		}else{
			$kd_trs['kd_transaksi'] = $post['kd_transaksi'];
		}

		$brg = $post['barcode'];

		$kd_barang = $this->db->query("SELECT * FROM barang WHERE barcode = '$brg' OR kd_barang = '$brg' ")->row_array()['kd_barang'];

		if ($post['qty'] == "") {
			$post['qty'] = 1;
		}

		$data = [
			'kd_user' => $user,
			'kd_barang' => $kd_barang,
			'qty' => $post['qty'],
			'total' => $post['total'],
			'status' => 'berlangsung'
		];

		$baru = array_merge($kd_trs, $data);
		$this->db->insert('detil_transaksi', $baru);

		// kurangi stok pada tabel barang
		$stok_brg = $this->db->get_where('barang',['kd_barang' => $kd_barang])->row_array()['stok'];
		$hasil = (int) $stok_brg - (int) $post['qty'];

		$this->db->set('stok', $hasil);
		$this->db->where('kd_barang', $kd_barang);
		$this->db->update('barang');

	}

	public function getTotalHarga()
	{
		$user = $this->session->userdata('kd_user');
		$query = "SELECT SUM(total) AS t_harga FROM detil_transaksi WHERE status = 'berlangsung' AND kd_user = '$user' ";
		return $this->db->query($query)->row_array()['t_harga'];
	}

	public function addtransaksi()
	{
		$post = $this->input->post();

		$user = $this->session->userdata('kd_user');
		$date = date("Y-m-d");
		$kd = $this->db->get_where('detil_transaksi',['status' => 'berlangsung', 'kd_user' => $user])->row_array()['kd_transaksi'];
		$total = $this->db->query("SELECT SUM(total) AS t_harga FROM detil_transaksi WHERE status = 'berlangsung'")->row_array()['t_harga'];

		$data = [
			'kd_transaksi' => $kd,
			'kd_user' => $user,
			'total_bayar' => $total,
			'tgl' => $date,
			'tunai' => $post['tunai']
		];

		$this->db->insert('transaksi', $data);

		$this->db->set('status', 'selesai');;
		$this->db->update('detil_transaksi');
		
		echo "<script>window.open('" . base_url('transaksi/invoice/') . $kd . "', '_blank');</script>";
		redirect('transaksi/index','refresh');
	}

	public function getAllPengembalian()
	{
		$query = "SELECT kd_kembali,tgl,nm_user,nm_barang,keterangan,jumlah FROM pengembalian JOIN user USING(kd_user) JOIN barang USING(kd_barang)";
		return $this->db->query($query)->result_array();
	}
	public function getKembaliByKd($kd)
	{
		$query = "SELECT kd_kembali,tgl,nm_user,nm_barang,keterangan,jumlah,kd_barang FROM pengembalian JOIN user USING(kd_user) JOIN barang USING(kd_barang) WHERE kd_kembali = '$kd'";
		return $this->db->query($query)->row_array();
	}

	public function addpengembalian()
	{
		$post = $this->input->post();

		$data = [
			'tgl' => $post['tgl'],
			'kd_barang' => $post['kd_barang'],
			'jumlah' => $post['jumlah'],
			'keterangan' => $post['keterangan'],
			'kd_user' => $this->session->userdata('kd_user')
		];

		$this->db->insert('pengembalian', $data);
	}

	public function updatepengembalian()
	{
		$post = $this->input->post();

		$this->db->set('tgl', $post['tgl']);
		$this->db->set('kd_barang', $post['kd_barang']);
		$this->db->set('jumlah', $post['jumlah']);
		$this->db->set('keterangan', $post['keterangan']);
		$this->db->set('kd_user', $this->session->userdata('kd_user'));
		$this->db->where('kd_kembali', $post['kd_kembali']);
		$this->db->update('pengembalian');
	}

	



	

}

/* End of file Transaksi_m.php */
/* Location: ./application/models/Transaksi_m.php */ ?>