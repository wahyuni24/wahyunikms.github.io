<?php

class Laporan extends Controller
{
  function Laporan()
  {
    parent::Controller();
    $this->load->model("report_model","",true);
  }
  
  function index()
  {
    $this->load->view('cetak_explicit', $data);
  }
  
  function pdf_explicit(){
		 
	$idpengguna = 2;

    // ambil data dengan memanggil fungsi di model
    $temp_rec = $this->laporan_model->laporan_explicit($idpengguna);
    $num_rows = $temp_rec->num_rows();

    if($num_rows > 0) // jika data ada di database
    {
      // memanggil (instantiasi) class reportProduct di file cetak_laporan_helper.php
      $a=new reportProduct();
      // anda dapat membuat report lainnya dalam satu file cetak_laporan_helper.php
      // dengan cukup mengubah setKriteria dan membuat kondisi (elseif) di file cetak_laporan_helper.php
      $a->setKriteria("explicit");
      // judul report
      $a->setNama("Laporan Knowledge Explicit | Laporan Pengetahuan Explicit Pusat Komputer IAIN Bengkulu".$idpengguna);
      // buat halaman
      $a->AliasNbPages();
      // Potrait ukuran A4
      $a->AddPage("L","A4");

      // ambil data dari database
      $data=$temp_rec->row();

      $a->Ln(2); // spasi enter
      $a->SetFont('Arial','B',12); // set font,size,dan properti (B=Bold)
      $a->Cell(0,4,'Id Pengguna (User) : '.number_format($data->id_pengguna,0,1,'L'));
      $a->Cell(0,4,'Nomor Induk Pegawai : '.$data->nip,0,1,'L');
      $a->Cell(0,4,'Nama Pengguna (User) : '.$data->nama,0,1,'L');
      $a->Ln(2);

      $a->SetFont('Arial','',12);
      // set lebar tiap kolom tabel explicit
      $a->SetWidths(array(7,15,130,15,10,10));
      // set align tiap kolom tabel explicit
      $a->SetAligns(array("R","L","L","C","C","C"));
      $a->SetFont('Arial','B',7);
      $a->Ln(2);
      // set nama header tabel explicit
      $a->Cell(7,7,'No.',1,0,'C');
      $a->Cell(15,7,'ID KNOWLEDGE EXPLICIT',1,0,'C');
      $a->Cell(5,7,'JUDUL KNOWLEDGE EXPLICIT',1,0,'C');
      $a->Cell(15,7,'KETERANGAN',1,0,'C');
      $a->Cell(15,7,'JUDUL DOKUMEN',1,0,'C');
	  $a->Cell(5,7,'TANGGAL',1,0,'C');
      $a->Cell(15,7,'BULAN',1,0,'C');
      $a->Cell(15,7,'TAHUN',1,0,'C');
      $a->Ln(7);

      $a->SetFont('Arial','',12);

      $rec = $temp_rec->result();
      $n=0;
      foreach($rec as $r)
      {
        $n++;
        $a->Row(array(($n), $r->id_explicit, $r->judul_explicit, $r->keterangan, $r->userfile, $r->tgl_post, $r->bulan, $r->tahun ));
        $a->Ln(8);
      }

      $a->Output();
    }
    else // jika data kosong
    {
      redirect('report');
    }

    exit();
  }
}
?>