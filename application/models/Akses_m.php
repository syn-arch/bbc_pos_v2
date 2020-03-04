<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses_m extends CI_Model {

	public function getAllRole()
	{
		return $this->db->get('role')->result_array();
	}

	public function getAllMenu()
	{
		return $this->db->get('menu')->result_array();
	}

	public function getAllSubMenu()
	{
		return $this->db->get('sub_menu')->result_array();
	}

	public function add()
	{
		$post = $this->input->post();

		$data = [
			'id' => null,
			'nm_role' => $post['role']
		];

		$this->db->insert('role', $data);
	}

	public function delete($id)
	{
		$this->db->delete('role', ['id' => $id]);
		$this->db->delete('akses_menu', ['id_role' => $id]);
		$this->db->delete('akses_submenu', ['id_role' => $id]);
	}
	

}

/* End of file Menu_m.php */
/* Location: ./application/models/Menu_m.php */ ?>