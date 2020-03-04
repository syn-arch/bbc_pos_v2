<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Master_m','m');
		$this->load->model('Akses_m','a');
	}

	public function getSelectKelas()
	{
		$kelas = $this->db->get_where('kelas', ['kd_departemen' => $_POST['kd_departemen']])->result_array();

		foreach ($kelas as $row) {
			echo "<option value='". $row['kd_kelas'] ."' >" . $row['nm_kelas'] . " </option>";
		}
	}

	public function index()
	{
		$data['judul'] = "Data Barang";
		$data['barang'] = $this->m->getAllBarang();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/index', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function tambah_barang()
	{
		$this->form_validation->set_rules('nm_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga_jual', 'Harga beli', 'required');
		$this->form_validation->set_rules('kd_departemen', 'Nama Departemen', 'required');
		$this->form_validation->set_rules('kd_kelas', 'Nama Kelas', 'required');
		$this->form_validation->set_rules('kd_supplier', 'Nama Supplier', 'required');
		$this->form_validation->set_rules('harga_beli', 'Harga jual', 'required');
		$this->form_validation->set_rules('diskon', 'Diskon', 'required');
		$this->form_validation->set_rules('stok', 'stok', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Tambah Barang";
			$data['supplier'] = $this->m->getAllSupplier();
			$data['departemen'] = $this->m->getAlldepartemen();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-barang', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->addbarang();
			$this->session->set_flashdata('message','ditambahkan');
			redirect('master','refresh');
		}
	}

	public function edit_barang($kd)
	{
		$this->form_validation->set_rules('nm_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga_jual', 'Harga beli', 'required|integer');
		$this->form_validation->set_rules('harga_beli', 'Harga jual', 'required|integer');
		$this->form_validation->set_rules('diskon', 'Diskon', 'required|integer');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Edit Barang";
			$data['supplier'] = $this->m->getAllSupplier();
			$data['departemen'] = $this->m->getAlldepartemen();
			$data['barang'] = $this->m->getBarangByKd($kd);
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-barang', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->updatebarang();
			$this->session->set_flashdata('message','diubah');
			redirect('master','refresh');
		}
	}

	public function hapus_barang($kd)
	{
		$gambar_lama = $this->db->get_where('barang', ['kd_barang' => $kd])->row_array()['gambar'];
		$this->db->delete('barang', ['kd_barang' => $kd]);
		unlink(FCPATH . './assets/img/barang/' . $gambar_lama);
		$this->session->set_flashdata('message','dihapus');
		redirect('master','refresh');
	}

	public function departemen()
	{
		$data['judul'] = "Data Departement";
		$data['departemen'] = $this->m->getAllDepartemen();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/departemen', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function tambah_departemen()
	{
		$this->form_validation->set_rules('nm_departemen', 'Nama departemen', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Tambah departemen";
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-departemen', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->adddepartemen();
			$this->session->set_flashdata('message','ditambahkan');
			redirect('master/departemen','refresh');
		}

	}

	public function edit_departemen($kd)
	{
		$this->form_validation->set_rules('nm_departemen', 'Nama departemen', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Edit departemen";
			$data['departemen'] = $this->m->getdepartemenByKd($kd);
			$data['kelas'] = $this->db->get_where('kelas',['kd_departemen' => $kd])->result_array();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-departemen', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->updatedepartemen();
			$this->session->set_flashdata('message','diubah');
			redirect('master/departemen','refresh');
		}
	}

	public function hapus_departemen($kd)
	{
		$this->db->delete('departemen', ['kd_departemen' => $kd]);
		$this->db->delete('kelas', ['kd_departemen' => $kd]);
		$this->session->set_flashdata('message','dihapus');
		redirect('master/departemen','refresh');
	}

	public function tambah_kelas()
	{
		$this->form_validation->set_rules('nm_kelas', 'Nama kelas', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Tambah kelas";
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-kelas', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->addkelas();
			$this->session->set_flashdata('message','ditambahkan');
			redirect('master/edit_departemen/' . $this->uri->segment(3),'refresh');
		}

	}

	public function edit_kelas($dep, $kelas)
	{
		$this->form_validation->set_rules('nm_kelas', 'Nama kelas', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Edit kelas";
			$data['kelas'] = $this->m->getkelasByKd($kelas);
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-kelas', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->updatekelas();
			$this->session->set_flashdata('message','diubah');
			redirect('master/edit_departemen/' . $dep,'refresh');
		}
	}

	public function hapus_kelas($kd, $dep)
	{
		$this->db->delete('kelas', ['kd_kelas' => $kd]);
		$this->session->set_flashdata('message','dihapus');
		redirect('master/edit_departemen/' . $dep,'refresh');
	}

	public function supplier()
	{
		$data['judul'] = "Data Supplier";
		$data['supplier'] = $this->m->getAllSupplier();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/supplier', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function tambah_supplier()
	{
		$this->form_validation->set_rules('nm_supplier', 'Nama Supplier', 'required');
		$this->form_validation->set_rules('alamat', 'Telepon', 'required');
		$this->form_validation->set_rules('telepon', 'Supplier', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Tambah Supplier";
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-supplier', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->addsupplier();
			$this->session->set_flashdata('message','ditambahkan');
			redirect('master/supplier','refresh');
		}

	}
	public function hapus_supplier($kd)
	{
		$this->db->delete('supplier', ['kd_supplier' => $kd]);
		$this->session->set_flashdata('message','dihapus');
		redirect('master/supplier','refresh');
	}

	public function edit_supplier($kd)
	{
		$this->form_validation->set_rules('nm_supplier', 'Nama supplier', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Edit Supplier";
			$data['supplier'] = $this->m->getSupplierBykd($kd);
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-supplier', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->updatesupplier();
			$this->session->set_flashdata('message','diubah');
			redirect('master/supplier','refresh');
		}
	}

	public function petugas()
	{
		$data['judul'] = "Data Petugas";
		$data['petugas'] = $this->m->getAllPetugas();
		
		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/petugas', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function hapus_petugas($kd)
	{
		$user = $this->m->getPetugasByKd($kd);
		unlink(FCPATH . './assets/img/user/' . $user['gambar']);

		$this->db->delete('user', ['kd_user' => $kd]);
		$this->session->set_flashdata('message','dihapus');
			redirect('master/petugas','refresh');
	}

	public function tambah_petugas()
	{
		$this->form_validation->set_rules('nm_user', 'Nama Petugas', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[user.email]');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Tambah Petugas";
			$data['role'] = $this->a->getAllRole();
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-petugas', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->addpetugas();
			$this->session->set_flashdata('message','ditambahkan');
			redirect('master/petugas','refresh');
		}

	}

	public function edit_petugas($kd)
	{
		$this->form_validation->set_rules('nm_user', 'Nama Petugas', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = "Edit Petugas";
			$data['role'] = $this->a->getAllRole();
			$data['petugas'] = $this->m->getPetugasByKd($kd);
			
			$this->load->view('templates/header', $data, FALSE);	
			$this->load->view('master/form-petugas', $data, FALSE);	
			$this->load->view('templates/footer', $data, FALSE);	
		} else {
			$this->m->updatepetugas();
			$this->session->set_flashdata('message','diubah');
			redirect('master/petugas','refresh');
		}

	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */