<?php
Class FPDF_t extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('pdf');
	}
	
	function index(){
		$pdf= new FPDF('L','mm','A4');
		
		$pdf->AddPage();
		
		$pdf->SetFont('Times New Roman','B','16');
		$ya=44;
		
		$pdf->Cell(150,7,'Laporan Knowledge Tacit | Laporan Pengetahuan Tacit Pusat Komputer IAIN Bengkulu',0,1,'C');
		$pdf->SetFont('Times New Roman','B','14');
		$pdf->Cell(150,7,'Daftar Pengetahuan Tacit Pegawai Pusat Komputer 2019',0,1,'C');
		
		$pdf->Cell(10,7,'',0,1);
		$pdf->SetFont('Times New Roman','B','12');
		$pdf->Cell(15,6,'ID',1,0);
		$pdf->Cell(40,6,'NAMA.P',1,0);
		$pdf->Cell(40,6,'JUDUL',1,0);
		$pdf->Cell(40,6,'GEJALA.G',1,0);
		$pdf->Cell(40,6,'MASALAH',1,0);
		$pdf->Cell(40,6,'NAMA.S',1,0);
		$pdf->Cell(40,6,'SOLUSI',1,0);
		
		
		$pdf->SetFont('Times New Roman','B','12');
		
		$data=$this->web_model->laporan_tacit();
		foreach ($data as $row){
		$pdf->Cell(15,6,$row->id_tacit,1,0);
		$pdf->Cell(40,6,$row->nama,1,0);
		$pdf->Cell(40,6,$row->judul_tacit,1,0);
		$pdf->Cell(40,6,$row->nama_gejala,1,0);
		$pdf->Cell(40,6,$row->masalah,1,0);
		$pdf->Cell(40,6,$row->nama_solusi,1,0);
		$pdf->Cell(35,6,$row->solusi,1,0);
		}
		$pdf->Output();
		
	}
	
	
	
	
}