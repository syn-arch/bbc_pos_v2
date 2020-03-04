<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_m extends CI_Model {

	public function getAllPetugas()
	{
		$query = "SELECT * FROM user JOIN role ON `user`.`id_role` = `role`.`id` ";
		return $this->db->query($query)->result_array();
	}

	public function getAllKelas()
	{
		return $this->db->get('kelas')->result_array();
	}

	public function getPetugasByKd($kd)
	{
		return $this->db->get_where('user', ['kd_user' => $kd])->row_array();
	}

	private function _upload_petugas()
	{
		$config['upload_path'] = './assets/img/user/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('gambar')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error['error']);
			redirect('master/petugas','refresh');
		}

		return $this->upload->data('file_name');

	}

	public function addpetugas()
	{
		$post = $this->input->post();
		$gambar = $_FILES['gambar']['name'];

		$password = password_hash("password", PASSWORD_DEFAULT);

		$data = [
			'id_role' => $post['id_role'],
			'nm_user' => $post['nm_user'],
			'alamat' => $post['alamat'],
			'telepon' => $post['telepon'],
			'email' => $post['email'],
			'password' => $password,
			'jk' => $post['jk'],
			'gambar' => $this->_upload_petugas()
		];

		$this->db->insert('user', $data);
	}

	public function updatepetugas()
	{
		$post = $this->input->post();
		$gambar = $_FILES['gambar']['name'];
		$gambar_lama = $this->getPetugasByKd($post['kd_user'])['gambar'];

		if ($gambar) {
			$this->db->set('gambar', $this->_upload_petugas());
			unlink(FCPATH . './assets/img/user/' . $gambar_lama );
		}

		$this->db->set('id_role', $post['id_role']);
		$this->db->set('nm_user', $post['nm_user']);
		$this->db->set('alamat', $post['alamat']);
		$this->db->set('telepon', $post['telepon']);
		$this->db->set('email', $post['email']);
		$this->db->set('jk', $post['jk']);
		$this->db->where('kd_user', $post['kd_user']);
		$this->db->update('user');
	}

	public function getAlldepartemen()
	{
		return $this->db->get('departemen')->result_array();
	}

	public function getdepartemenByKd($kd)
	{
		return $this->db->get_where('departemen', ['kd_departemen' => $kd])->row_array();
	}

	public function getkelasByKd($kd)
	{
		return $this->db->get_where('kelas', ['kd_kelas' => $kd])->row_array();
	}

	public function adddepartemen()
	{
		$post = $this->input->post();

		$this->db->insert('departemen', ['kd_departemen' => '', 'nm_departemen' => $post['nm_departemen']]);
	}

	public function updatedepartemen()
	{
		$post = $this->input->post();

		$this->db->set('nm_departemen', $post['nm_departemen']);
		$this->db->where('kd_departemen', $post['kd_departemen']);
		$this->db->update('departemen');
	}

	public function addkelas()
	{
		$post = $this->input->post();
		$dep = $this->uri->segment(3);

		$this->db->insert('kelas', ['kd_kelas' => '','kd_departemen' => $dep, 'nm_kelas' => $post['nm_kelas']]);
	}

	public function updatekelas()
	{
		$post = $this->input->post();

		$this->db->set('nm_kelas', $post['nm_kelas']);
		$this->db->where('kd_kelas', $post['kd_kelas']);
		$this->db->update('kelas');
	}

	public function getAllSupplier()
	{
		return $this->db->get('supplier')->result_array();
	}

	public function getSupplierByKd($kd)
	{
		return $this->db->get_where('supplier',['kd_supplier' => $kd])->row_array();
	}

	public function addsupplier()
	{
		$post = $this->input->post();

		$object = [
			'nm_supplier' => $post['nm_supplier'],
			'alamat' => $post['alamat'],
			'telepon' =>$post['telepon']
		];

		$this->db->insert('supplier', $object);
	}

	public function updatesupplier()
	{
		$post = $this->input->post();

		$this->db->set('nm_supplier', $post['nm_supplier']);
		$this->db->set('alamat', $post['alamat']);
		$this->db->set('telepon', $post['telepon']);
		$this->db->where('kd_supplier', $post['kd_supplier']);
		$this->db->update('supplier');
	}

	public function getAllBarang()
	{
		$query = "SELECT * FROM barang JOIN departemen USING(kd_departemen) JOIN supplier USING(kd_supplier) JOIN kelas USING(kd_kelas)";
		return $this->db->query($query)->result_array();
	}

	public function getAllBarangNoBarcode()
	{
		$query = "SELECT * FROM barang JOIN departemen USING(kd_departemen) JOIN supplier USING(kd_supplier) JOIN kelas USING(kd_kelas) WHERE ada_barcode = 0";
		return $this->db->query($query)->result_array();
	}

	public function getBarangByKd($kd)
	{
		$query = "SELECT * FROM barang JOIN departemen USING(kd_departemen) JOIN supplier USING(kd_supplier) WHERE kd_barang = '$kd'";
		return $this->db->query($query)->row_array();
	}

	public function getBarangByBar($kd)
	{
		$query = "SELECT * FROM barang JOIN departemen USING(kd_departemen) JOIN supplier USING(kd_supplier) WHERE barcode = '$kd' OR kd_barang = '$kd' ";
		return $this->db->query($query)->row_array();
	}

	private function _upload_barang()
	{
		$config['upload_path'] = './assets/img/barang/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('gambar')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error['error']);
			redirect('master','refresh');
		}

		return $this->upload->data('file_name');
	}

	public function addbarang()
	{
		$post = $this->input->post();

		$profit = (int) $post['harga_jual'] - (int) $post['harga_beli'];

		if (isset($post['ada_barcode'])) {
			if ($post['ada_barcode'] == 1) {
				$ada_barcode = 1;
			}else{
				$ada_barcode = 0;
			}
		}else{
			$ada_barcode = 0;
		}

		$data = [
			'barcode' => $post['barcode'],
			'kd_departemen' => $post['kd_departemen'],
			'kd_supplier' => $post['kd_supplier'],
			'nm_barang' => $post['nm_barang'],
			'kd_kelas' => $post['kd_kelas'],
			'harga_jual' => $post['harga_jual'],
			'harga_beli' => $post['harga_beli'],
			'diskon' => $post['diskon'],
			'stok' => $post['stok'],
			'profit' => $profit,
			'gambar' => $this->_upload_barang(),
			'ada_barcode' => $ada_barcode
		];

		$this->db->insert('barang', $data);
	}

	public function updatebarang()
	{
		$post = $this->input->post();
		$gambar = $_FILES['gambar']['name'];
		$gambar_lama = $this->db->get_where('barang', ['kd_barang' => $post['kd_barang']])->row_array()['gambar'];
		$profit = (int) $post['harga_jual'] - (int) $post['harga_beli'];

		if ($gambar) {
			$this->db->set('gambar', $this->_upload_barang());
			unlink(FCPATH . './assets/img/barang/' . $gambar_lama);
		}

		if (isset($post['ada_barcode'])) {
			if ($post['ada_barcode'] == 1) {
				$ada_barcode = 1;
			}else{
				$ada_barcode = 0;
			}
		}else{
			$ada_barcode = 0;
		}

		$this->db->set('nm_barang', $post['nm_barang']);
		$this->db->set('barcode', $post['barcode']);
		$this->db->set('kd_departemen', $post['kd_departemen']);
		$this->db->set('kd_supplier', $post['kd_supplier']);
		$this->db->set('harga_jual', $post['harga_jual']);
		$this->db->set('harga_beli', $post['harga_beli']);
		$this->db->set('diskon', $post['diskon']);
		$this->db->set('stok', $post['stok']);
		$this->db->set('profit', $profit);
		$this->db->set('ada_barcode', $ada_barcode);
		$this->db->where('kd_barang', $post['kd_barang']);
		$this->db->update('barang');


	}


}

/* End of file Master_m.php */
/* Location: ./application/models/Master_m.php */ ?>