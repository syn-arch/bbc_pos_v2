<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model {

	public function getConfig()
	{
		return $this->db->get('toko')->row_array();
	}

	private function _upload()
	{
		$config['upload_path'] = './assets/img/admin/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('gambar')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error['error']);
			redirect('admin/config','refresh');
		}

		return $this->upload->data('file_name');
	}

	public function updateConfig()
	{
		$post = $this->input->post();
		$gambar = $_FILES['gambar']['name'];
		$gambar_lama = $this->db->get('toko')->row_array()['gambar'];

		if ($gambar) {
			$this->db->set('gambar', $this->_upload());
			unlink(FCPATH . './assets/img/admin/' . $gambar_lama);
		}

		$this->db->set('nm_toko', $post['nm_toko']);
		$this->db->set('alamat', $post['alamat']);
		$this->db->set('telepon', $post['telepon']);
		$this->db->set('keterangan', $post['keterangan']);
		$this->db->update('toko');
	}

	

}

/* End of file Admin_m.php */
/* Location: ./application/models/Admin_m.php */ ?>