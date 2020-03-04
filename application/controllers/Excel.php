<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
// End load library phpspreadsheet


class Excel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Master_m','m');
		$this->load->model('Laporan_m','l');
	}

	public function index() // ekspor barang
	{
	 	$barang = $this->m->getAllBarang();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'Kode Barang')
		->setCellValue('B1', 'Barcode')
		->setCellValue('C1', 'Kode Departemen')
		->setCellValue('D1', 'Kode Supplier')
		->setCellValue('E1', 'Kode Kelas')
		->setCellValue('F1', 'Nama Barang')
		->setCellValue('G1', 'Harga Jual')
		->setCellValue('H1', 'Harga Beli')
		->setCellValue('I1', 'Profit')
		->setCellValue('J1', 'Stok')
		->setCellValue('K1', 'Diskon')
		->setCellValue('L1', 'Gambar')
		->setCellValue('M1', 'Ada Barcode')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($barang as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['kd_barang'])
			->setCellValue('B' . $i, $row['barcode'])
			->setCellValue('C' . $i, $row['kd_departemen'])
			->setCellValue('D' . $i, $row['kd_supplier'])
			->setCellValue('E' . $i, $row['kd_kelas'])
			->setCellValue('F' . $i, $row['nm_barang'])
			->setCellValue('G' . $i, $row['harga_jual'])
			->setCellValue('H' . $i, $row['harga_beli'])
			->setCellValue('I' . $i, $row['profit'])
			->setCellValue('J' . $i, $row['stok'])
			->setCellValue('K' . $i, $row['diskon'])
			->setCellValue('L' . $i, $row['gambar'])
			->setCellValue('M' . $i, $row['ada_barcode']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Laporan ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Data Barang.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;

	}

	public function import_barang()
	{
		$data['judul'] = "Import Brang";

		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/import_barang', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function import_barang_excel()
	{

	 	$f = explode('.', $_FILES['file_excel']['name']);

	 	$extension = end($f);
	 
	    if($extension == 'csv') {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	    } else {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	    }
	 
	    $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
	     
	    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	    
		for($i = 1;$i < count($sheetData); $i++)
		{
			$data = [
				'kd_barang' => $sheetData[$i]['0'],
				'barcode' => $sheetData[$i]['1'],
				'kd_departemen' => $sheetData[$i]['2'],
				'kd_supplier' => $sheetData[$i]['3'],
				'kd_kelas' => $sheetData[$i]['4'],
				'nm_barang' => $sheetData[$i]['5'],
				'harga_jual' => $sheetData[$i]['6'],
				'harga_beli' => $sheetData[$i]['7'],
				'profit' => $sheetData[$i]['8'],
				'stok' => $sheetData[$i]['9'],
				'diskon' => $sheetData[$i]['10'],
				'gambar' => $sheetData[$i]['11'],
				'ada_barcode' => $sheetData[$i]['12']
			];

			$this->db->insert('barang', $data);
	    }

	    $this->session->set_flashdata('message', 'Diimpor');
	    redirect('master/index','refresh');
	}

	// Ekspor
	public function ekspor_departemen()
	{
	 	$barang = $this->m->getAllDepartemen();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'kd_departemen')
		->setCellValue('B1', 'nm_departemen')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($barang as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['kd_departemen'])
			->setCellValue('B' . $i, $row['nm_departemen']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Laporan ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Departemen.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	public function ekspor_kelas()
	{
	 	$barang = $this->m->getAllKelas();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'kd_kelas')
		->setCellValue('B1', 'kd_departemen')
		->setCellValue('C1', 'nm_kelas')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($barang as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['kd_kelas'])
			->setCellValue('B' . $i, $row['kd_departemen'])
			->setCellValue('C' . $i, $row['nm_kelas']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Laporan ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Kelas.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	public function ekspor_supplier()
	{
	 	$barang = $this->m->getAllSupplier();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'kd_supplier')
		->setCellValue('B1', 'nm_supplier')
		->setCellValue('C1', 'alamat')
		->setCellValue('D1', 'telepon')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($barang as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['kd_supplier'])
			->setCellValue('B' . $i, $row['nm_supplier'])
			->setCellValue('C' . $i, $row['alamat'])
			->setCellValue('D' . $i, $row['telepon']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Laporan ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Supplier.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	public function ekspor_petugas()
	{
	 	$barang = $this->m->getAllPetugas();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'kd_user')
		->setCellValue('B1', 'id_role')
		->setCellValue('C1', 'nm_user')
		->setCellValue('D1', 'alamat')
		->setCellValue('E1', 'telepon')
		->setCellValue('F1', 'jk')
		->setCellValue('G1', 'email')
		->setCellValue('H1', 'password')
		->setCellValue('I1', 'gambar')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($barang as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['kd_user'])
			->setCellValue('B' . $i, $row['id_role'])
			->setCellValue('C' . $i, $row['nm_user'])
			->setCellValue('D' . $i, $row['alamat'])
			->setCellValue('E' . $i, $row['telepon'])
			->setCellValue('F' . $i, $row['jk'])
			->setCellValue('G' . $i, $row['email'])
			->setCellValue('H' . $i, $row['password'])
			->setCellValue('I' . $i, $row['gambar']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Laporan ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Petugas.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	// import form
	public function import_departemen()
	{
		$data['judul'] = "Import Departemen";

		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/import_departemen', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function import_kelas()
	{
		$data['judul'] = "Import kelas";

		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/import_kelas', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function import_petugas()
	{
		$data['judul'] = "Import petugas";

		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/import_petugas', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	public function import_supplier()
	{
		$data['judul'] = "Import supplier";

		$this->load->view('templates/header', $data, FALSE);	
		$this->load->view('master/import_supplier', $data, FALSE);	
		$this->load->view('templates/footer', $data, FALSE);	
	}

	// import action
	public function import_departemen_excel()
	{

	 	$f = explode('.', $_FILES['file_excel']['name']);

	 	$extension = end($f);
	 
	    if($extension == 'csv') {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	    } else {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	    }
	 
	    $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
	     
	    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	    
		for($i = 1;$i < count($sheetData); $i++)
		{
			$data = [
				'kd_departemen' => $sheetData[$i]['0'],
				'nm_departemen' => $sheetData[$i]['1']
			];

			$this->db->insert('departemen', $data);
	    }

	    $this->session->set_flashdata('message', 'Diimpor');
	    redirect('master/departemen','refresh');
	}

	public function import_kelas_excel()
	{

	 	$f = explode('.', $_FILES['file_excel']['name']);

	 	$extension = end($f);
	 
	    if($extension == 'csv') {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	    } else {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	    }
	 
	    $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
	     
	    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	    
		for($i = 1;$i < count($sheetData); $i++)
		{
			$data = [
				'kd_kelas' => $sheetData[$i]['0'],
				'kd_departemen' => $sheetData[$i]['1'],
				'nm_kelas' => $sheetData[$i]['2']
			];

			$this->db->insert('kelas', $data);
	    }

	    $this->session->set_flashdata('message', 'Diimpor');
	    redirect('master/departemen','refresh');
	}

	public function import_petugas_excel()
	{

	 	$f = explode('.', $_FILES['file_excel']['name']);

	 	$extension = end($f);
	 
	    if($extension == 'csv') {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	    } else {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	    }
	 
	    $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
	     
	    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	    
		for($i = 1;$i < count($sheetData); $i++)
		{
			$data = [
				'kd_user' => $sheetData[$i]['0'],
				'id_role' => $sheetData[$i]['1'],
				'nm_user' => $sheetData[$i]['2'],
				'alamat' => $sheetData[$i]['3'],
				'telepon' => $sheetData[$i]['4'],
				'jk' => $sheetData[$i]['5'],
				'email' => $sheetData[$i]['6'],
				'password' => $sheetData[$i]['7'],
				'gambar' => $sheetData[$i]['8']
			];

			$this->db->insert('user', $data);
	    }

	    $this->session->set_flashdata('message', 'Diimpor');
	    redirect('master/petugas','refresh');
	}

	public function import_supplier_excel()
	{

	 	$f = explode('.', $_FILES['file_excel']['name']);

	 	$extension = end($f);
	 
	    if($extension == 'csv') {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	    } else {
	        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	    }
	 
	    $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
	     
	    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	    
		for($i = 1;$i < count($sheetData); $i++)
		{
			$data = [
				'kd_supplier' => $sheetData[$i]['0'],
				'nm_supplier' => $sheetData[$i]['1'],
				'alamat' => $sheetData[$i]['2'],
				'telepon' => $sheetData[$i]['3']
			];

			$this->db->insert('supplier', $data);
	    }

	    $this->session->set_flashdata('message', 'Diimpor');
	    redirect('master/supplier','refresh');
	}

	// EKsport laporan
	public function ekspor_laporan()
	{
	 	$laporan = $this->l->getToday();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'Kode Barang')
		->setCellValue('B1', 'Barcode')
		->setCellValue('C1', 'Nama Barang')
		->setCellValue('D1', 'Jumlah Barang Terjual')
		->setCellValue('E1', 'Harga Beli')
		->setCellValue('F1', 'Harga Jual')
		->setCellValue('G1', 'Profit')
		->setCellValue('H1', 'Laba')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($laporan as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['kd_barang'])
			->setCellValue('B' . $i, $row['barcode'])
			->setCellValue('C' . $i, $row['nm_barang'])
			->setCellValue('D' . $i, $row['brg_terjual'])
			->setCellValue('E' . $i, $row['harga_beli'])
			->setCellValue('F' . $i, $row['harga_jual'])
			->setCellValue('G' . $i, $row['profit'])
			->setCellValue('H' . $i, $row['laba']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Laporan ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Penjualan ' . date('d-m-Y') . ' .xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}

	// EKsport laporan
	public function eksporByDate($dari, $sampai)
	{
	 	$laporan = $this->l->getByDate($dari, $sampai);
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();
		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'Kode Barang')
		->setCellValue('B1', 'Barcode')
		->setCellValue('C1', 'Nama Barang')
		->setCellValue('D1', 'Jumlah Barang Terjual')
		->setCellValue('E1', 'Harga Beli')
		->setCellValue('F1', 'Harga Jual')
		->setCellValue('G1', 'Profit')
		->setCellValue('H1', 'Laba')
		;
		// Miscellaneous glyphs, UTF-8
		$i=2; 
		foreach($laporan as $row) {
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $i, $row['kd_barang'])
			->setCellValue('B' . $i, $row['barcode'])
			->setCellValue('C' . $i, $row['nm_barang'])
			->setCellValue('D' . $i, $row['brg_terjual'])
			->setCellValue('E' . $i, $row['harga_beli'])
			->setCellValue('F' . $i, $row['harga_jual'])
			->setCellValue('G' . $i, $row['profit'])
			->setCellValue('H' . $i, $row['laba']);
			$i++;
		}                           

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Laporan ' . date('d-m-Y H'));

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Laporan Penjualan dari ' . $dari . ' sampai ' . $sampai . ' .xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}
}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */