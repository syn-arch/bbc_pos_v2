<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Admin_m','am');
	}

	public function index()
	{
		$data['judul'] = "Dashboard";
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('admin/index', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function config()
	{
		$this->form_validation->set_rules('nm_toko', 'Nama Toko', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('telepon', 'telepon', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Konfigurasi";
			$data['config'] = $this->am->getConfig();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('admin/config', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->am->updateconfig();
			$this->session->set_flashdata('message', 'diubah');
			redirect('admin/config','refresh');
		}

	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */