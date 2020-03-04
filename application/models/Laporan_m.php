<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_m extends CI_Model {

	public function getRiwayatToday()
	{
		$date = date('Y-m-d');
		$query = "SELECT *
				FROM transaksi
				JOIN detil_transaksi USING(kd_transaksi)
				JOIN barang USING(kd_barang)
				WHERE `transaksi`.`tgl` = '$date'
				GROUP BY `transaksi`.`kd_transaksi`
		";

		return $this->db->query($query)->result_array();
	}

	public function getRiwayatPriode()
	{
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$query = "SELECT *
				FROM transaksi
				JOIN detil_transaksi USING(kd_transaksi)
				JOIN barang USING(kd_barang)
				WHERE `transaksi`.`tgl` BETWEEN '$dari' AND '$sampai'
				GROUP BY `transaksi`.`kd_transaksi`
		";

		return $this->db->query($query)->result_array();
	}

	public function getToday()
	{
		$date = date('Y-m-d');
		$query = "SELECT
					`barang`.`harga_jual`,
					`barang`.`harga_beli`,
					`barang`.`profit`,
					`barang`.`nm_barang`,
					`barang`.`barcode`,
					`barang`.`kd_barang`,
					`detil_transaksi`.`qty` AS 'brg_terjual',
					`barang`.`profit` * `detil_transaksi`.`qty` AS 'laba'
				FROM transaksi
				JOIN detil_transaksi USING(kd_transaksi)
				JOIN barang USING(kd_barang)
				WHERE `transaksi`.`tgl` = '$date'
				GROUP BY `barang`.`kd_barang`
		";

		return $this->db->query($query)->result_array();
	}

	public function getPendapatanHariIni()
	{
		$date = date('Y-m-d');
		$query = "SELECT SUM(total_bayar) AS t_pendapatan FROM transaksi WHERE tgl = '$date' ";
		return $this->db->query($query)->row_array()['t_pendapatan'];
	}

	public function getPendapatanPriode()
	{
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		
		$query = "SELECT SUM(total_bayar) AS t_pendapatan FROM transaksi WHERE tgl BETWEEN '$dari' AND '$sampai' ";
		return $this->db->query($query)->row_array()['t_pendapatan'];
	}

	public function getDetil($id)
	{
		$query = "SELECT * FROM detil_transaksi JOIN transaksi USING(kd_transaksi) JOIN barang USING(kd_barang) JOIN user ON `detil_transaksi`.`kd_user` = `user`.`kd_user` WHERE kd_transaksi = '$id'";
		return $this->db->query($query)->result_array();
	}

	public function getPriode()
	{
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$query = "SELECT
					`barang`.`harga_jual`,
					`barang`.`harga_beli`,
					`barang`.`profit`,
					`barang`.`nm_barang`,
					`barang`.`barcode`,
					`barang`.`kd_barang`,
					`detil_transaksi`.`qty` AS 'brg_terjual',
					`barang`.`profit` * `detil_transaksi`.`qty` AS 'laba'
				FROM transaksi
				JOIN detil_transaksi USING(kd_transaksi)
				JOIN barang USING(kd_barang)
				WHERE `transaksi`.`tgl` BETWEEN '$dari' AND '$sampai'
				GROUP BY `barang`.`kd_barang`
		";

		return $this->db->query($query)->result_array();
	}

	public function getByDate($dari, $sampai)
	{

		$query = "SELECT
					`barang`.`harga_jual`,
					`barang`.`harga_beli`,
					`barang`.`profit`,
					`barang`.`nm_barang`,
					`barang`.`barcode`,
					`barang`.`kd_barang`,
					`detil_transaksi`.`qty` AS 'brg_terjual',
					`barang`.`profit` * `detil_transaksi`.`qty` AS 'laba'
				FROM transaksi
				JOIN detil_transaksi USING(kd_transaksi)
				JOIN barang USING(kd_barang)
				WHERE `transaksi`.`tgl` BETWEEN '$dari' AND '$sampai'
				GROUP BY `barang`.`kd_barang`
		";

		return $this->db->query($query)->result_array();
	}

	

}

/* End of file Laporan_m.php */
/* Location: ./application/models/Laporan_m.php */ ?>