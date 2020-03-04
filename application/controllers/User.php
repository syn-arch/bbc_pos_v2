<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('User_m','u');
	}

	public function index()
	{
		$data['judul'] = "My Profile";
		$data['profile'] = $this->u->getUserByKd($this->session->userdata('kd_user'));
				
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('user/index', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);			
	}

	public function edit_profile()
	{
		$this->form_validation->set_rules('nm_user', 'Nama User', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Edit Profile";
			$data['profile'] = $this->u->getUserByKd($this->session->userdata('kd_user'));
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('user/edit', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);			
		} else {
			$this->u->update();
			$this->session->set_flashdata('message','diubah');
			redirect('user','refresh');
		}

	}

	public function ubah_password()
	{
		$this->form_validation->set_rules('pw_lama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('pw1', 'Password Baru', 'trim|required|matches[pw2]');
		$this->form_validation->set_rules('pw2', 'Konfirmasi Password Baru', 'trim|required|matches[pw1]');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Ubah Password";
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('user/ubah_password', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);			
		} else {
			$this->u->update_password();
			$this->session->set_flashdata('message','diubah');
			redirect('user/ubah_password','refresh');
		}

	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */ ?>