<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

	public function getUserByKd($kd)
	{
		return $this->db->query("SELECT * FROM user JOIN role ON `user`.`id_role` = `role`.`id` WHERE `user`.`kd_user` = '$kd' ")->row_array();
	}

	private function _upload_petugas()
	{
		$config['upload_path'] = './assets/img/user/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('gambar')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error['error']);
			redirect('user','refresh');
		}

		return $this->upload->data('file_name');

	}

	public function update()
	{
		$post = $this->input->post();
		$gambar = $_FILES['gambar']['name'];
		$gambar_lama = $this->db->get_where('user', ['kd_user' => $post['kd_user']])->row_array()['gambar'];

		if ($gambar) {
			$this->db->set('gambar', $this->_upload_petugas() );
			unlink(FCPATH . './assets/img/user/' . $gambar_lama );
		}

		$this->db->set('nm_user', $post['nm_user']);
		$this->db->set('alamat', $post['alamat']);
		$this->db->set('telepon', $post['telepon']);
		$this->db->set('email', $post['email']);
		$this->db->set('jk', $post['jk']);
		$this->db->where('kd_user', $post['kd_user']);
		$this->db->update('user');

	}

	public function update_password()
	{
		$post = $this->input->post();
		$pw_lama = $this->getUserByKd($this->session->userdata('kd_user'))['password'];

		if (password_verify($post['pw_lama'], $pw_lama)) {

			$pw_baru = password_hash($post['pw1'], PASSWORD_DEFAULT);

			$this->db->set('password', $pw_baru);
			$this->db->where('kd_user', $this->session->userdata('kd_user'));
			$this->db->update('user');
			
		}else{
			$this->session->set_flashdata('error','Password lama salah');
			redirect('user/ubah_password','refresh');
		}
	}

}

/* End of file User_m.php */
/* Location: ./application/models/User_m.php */ ?>