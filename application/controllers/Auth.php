<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('role')) {
			redirect('admin','refresh');	
		}

		$this->form_validation->set_rules('email', 'E-mail', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login');		
		} else {
			$post = $this->input->post();
			$user = $this->db->get_where('user',['email' => $post['email']])->row_array();

			if ($user) {

				if (password_verify($post['password'], $user['password'])) {

					$array = array(
						'role' => $user['id_role'],
						'email' => $user['email'],
						'gambar' => $user['gambar'],
						'nama' => $user['nm_user'],
						'kd_user' => $user['kd_user']
					);
					
					$this->session->set_userdata( $array );
					redirect('admin','refresh');	

				}else{
					$this->session->set_flashdata('message', 'Password anda salah.');
					redirect('auth','refresh');	
				}
				
			}else{
				$this->session->set_flashdata('message', 'Username Tidak Ditemukan.');
				redirect('auth','refresh');
			}

		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth','refresh');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */ ?>