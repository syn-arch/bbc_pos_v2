<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Laporan_m','l');
	}
	
	public function index()
	{
		$this->form_validation->set_rules('dari', 'Dari', 'required');
		$this->form_validation->set_rules('sampai', 'sampai', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Laporan Penjualan";
			$data['transaksi'] = $this->l->getToday();
			$data['p_hari_ini'] = $this->l->getPendapatanHariIni();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('laporan/history', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$data['judul'] = "Laporan Penjualan";
			$data['data'] = $this->l->getPriode();
			$data['transaksi'] = $this->l->getToday();
			$data['dari'] = $this->input->post('dari');
			$data['sampai'] = $this->input->post('sampai');
			$data['p_pendapatan'] = $this->l->getPendapatanPriode();
			$data['p_hari_ini'] = $this->l->getPendapatanHariIni();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('laporan/history', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);
		}

	}

	public function detil($id)
	{
		$data['judul'] = "Detail Transaksi";
		$data['transaksi'] = $this->l->getDetil($id);
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('laporan/detil', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function hapus($id)
	{
		$this->db->delete('transaksi',['kd_transaksi' => $id]);
		$this->db->delete('detil_transaksi',['kd_transaksi' => $id]);
		$this->session->set_flashdata('message', 'dihapus');
		redirect('laporan','refresh');
	}

	public function riwayat()
	{
		$this->form_validation->set_rules('dari', 'Dari', 'required');
		$this->form_validation->set_rules('sampai', 'sampai', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Riwayat Transaksi";
			$data['transaksi'] = $this->l->getRiwayatToday();
			$data['p_hari_ini'] = $this->l->getPendapatanHariIni();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('laporan/riwayat', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$data['judul'] = "Riwayat Transaksi";
			$data['data'] = $this->l->getRiwayatPriode();
			$data['transaksi'] = $this->l->getToday();
			$data['dari'] = $this->input->post('dari');
			$data['sampai'] = $this->input->post('sampai');
			$data['p_pendapatan'] = $this->l->getPendapatanPriode();
			$data['p_hari_ini'] = $this->l->getPendapatanHariIni();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('laporan/riwayat', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);
		}

	}



}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */