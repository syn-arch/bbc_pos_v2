<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Akses_m','a');
	}

	public function index()
	{
		$data['judul'] = "Pengaturan Hak Akses";
		$data['akses'] = $this->a->getAllRole();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('akses/index', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function edit($id)
	{
		$data['judul'] = "Pengaturan Hak Akses";
		$data['menu'] = $this->a->getAllMenu();
		$data['submenu'] = $this->a->getAllSubMenu();
		$data['role'] = $this->a->getAllRole();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('akses/edit', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function tambah()
	{
		$this->form_validation->set_rules('role', 'Role', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Tambah Data";
		
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('akses/form', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);
		} else {
			$this->a->add();
			$this->session->flashdata('message','ditambahkan');
			redirect('akses','refresh');
		}
	}

	public function hapus($id)
	{
			$this->a->delete($id);
			$this->session->flashdata('message','dihapus');
			redirect('akses','refresh');
	}

	public function ubah_akses()
	{
		$post =  $this->input->post();

		$data = [
			'id_menu' => $post['id_menu'],
			'id_role' => $post['id_role']
		];

		$cek = $this->db->get_where('akses_menu',$data);

		if ($cek->num_rows() < 1) {
			$this->db->insert('akses_menu', $data);
		}else{
			$this->db->delete('akses_menu', $data);
		}
	}

	public function ubah_akses_sub()
	{
		$post =  $this->input->post();

		$data = [
			'id_submenu' => $post['id_submenu'],
			'id_role' => $post['id_role']
		];

		$cek = $this->db->get_where('akses_submenu',$data);

		if ($cek->num_rows() < 1) {
			$this->db->insert('akses_submenu', $data);
		}else{
			$this->db->delete('akses_submenu', $data);
		}
	}

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */ ?>