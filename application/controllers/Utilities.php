<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Master_m','m');
	}

	public function index()
	{
		$data['judul'] = "Cetak Barcode";
		$data['barang'] = $this->m->getAllBarang();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('Utilities/index', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function tambah_barcode()
	{
	    $post = $this->input->post();

	    if (!$post) {
	    	redirect('utilities','refresh');
	    }

	    $mfg = explode('-', $post['mfg_date']);
	    $mfg_baru = str_replace('20', '', $mfg[0]);
	    $mfg_new = $mfg_baru . $mfg[1] . $mfg[2];

	    $exp = explode('-', $post['exp_date']);
	    $exp_baru = str_replace('20', '', $exp[0]);
	    $exp_new = $exp_baru . $exp[1] . $exp[2];

	    $barcode = $mfg_new . $exp_new;
	    
	    $data['barcode'] = $barcode;

	    $this->load->view('utilities/barcode', $data);
	}

	public function backup()
	{
		$this->load->dbutil();
		$prefs = [
			'format'   => 'zip',
			'filename' => 'backup-database-on-'.date("Y-m-d H-i-s").'.sql'
		];
		$backup =& $this->dbutil->backup($prefs);
		$file_name = 'backup-database-on-'. date("Y-m-d-H-i-s") .'.zip';
		$this->zip->download($file_name);
	}


}

/* End of file Utilities.php */
/* Location: ./application/controllers/Utilities.php */