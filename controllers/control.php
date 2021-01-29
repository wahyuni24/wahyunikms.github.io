<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control extends CI_Controller {

	function __construct(){
		parent:: __construct();	
		
		$this->load->model('Web_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper('date');
		$this->load->helper('form','url','file');
		$this->load->library('pdf');
	}
	public function index()
	{
		$data['login']			=	$this->session->userdata('login',TRUE);
		if($data['login']==FALSE) {
			redirect(base_url('control/login'));
		}
  			

			$data['title']			=	"Pusat Komputer IAIN Kota Bengkulu";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			=	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		=	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		=	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		=	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		=	$this->Web_model->nvalid_e($id_pengguna);
			$tahun					=	'2016';
			$data['tc']				=	$this->Web_model->bulan_t($tahun,$id_pengguna);
			$data['ex']				=	$this->Web_model->bulan_e($tahun,$id_pengguna);
			$data['content']		=	'home';
			$this->load->view('templete',$data);
	}

	public function login(){
		$this->load->view('login');
	}

	public function register(){
		$this->load->view('register');
	}

	function home(){
		$nip						= 	trim(strip_tags($this->input->post('nip')));
		$password					= 	md5($this->input->post('password'));
		$hasil						= 	$this->Web_model->login($nip,$password);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result_array() as $data) {
				$session_id			=	$data['id_pengguna'];
				$session_nip		=	$data['nip'];
				$session_nama		=	$data['nama'];
				;
			}
			$sess_user = array(
								'id_pengguna'=>$session_id,
								'nip'=>$session_nip,
								'nama'=>$session_nama,
							
				);
			$this->session->set_userdata($sess_user,TRUE);
			$this->session->set_userdata('login',TRUE);
			redirect(base_url('control'),'refresh');
		}
		else{
			echo "<script type='text/javascript'>alert('Username atau Password salah !');</script>";
			redirect(base_url('control/login'),'refresh');
		}
	}

	public function profil(){
		$data['login']			=	$this->session->userdata('login',TRUE);
		if ($data['login']==false) redirect(base_url('control/login'));

			$data['title']			=	'User Profil | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			=	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		=	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		=	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		=	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		=	$this->Web_model->nvalid_e($id_pengguna);
			$data['tacit']			= 	$this->Web_model->data_tacit_validasi($id_pengguna);
			$data['explicit']		= 	$this->Web_model->data_explicit_validasi($id_pengguna);
			$data['content']		=	'profil';
			$this->load->view('templete',$data);
	}

	public function edit_profil(){
		$data['login']			=	$this->session->userdata('login',TRUE);
		if ($data['login']==false) redirect(base_url('control/login'));

			$data['title']			=	'Edit Profil | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			=	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		=	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		=	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		=	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		=	$this->Web_model->nvalid_e($id_pengguna);
			$data['pegawai']		=	$this->Web_model->edit_profil($id_pengguna);
			$data['nama']			=	$this->session->userdata('nama');
			$data['bidang_kerja']	=	$this->session->userdata('nama_bdkerja');
			$data['bidang_kerja']	=	$this->Web_model->data_bdkerja();
			$data['content']		=	'edit_profil';
			$this->load->view('templete',$data);
	}

	function update_profil(){
		$data 						=	array();
		$config['upload_path'] 		= 	'photo/images';
		$config['allowed_types'] 	= 	'gif|jpg|png';
		$config['max_size']			= 	'2000';
		$config['max_width']  		= 	'3000';
		$config['max_height']  		= 	'4000';
		$config['remove_spaces']  	= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 					=	array();
			$id						= 	$this->session->userdata('id_pengguna');
			$data['nip']			= 	$this->input->post('nip');
			$data['nama']			= 	$this->input->post('nama');
			$data['jenis_kelamin']	= 	$this->input->post('jenis_kelamin');
			$data['tempat_lahir']	= 	$this->input->post('tempat_lahir');
			$data['tanggal_lahir']	= 	$this->input->post('tanggal_lahir');
			$data['id_bdkerja']		=	$this->input->post('id_bdkerja');			
			$this->form_validation->set_rules('nip','nip','required');
			$this->form_validation->set_rules('nama','nama','required');
			$this->form_validation->set_rules('jenis_kelamin','jenis kelamin','required');
			$this->form_validation->set_rules('tempat_lahir','tempat lahir','required');
			$this->form_validation->set_rules('tanggal_lahir','tanggal lahir','required');
			$this->form_validation->set_rules('id_bdkerja','bidang_kerja','required');
			if($this->form_validation->run() == FALSE){
				$this->edit_profil();
			}
			else{
				$this->Web_model->update_pegawai($data,$id);
				echo "<script> alert('Data Profil berhasil diupdate');</script>";
				redirect(base_url('control/profil'), 'refresh');
			}
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 					=	array();
				$id						= 	$this->session->userdata('id_pengguna');;
				$data['nip']			= 	$this->input->post('nip');
				$data['nama']			= 	$this->input->post('nama');
				$data['jenis_kelamin']	= 	$this->input->post('jenis_kelamin');
				$data['tempat_lahir']	=	$this->input->post('tempat_lahir');
				$data['tanggal_lahir']	= 	$this->input->post('tanggal_lahir');
				$data['id_bdkerja']		=	$this->input->post('id_bdkerja');				
				$data['userfile']		= 	$_FILES['userfile']['name'];
				$this->form_validation->set_rules('nip','nip','required');
				$this->form_validation->set_rules('nama','nama','required');
				$this->form_validation->set_rules('jenis_kelamin','jenis kelamin','required');
				$this->form_validation->set_rules('tempat_lahir','tempat lahir','required');
				$this->form_validation->set_rules('tanggal_lahir','tanggal lahir','required');
				$this->form_validation->set_rules('id_bdkerja','bidang_kerja','required');				
				if($this->form_validation->run() == FALSE){
					$this->edit_profil();
				}
				else{
					$this->Web_model->update_pegawai($data,$id);
					redirect(base_url('control/edit_profil'), 'refresh');
				}
			}
		}
    }

    public function edit_password(){
		$data['login']			=	$this->session->userdata('login',TRUE);
		if ($data['login']==false) redirect(base_url('control/login'));

			$data['title']			=	'Edit Password | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			=	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		=	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		=	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		=	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		=	$this->Web_model->nvalid_e($id_pengguna);
			$data['pegawai']		=	$this->Web_model->edit_profil($id_pengguna);
			$data['nama']			=	$this->session->userdata('nama');
			$data['bidang_kerja']	=	$this->session->userdata('nama_bdkerja');
			$data['bidang_kerja']	=	$this->Web_model->data_bdkerja();			
			$data['content']		=	'edit_password';
			$this->load->view('templete',$data);
    }

    function update_password(){
    	$data 						=	array();
    	$id 						=	$this->session->userdata('id_pengguna');
    	$data['password']			=	md5($this->input->post('password'));
    	$password1					=	md5($this->input->post('password1'));
    	$this->form_validation->set_rules('password','Password','required|min_length[6]');
    	$this->form_validation->set_rules('password1','Password','required|min_length[6]');
    	if ($data['password'] != $password1) {
			echo "<script> alert('Password tidak cocok');</script>";
			$this->edit_password();
    	}
    	if ($this->form_validation->run() == FALSE) {
    		$this->edit_password();
    	}
    	else{
    		$this->Web_model->update_password($data,$id);
			echo "<script> alert('Password Anda Telah Diperbaharui');</script>";
			redirect(base_url('control'), 'refresh');    		
    	}
    }

	function reset_password(){
		$id_pengguna			= 	$this->session->userdata('id_pengguna');
		$pengguna				= 	$this->Web_model->data_pengguna($id_pengguna);
		foreach($pengguna->result_array() as $p){
			$data['password']	= 	md5($p['nip']);
		}
		$id					= $this->uri->segment(3);
		$this->Web_model->reset_password($id,$data);
		echo "<script> alert('Password Telah Berhasil Direset');</script>";
		redirect(base_url('control/daftar_pegawai'), 'refresh');
	}

	public function input_pegawai(){
		$data['login']			=	$this->session->userdata('login',TRUE);
		if ($data['login']==false) redirect(base_url('control/login'));

			$data['title']			=	'Input Pegawai | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			=	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		=	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		=	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		=	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		=	$this->Web_model->nvalid_e($id_pengguna);
			$data['bidang_kerja']	= 	$this->Web_model->data_bdkerja();			
			$data['content']		=	'input_pegawai';
			$this->load->view('templete',$data);
	}

	function submit_data_pegawai(){
		$data 					=	array();
		$data['nip']			= 	$this->input->post('nip');
		$data['password']		=	md5($this->input->post('password'));
		$data['nama']			= 	$this->input->post('nama');
		$data['jenis_kelamin']	= 	$this->input->post('jenis_kelamin');
		$data['tempat_lahir']	= 	$this->input->post('tempat_lahir');
		$data['tanggal_lahir']	= 	$this->input->post('tanggal_lahir');
		$data['id_bdkerja']		=	$this->input->post('id_bdkerja');
		$data['hak_akses']		=	$this->input->post('hak_akses');
		$this->form_validation->set_rules('nip','nip','required|is_unique[pengguna.nip]');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_rules('nama','nama','required');
		$this->form_validation->set_rules('jenis_kelamin','jenis kelamin','required');
		$this->form_validation->set_rules('tempat_lahir','tempat lahir','required');
		$this->form_validation->set_rules('tanggal_lahir','tanggal lahir','required');
		$this->form_validation->set_rules('id_bdkerja','bidang kerja','required');
		$this->form_validation->set_rules('hak_akses','hak akses','required');
		if($this->form_validation->run() == FALSE){
			$this->input_pegawai();
		}
		else{
			$this->Web_model->input_pegawai($data);
			echo "<script> alert('Data Pegawai disimpan.');</script>";
			redirect(base_url('control/daftar_pegawai'), 'refresh');
		}
	}		

	public function daftar_pegawai(){
		$data['login']			=	$this->session->userdata('login',TRUE);
		if ($data['login']==false) redirect(base_url('control/login'));

			$data['title']			=	'Daftar Pegawai | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			=	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		=	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		=	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		=	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		=	$this->Web_model->nvalid_e($id_pengguna);
			$data['pegawai']		=	$this->Web_model->daftar_pegawai();
			$data['content']		=	'daftar_pegawai';
			$this->load->view('templete',$data);
	}

	public function edit_pegawai(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Pegawai | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id						= 	$this->uri->segment(3);
			$data['pegawai'] 		= 	$this->Web_model->edit_pegawai($id);
			$data['nama'] 			= 	$this->session->userdata('nama');
			$data['bidang_kerja']	=	$this->session->userdata('nama_bdkerja');
			$data['bidang_kerja']	=	$this->Web_model->data_bdkerja();
			$data['content']		= 	'edit_pegawai';
			$this->load->view('templete',$data);
	}

	function update_data_pegawai(){
		$data 					=	array();
		$id						= 	$this->input->post('id_pengguna');
		$data['nip']			= 	$this->input->post('nip');
		$data['nama']			= 	$this->input->post('nama');
		$data['jenis_kelamin']	= 	$this->input->post('jenis_kelamin');
		$data['tempat_lahir']	= 	$this->input->post('tempat_lahir');
		$data['tanggal_lahir']	= 	$this->input->post('tanggal_lahir');
		$data['id_bdkerja']		=	$this->input->post('id_bdkerja');
		$data['hak_akses']		=	$this->input->post('hak_akses');
		$this->form_validation->set_rules('nip','nip','required');
		$this->form_validation->set_rules('nama','nama','required');
		$this->form_validation->set_rules('jenis_kelamin','jenis kelamin','required');
		$this->form_validation->set_rules('tempat_lahir','tempat lahir','required');
		$this->form_validation->set_rules('tanggal_lahir','tanggal lahir','required');
		$this->form_validation->set_rules('id_bdkerja','bidang_kerja','required');
			if($this->form_validation->run() == FALSE){
				$this->edit_pegawai();
			}
			else{
				$this->Web_model->update_pegawai($data,$id);
				echo "<script> alert('Data Pegawai berhasil diupdate.');</script>";
				redirect(base_url('control/daftar_pegawai'), 'refresh');
			}		
	}

	function hapus_pegawai(){
		$id					= 	$this->uri->segment(3);
		$this->Web_model->hapus_pegawai($id);
		redirect(base_url('control/daftar_pegawai'), 'refresh');
	}

	public function data_bagian_kerja(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Data Bidang Kerja | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['kode_bagian']	= 	$this->Web_model->kode_bagian();
			$data['bagian']			= 	$this->Web_model->bagian();
			$data['content']		= 	'data_bagian_kerja';
			$this->load->view('templete',$data);
	}

	function submit_bagian(){	
		$data 					=	array();
		$data['id_bdkerja']		= 	$this->input->post('id_bdkerja');
		$data['nama_bdkerja']	= 	$this->input->post('nama_bdkerja');
		$data['urut']			= 	$this->input->post('urut');
		$this->form_validation->set_rules('id_bdkerja','id bdkerja','required');
		$this->form_validation->set_rules('nama_bdkerja','nama bagian','required');
		if($this->form_validation->run() == FALSE){
			$this->data_bagian_kerja();
		}
		else{
			$this->Web_model->input_bagian($data);
			redirect(base_url('control/data_bagian_kerja'), 'refresh');
		}
    }

	public function edit_bagian(){		
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Data Bidang Kerja | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['bagian']			= 	$this->Web_model->bagian();
			$id						= 	$this->uri->segment(3);
			$data['edit']			= 	$this->Web_model->edit_bagian($id);
			$data['content']		= 	'edit_bagian';
			$this->load->view('templete',$data);
	}
	function update_bagian(){
		$data 					=	array();
		$id						= 	$this->input->post('id_bdkerja');
		$data['nama_bdkerja']	= 	$this->input->post('nama_bdkerja');
		$this->form_validation->set_rules('id_bdkerja','id bdkerja','required');
		$this->form_validation->set_rules('nama_bdkerja','nama bagian','required');
		if($this->form_validation->run() == FALSE){
			$this->edit_bagian();
		}
		else{
			$this->Web_model->update_bagian($data,$id);
			redirect(base_url('control/data_bagian_kerja'), 'refresh');
		}
    }
	function hapus_bagian(){
		$id						= 	$this->uri->segment(3);
		$this->Web_model->hapus_bagian($id);
		redirect(base_url('control/data_bagian_kerja'), 'refresh');
	}	

	public function pengguna(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Pegawai | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id_pengguna			= 	$this->uri->segment(3);
			$data['v_t']			= 	$this->Web_model->valid_t($id_pengguna);
			$data['v_e']			= 	$this->Web_model->valid_e($id_pengguna);
			$data['pegawai']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['tacit']			= 	$this->Web_model->data_tacit_validasi($id_pengguna);
			$data['explicit']		= 	$this->Web_model->data_explicit_validasi($id_pengguna);
			$data['content']		= 	'pengguna';
			$this->load->view('templete',$data);
	}

	function logout(){
		$this->session->unset_userdata('login');
		redirect(base_url('control'),'refresh');
	}

	public function input_masalah_solusi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Input Tacit Knowledge | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['content']		= 	'input_pengetahuan_tacit';
			$this->load->view('templete',$data);
	}

	function submit_masalah_solusi(){	
		$data 							=	array();
		$config['upload_path'] 			= 	'./lampiran/tacit/';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size']				= 	'900000000000000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 						=	array();
			$data['id_pengguna']		= 	$this->session->userdata('id_pengguna');
			$data['judul_tacit']		= 	$this->input->post('judul_tacit');
			$data['masalah']			= 	$this->input->post('masalah');
			$data['solusi']				= 	$this->input->post('solusi');
			$data['tgl_post']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
			$data['bulan']				= 	gmdate('m', time()+60*60*7);
			$data['tahun']				= 	gmdate('Y', time()+60*60*7);
			$this->form_validation->set_rules('judul_tacit','Judul','required');
			$this->form_validation->set_rules('masalah','Masalah','required');
			$this->form_validation->set_rules('solusi','Solusi','required');
			if($this->form_validation->run() == FALSE){
				$this->input_masalah_solusi();
			}
			else{	
				$this->Web_model->input_masalah_solusi($data);
				echo "<script> alert('Data Case dan Solusi Berhasil disimpan.');</script>";
				redirect(base_url('control/lihat_masalah_solusi'), 'refresh');
			}
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 						=	array();
				$data['id_pengguna']		= 	$this->session->userdata('id_pengguna');
				$data['judul_tacit']		= 	$this->input->post('judul_tacit');
				$data['masalah']			= 	$this->input->post('masalah');
				$data['solusi']				= 	$this->input->post('solusi');
				$data['tgl_post']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
				$data['bulan']				= 	gmdate('m', time()+60*60*7);
				$data['tahun']				= 	gmdate('Y', time()+60*60*7);
				$data['userfile']			= 	$_FILES['userfile']['name'];
				$this->form_validation->set_rules('judul_tacit','Judul','required');
				$this->form_validation->set_rules('masalah','Masalah','required');
				$this->form_validation->set_rules('solusi','Solusi','required');
				if($this->form_validation->run() == FALSE){
					$this->input_masalah_solusi();
				}
				else{
					$this->Web_model->input_masalah_solusi($data);
					echo "<script> alert('Data Case dan Solusi Berhasil disimpan.');</script>";
					redirect(base_url('control/lihat_masalah_solusi'), 'refresh');
				}
			}
		}
    }

    function data_masalah_solusi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Tacit Knowledge | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['tacit']	 		= 	$this->Web_model->daftar_data_tacit();
			$data['content']		= 	'tacit_data';
			$this->load->view('templete',$data);
    }

    function validasi_masalah_solusi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Validasi Case & Solusi | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['tacit']	 		= 	$this->Web_model->validasi_tacit();
			$data['content']		= 	'daftar_pengetahuan_tacit';
			$this->load->view('templete',$data);
    }

	function validasi_tacit(){
		$id							= 	$this->uri->segment(3);
		$id_pengguna				= 	$this->uri->segment(4);
		$data['validasi_tacit']		= 	"1";
		$this->Web_model->tacit_validasi($data,$id);
		$s['id_penerima']			= 	$id_pengguna;
		$s['id_posting']			= 	$id;
		$s['kategori']				= 	"v_tacit";
		$s['tgl_notif']				= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
		$s['status']				= 	'N';
		$this->Web_model->input_notifikasi($s);
		redirect(base_url('control/validasi_masalah_solusi'), 'refresh');
	}   	

	public function lihat_masalah_solusi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'View Case & Solusi | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['tacit']	 		= 	$this->Web_model->data_tacit($this->session->userdata('id_pengguna'));
			$data['content']		= 	'view_pengetahuan_tacit';
			$this->load->view('templete',$data);
	}

	public function detail_masalah_solusi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Detail Case & Solusi | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id						= 	$this->uri->segment(3);
			$data['detail']	 		= 	$this->Web_model->detail_masalah($id);
			$data['komentar'] 		= 	$this->Web_model->komentar_tacit($id);
			// $data['cek_user']		= 	$this->Web_model->cek_user($id,$id_pengguna);
			$data['content']		= 	'detail_masalah_solusi';
			$this->load->view('templete',$data);
	}	

	public function edit_masalah_solusi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Case & Solusi | Pusat Komputer IAIN Kota Bengkulu';
			$id_tacit				= 	$this->uri->segment(3);
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['tacit']	 		= 	$this->Web_model->tacit($id_tacit,$id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['content']		= 	'edit_pengetahuan_tacit';
			$this->load->view('templete',$data);
	}

	function update_masalah_solusi(){
		$data 							=	array();
		$config['upload_path'] 			= 	'./lampiran/tacit/';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size']				= 	'2000';
		//$config['max_width']  		= 	'3000';
		//$config['max_height']  		= 	'4000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 						=	array();
			$data['id_pengguna']		= 	$this->session->userdata('id_pengguna');
			$id							= 	$this->input->post('id_tacit');
			$data['judul_tacit']		= 	$this->input->post('judul_tacit');
			$data['masalah']			= 	$this->input->post('masalah');
			$data['solusi']				= 	$this->input->post('solusi');
			//$data['tgl_post']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
			$this->form_validation->set_rules('judul_tacit','Judul','required');
			$this->form_validation->set_rules('masalah','Masalah','required');
			$this->form_validation->set_rules('solusi','Solusi','required');
			if($this->form_validation->run() == FALSE){
				$this->edit_masalah_solusi();
			}
			else{
				$this->Web_model->update_masalah_solusi($data,$id);
				echo "<script> alert('Data Case dan Solusi Berhasil diupdate.');</script>";
				redirect(base_url('control/lihat_masalah_solusi'), 'refresh');
			}
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 						=	array();
				$data['id_pengguna']		= 	$this->session->userdata('id_pengguna');
				$id							= 	$this->input->post('id_tacit');
				$data['judul_tacit']		= 	$this->input->post('judul_tacit');
				$data['masalah']			= 	$this->input->post('masalah');
				$data['solusi']				= 	$this->input->post('solusi');
				//$data['tgl_post']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
				$data['userfile']			= 	$_FILES['userfile']['name'];
				$this->form_validation->set_rules('judul_tacit','Judul','required');
				$this->form_validation->set_rules('masalah','Masalah','required');
				$this->form_validation->set_rules('solusi','Solusi','required');
				if($this->form_validation->run() == FALSE){
					$this->edit_masalah_solusi();
				}
				else{
					$this->Web_model->update_masalah_solusi($data,$id);
					echo "<script> alert('Data Case dan Solusi Berhasil diupdate.');</script>";
					redirect(base_url('control/lihat_masalah_solusi'), 'refresh');
				}
			}
		}		
	}

	function hapus_masalah_solusi(){
		$id_tacit					= 	$this->uri->segment(3);
		$this->Web_model->hapus_tacit($id_tacit);
		redirect(base_url('control/lihat_masalah_solusi'), 'refresh');
	}	

	function submit_komentar_tacit(){
		$data 							=	array();
		$data['id_tacit']				= 	$this->input->post('id_tacit');
		$data['isi_komentar_tacit']		= 	$this->input->post('isi_komentar_tacit');
		$data['id_pengguna']			= 	$this->session->userdata('id_pengguna');
		$data['tgl_komentar']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
		$this->Web_model->input_komentar_tacit($data);
		$s['id_pengguna']				= 	$this->session->userdata('id_pengguna');
		$s['id_penerima']				= 	$this->input->post('id_penerima');
		$s['id_posting']				= 	$this->input->post('id_tacit');
		$s['kategori']					= 	"tacit";
		$s['tgl_notif']					= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
		$s['status']					= 	'N';
		$this->Web_model->input_notifikasi($s);
		?>
		<script>window.location="detail_masalah_solusi/<?php echo $data['id_tacit'];?>";</script>;
		<?php
    }

	function hapus_komentar_tacit(){
		$id							= $this->input->post('id_komentar_tacit');
		$data['id_tacit']			= $this->input->post('id_tacit');
		$this->Web_model->hapus_komentar_tacit($id);
		?>
		<script>window.location="detail_masalah_solusi/<?php echo $data['id_tacit'];?>";</script>;
		<?php
	}

	public function input_dokumen(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Input Dokumen | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['content']		= 	'input_pengetahuan_explicit';
			$this->load->view('templete',$data);
	}

	function submit_dokumen(){
		$config['upload_path'] 			= 	'./data/explicit';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size']				= 	'900000000000000000000000000000000000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 						=	array();
			$data['id_pengguna']		= 	$this->session->userdata('id_pengguna');
			$data['id_gejala']			= 	$this->session->userdata('id_pengguna');
			$data['id_solusi']			= 	$this->session->userdata('id_pengguna');
			$data['judul_explicit']		= 	$this->input->post('judul_explicit');
			$data['keterangan']			= 	$this->input->post('keterangan');
			$data['tgl_post']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
			$data['bulan']				= 	gmdate('m', time()+60*60*7);
			$data['tahun']				= 	gmdate('Y', time()+60*60*7);
			$this->form_validation->set_rules('judul_explicit','judul','required');
			$this->form_validation->set_rules('keterangan','keterangan','required');
			if($this->form_validation->run() == FALSE){
				$this->input_dokumen();
			}
			else{
				$this->Web_model->input_dokumen($data);
				echo "<script> alert('Data Dokumen Berhasil disimpan.');</script>";
				redirect(base_url('control/view_dokumen'), 'refresh');
			}			
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 						=	array();
				$data['id_pengguna']		= 	$this->session->userdata('id_pengguna');
				$data['judul_explicit']		= 	$this->input->post('judul_explicit');
				$data['keterangan']			= 	$this->input->post('keterangan');
				$data['tgl_post']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
				$data['bulan']				= 	gmdate('m', time()+60*60*7);
				$data['tahun']				= 	gmdate('Y', time()+60*60*7);
				$data['userfile']			= 	$_FILES['userfile']['name'];
				$this->form_validation->set_rules('judul_explicit','judul','required');
				$this->form_validation->set_rules('keterangan','keterangan','required');
				if($this->form_validation->run() == FALSE){
					$this->input_dokumen();
				}
				else{
					$this->Web_model->input_dokumen($data);
					echo "<script> alert('Data Dokumen Berhasil disimpan.');</script>";
					redirect(base_url('control/view_dokumen'), 'refresh');
				}
			}
		}
    }

	public function data_dokumen(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Lihat Explicit Knowledge | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['explicit'] 		= 	$this->Web_model->daftar_data_explicit();
			$data['content']		= 	'daftar_pengetahuan_explicit';
			$this->load->view('templete',$data);
	}

	public function validasi_dokumen(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Validasi Dokumen | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['explicit'] 		= 	$this->Web_model->validasi_explicit();
			$data['content']		= 	'daftar_dokumen';
			$this->load->view('templete',$data);
	}
	function validasi_explicit(){
		$id							= 	$this->uri->segment(3);
		$id_pengguna				= 	$this->uri->segment(4);
		$data['validasi_explicit']	= 	"1";
		$this->Web_model->explicit_validasi($data,$id);
		$s['id_penerima']			= 	$id_pengguna;
		$s['id_posting']			= 	$id;
		$s['kategori']				= 	"v_explicit";
		$s['tgl_notif']				= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
		$s['status']				= 	'N';
		$this->Web_model->input_notifikasi($s);
		redirect(base_url('control/validasi_dokumen'), 'refresh');
	}	

	public function view_dokumen(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'View Dokumen | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['explicit'] 		= 	$this->Web_model->data_explicit($this->session->userdata('id_pengguna'));
			$data['content']		= 	'view_pengetahuan_explicit';
			$this->load->view('templete',$data);
	}

	public function detail_dokumen(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Detail Dokumen | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id						= 	$this->uri->segment(3);
			$data['detail']	 		= 	$this->Web_model->detail_dokumen($id);
			$data['komentar'] 		= 	$this->Web_model->komentar_explicit($id);
			// $data['cek_user']		= 	$this->Web_model->cek_user_e($id,$id_pengguna);
			$data['content']		= 	'detail_dokumen';
			$this->load->view('templete',$data);
	}

	public function edit_dokumen(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Dokumen | Pusat Komputer IAIN Kota Bengkulu';
			$id_explicit			= 	$this->uri->segment(3);
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['explicit'] 		= 	$this->Web_model->explicit($id_explicit,$id_pengguna);
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['content']		= 	'edit_pengetahuan_explicit';
			$this->load->view('templete',$data);
	}

	function update_dokumen(){	
		$data 							=	array();
		$config['upload_path'] 			= 	'./data/explicit/';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pfd';
		$config['max_size']				= 	'2000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 						=	array();
			$data['id_pengguna']		= 	$this->session->userdata('id_pengguna');
			$id							= 	$this->input->post('id_explicit');
			$data['judul_explicit']		= 	$this->input->post('judul_explicit');
			$data['keterangan']			= 	$this->input->post('keterangan');
			//$data['tgl_post']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
			$this->form_validation->set_rules('judul_explicit','judul','required');
			$this->form_validation->set_rules('keterangan','keterangan','required');
			if($this->form_validation->run() == FALSE){
				$this->edit_dokumen();
			}
			else{
				$this->Web_model->update_dokumen($data,$id);
				echo "<script> alert('Data Dokumen diupdate.');</script>";
				redirect(base_url('control/view_dokumen'), 'refresh');
			}
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 						=	array();
				$data['id_pengguna']		= 	$this->session->userdata('id_pengguna');
				$id							= 	$this->input->post('id_explicit');
				$data['judul_explicit']		= 	$this->input->post('judul_explicit');
				$data['keterangan']			= 	$this->input->post('keterangan');
				$data['tgl_post']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
				$data['userfile']			= 	$_FILES['userfile']['name'];
				$this->form_validation->set_rules('judul_explicit','judul','required');
				$this->form_validation->set_rules('keterangan','keterangan','required');
				if($this->form_validation->run() == FALSE){
					$this->edit_dokumen();
				}
				else{
					$this->Web_model->update_dokumen($data,$id);
					echo "<script> alert('Data Dokumen diupdate.');</script>";
					redirect(base_url('control/view_dokumen'), 'refresh');
				}
			}
		}
    }

	function hapus_dokumen(){
		$id_explicit			= 	$this->uri->segment(3);
		$this->Web_model->hapus_dokumen($id_explicit);
		redirect(base_url('control/view_dokumen'), 'refresh');
	}

	function submit_komentar_explicit(){	
		$data 							=	array();
		$data['id_explicit']			= 	$this->input->post('id_explicit');
		$data['isi_komentar_explicit']	= 	$this->input->post('isi_komentar_explicit');
		$data['id_pengguna']			= 	$this->session->userdata('id_pengguna');
		$data['tgl_komentar']			= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
		$this->Web_model->input_komentar_explicit($data);
		$s['id_pengguna']				= 	$this->session->userdata('id_pengguna');
		$s['id_penerima']				= 	$this->input->post('id_penerima');
		$s['id_posting']				= 	$this->input->post('id_explicit');
		$s['kategori']					= 	"explicit";
		$s['tgl_notif']					= 	gmdate('Y-m-d G:i:s', time()+60*60*7);
		$s['status']					= 	'N';
		$this->Web_model->input_notifikasi($s);
		?>
		<script>window.location="detail_dokumen/<?php echo $data['id_explicit'];?>";</script>;
		<?php
    }

	function hapus_komentar_explicit(){
		$id								= $this->input->post('id_komentar_explicit');
		$data['id_explicit']			= $this->input->post('id_explicit');
		$this->Web_model->hapus_komentar_explicit($id);
		?>
		<script>window.location="detail_dokumen/<?php echo $data['id_explicit'];?>";</script>;
		<?php
	}

	public function posting_disukai(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Posting Disukai | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= $this->session->userdata('id_pengguna');
			$data['pengguna']		= $this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= $this->Web_model->notif($id_pengguna);
			$data['valid_t']		= $this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= $this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= $this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= $this->Web_model->nvalid_e($id_pengguna);
			$data['content']		= 'posting_disukai';
			$this->load->view('templete',$data);
	}


	public function semua_notifikasi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Semua Notifikasi | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['pegawai']		= 	$this->Web_model->daftar_pegawai();
			$data['content']		= 	'semua_notifikasi';
			$this->load->view('templete',$data);
	}

	function update_notif(){
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$this->Web_model->update_notif($id_pengguna);
	}

	public function cek_validasi(){
		$cek_t						= 	$this->Web_model->cek_validasi_t();
		$cek_e						= 	$this->Web_model->cek_validasi_e();
		foreach($cek_t->result_array() as $j){
			if($j['jml']	!=	0){
				$tacit 	=	$j['jml'];
			}
		}
		foreach($cek_e->result_array() as $k){
			if($k['jml'] 	!=	0){
				$explicit 	= 	$k['jml'];
			} 
		}
		@$hasil 	=	$tacit + $explicit;
		if($hasil 	!=	'0'){
			echo $hasil;
		}
	}

	public function cek_validasi_t(){
		$cek_t						= 	$this->Web_model->cek_validasi_t();
		foreach($cek_t->result_array() as $j){
			if($j['jml']	!=	0){
				echo $tacit		= 	$j['jml'];
			} 
		}
	}
	public function cek_validasi_e(){
		$cek_e						= 	$this->Web_model->cek_validasi_e();
		foreach($cek_e->result_array() as $k){
			if($k['jml']	!=	0){
				echo $explicit 	= 	$k['jml'];
			}
		}
	}
	
	public function cek_notif(){
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['cek']			= 	$this->Web_model->cek($id_pengguna);
			$this->load->view('templete',$data);
	}
	public function cek_revisi(){
		$cek 						=	$this->Web_model->cek_revisi();
		foreach($cek->result_array() as $c){
			if($c['jml']	!=	0){
				echo $revisi 	= 	$c['jml'];
			} 
		}
	}

/* this is Code Controller of Item for CBR METHOD */

	public function data_gejala(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Data Gejala | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['kode_gejala']	= 	$this->Web_model->kode_gejala();
			$data['gejala']			= 	$this->Web_model->gejala();
			$data['bagian']			= 	$this->Web_model->bagian();
			$data['content']		= 	'data_gejala';
			$this->load->view('templete',$data);
	}

	function submit_gejala(){	
		$data 					=	array();
		$data['id_gejala']		= 	$this->input->post('id_gejala');
		$data['nama_gejala']	= 	$this->input->post('nama_gejala');
		$data['urut']			= 	$this->input->post('urut');
		$data['bobot_gejala']	= 	$this->input->post('bobot_gejala');
		$data['id_bdkerja']		= 	$this->input->post('id_bdkerja');
		$this->form_validation->set_rules('id_gejala','id gejala','required');
		$this->form_validation->set_rules('nama_gejala','nama gejala','required');
		$this->form_validation->set_rules('id_bdkerja','id bdkerja','required');
		if($this->form_validation->run() == FALSE){
			$this->data_gejala();
		}
		else{
			$this->Web_model->input_gejala($data);
			redirect(base_url('control/data_gejala'), 'refresh');
		}
    }

	public function edit_gejala(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Data Gejala | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['gejala']			= 	$this->Web_model->gejala();
			$id						= 	$this->uri->segment(3);
			$data['edit']			= 	$this->Web_model->edit_gejala($id);
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['bagian']			= 	$this->Web_model->bagian();			
			$data['content']		= 	'edit_gejala';
			$this->load->view('templete',$data);
	}

	function update_gejala(){	
		$data 						=	array();
		$id							= 	$this->input->post('id_gejala');
		$data['nama_gejala']		= 	$this->input->post('nama_gejala');
		$data['bobot_gejala']		= 	$this->input->post('bobot_gejala');
		$data['id_bdkerja']			= 	$this->input->post('id_bdkerja');
		$this->form_validation->set_rules('id_gejala','id gejala','required');
		$this->form_validation->set_rules('nama_gejala','nama gejala','required');
		$this->form_validation->set_rules('id_bdkerja','id bdkerja','required');
		if($this->form_validation->run() == FALSE){
			$this->edit_gejala();
		}
		else{
			$this->Web_model->update_gejala($data,$id);
			redirect(base_url('control/data_gejala'), 'refresh');
		}
    }

	function hapus_gejala(){
		$id						= $this->uri->segment(3);
		$this->Web_model->hapus_gejala($id);
		redirect(base_url('control/data_gejala'), 'refresh');
	}

	function tambah_gejala(){
		$rows['id_solusi']			= 	$this->input->post('id_solusi');
		$rows['id_gejala']			= 	$this->input->post('id_gejala');
		$this->Web_model->input_kasus($rows);
		?>
		<script>window.location="edit_solusi/<?php echo $rows['id_solusi'];?>";</script>;
		<?php
	}

	function delete_gejala(){
		$id_solusi					= 	$this->input->post('id_solusi');
		$id_gejala					= 	$this->input->post('id_gejala');
		$this->Web_model->delete_gejala($id_solusi,$id_gejala);
		?>
		<script>window.location="edit_solusi/<?php echo $id_solusi;?>";</script>;
		<?php
	}

	public function data_kasus(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Data Kasus | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['kode_kasus']		= 	$this->Web_model->kode_kasus();
			$data['gejala']			= 	$this->Web_model->daftar_gejala();
			$data['kasus']			= 	$this->Web_model->daftar_kasus1();
			$data['gejala_masalah']	= 	$this->Web_model->gejala_masalah();
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['riwayat']		= 	$this->Web_model->riwayat();
			$data['content']		= 	'data_kasus';
			$this->load->view('templete',$data);
	}
	function submit_kasus(){
		$data 					=	array();
		$data['id_solusi']		= 	$this->input->post('id_solusi');
		$data['nama_solusi']	= 	$this->input->post('nama_solusi');
		$data['solusi_masalah']	= 	$this->input->post('solusi_masalah');
		$data['urut']			= 	$this->input->post('urut');
		$this->form_validation->set_rules('nama_solusi','masalah','required');
		$this->form_validation->set_rules('solusi_masalah','solusi masalah','required');
		if($this->form_validation->run() == FALSE){
			$this->data_kasus();
		}
		else{
			$this->Web_model->input_solusi($data);
			foreach($_POST['inp'] as $rows){
				$this->Web_model->input_kasus($rows);
			}
			echo "<script> alert('Data kasus berhasil disimpan');</script>";
			redirect(base_url('control/data_kasus'), 'refresh');
		}
    }

	public function edit_solusi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Data Solusi | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id						= 	$this->uri->segment(3);
			$data['gejala']			= 	$this->Web_model->daftar_gejala();
			$data['solusi']	 		= 	$this->Web_model->edit_solusi($id);
			$data['gejala_masalah']	= 	$this->Web_model->gejala_masalah();
			$data['content']		= 	'edit_solusi';
			$this->load->view('templete',$data);
	}

	function update_solusi(){
		$id						= 	$this->input->post('id_solusi');
		$data['nama_solusi']	= 	$this->input->post('nama_solusi');
		$data['solusi_masalah']	= 	$this->input->post('solusi_masalah');
		$this->Web_model->update_solusi($data,$id);
		echo "<script> alert('Data Solusi berhasil diupdate.');</script>";
		redirect(base_url('control/data_kasus'), 'refresh');
	}

	function hapus_solusi(){
		$id					= 	$this->uri->segment(3);
		$this->Web_model->hapus_solusi($id);
		echo "<script> alert('Data Solusi berhasil dihapus.');</script>";
		redirect(base_url('control/data_kasus'), 'refresh');
	}
	
	public function cetak_tacit_laporan(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Mencetak Laporan Tacit | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['content']		= 	'cetak_tacit';
			$this->load->view('templete',$data);
	}
	
	public function cetak_explicit_laporan(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Mencetak Laporan Explicit | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['content']		= 	'cetak_explicit';
			$this->load->view('templete',$data);
	}
function pdf_tacit(){
		$pdf= new FPDF('P','mm','A4');
	
		$pdf->AddPage();
		
		$pdf->SetFont('Arial','B','16');
		$ya=44;
		
		$pdf->image('photo/puskom.png',18,12,30,30);
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(220,7,"KEMENTRIAN AGAMA REPUBLIK INDONESIA",0,1,'C');
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(220,7,"INSTITUT AGAMA ISLAM NEGERI",0,1,'C');
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(220,7,"BENGKULU",0,1,'C');
		$pdf->SetFont('Arial','','12');
		$pdf->Cell(220,7,"Jalan Raden Fatah Pagar Dewa Kota Bengkulu 38211",0,1,'C');
		$pdf->SetFont('Arial','','12');
		$pdf->Cell(220,7,"Telepon (0736) 51276-51171-51172-53879 Faksimili (0736) 51171-51172",0,1,'C');
		$pdf->SetFont('Arial','','12');
		$pdf->Cell(220,7,"Website: www.iainbengkulu.ac.id",0,1,'C');
		$pdf->SetFont('Arial','B','10');
		$pdf->Cell(190,5,"______________________________________________________________________________________________",0,2,'C');
		
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(190,15,'Laporan Pengetahuan Tacit Pusat Komputer IAIN Bengkulu',0,1,'C');
		$pdf->SetFont('Arial','B','14');
		$pdf->Cell(200,9,'Daftar Pengetahuan Tacit Pegawai Pusat Komputer 2019',0,1,'C');
		
		$pdf->Cell(85,5,'',0,5,'C');
		$pdf->SetFont('Arial','B','12');
		$pdf->Cell(10,10,'ID',1,0,'C');
		$pdf->Cell(55,10,'NAMA USER',1,0,'C');
		$pdf->Cell(50,10,'TANGGAL',1,0,'C');
		$pdf->Cell(75,10,'JUDUL KNOWLEDGE TACIT',1,1,'C');
		$pdf->SetFont('Arial','B','12');
		
		$this->load->model('web_model');
		$data=$this->web_model->laporan_tacit();
		foreach ($data as $row){
		$pdf->Cell(10,20,$row->id_pengguna,1,0,'C');
		$pdf->Cell(55,20,$row->nama,1,0,'C');
		$pdf->Cell(50,20,$row->tgl_post,1,0,'C');
		$pdf->MultiCell(75,10,$row->judul_tacit,1,'C',false);
		}
		$pdf->Output();
		
	}
	
	function pdf_explicit(){
	
	
	$pdf= new FPDF('L','mm','A4');
	
		$pdf->AddPage();
		
		$pdf->SetFont('Arial','B','16');
		$ya=44;
		
		$pdf->image('photo/puskom.png',32,12,35,35);
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(290,7,"KEMENTRIAN AGAMA REPUBLIK INDONESIA",0,1,'C');
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(290,7,"INSTITUT AGAMA ISLAM NEGERI",0,1,'C');
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(290,7,"BENGKULU",0,1,'C');
		$pdf->SetFont('Arial','','12');
		$pdf->Cell(290,7,"Jalan Raden Fatah Pagar Dewa Kota Bengkulu 38211",0,1,'C');
		$pdf->SetFont('Arial','','12');
		$pdf->Cell(290,7,"Telepon (0736) 51276-51171-51172-53879 Faksimili (0736) 51171-51172",0,1,'C');
		$pdf->SetFont('Arial','','12');
		$pdf->Cell(290,7,"Website: www.iainbengkulu.ac.id",0,1,'C');
		$pdf->SetFont('Arial','B','10');
		$pdf->Cell(280,2,"_____________________________________________________________________________________________________________________________",0,2,'C');
		
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(280,15,'Laporan Knowledge Explicit | Laporan Pengetahuan Explicit Pusat Komputer IAIN Bengkulu',0,1,'C');
		$pdf->SetFont('Arial','B','14');
		$pdf->Cell(280,9,'Daftar Pengetahuan Explicit Pegawai Pusat Komputer 2019',0,1,'C');
		
		$pdf->Cell(15,9,'',0,1,'C');
		$pdf->SetFont('Arial','B','12');
		$pdf->Cell(15,10,'ID',1,0,'C');
		$pdf->Cell(55,10,'NAMA USER',1,0,'C');
		$pdf->Cell(50,10,'TANGGAL',1,0,'C');
		$pdf->Cell(85,10,'JUDUL KNOWLEDGE EXPLICIT',1,0,'C');
		$pdf->Cell(72,10,'DOKUMEN',1,1,'C');
		$pdf->SetFont('Arial','B','12');
		
		$this->load->model('web_model');
		$data=$this->web_model->laporan_explicit();
		foreach ($data as $row){
		$pdf->Cell(15,20,$row->id_pengguna,1,0,'C');
		$pdf->Cell(55,20,$row->nama,1,0,'C');
		$pdf->Cell(50,20,$row->tgl_post,1,0,'C');
		$pdf->Cell(85,20,$row->judul_explicit,1,0,'C');
		$pdf->MultiCell(72,10,$row->userfile,1,'C',false);
		}
		$pdf->Output();
		

  }



	public function problem_solving(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Pemecahan Masalah | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			foreach($data['pengguna']->result_array() as $bidang){
				$bdg				= $bidang['id_bdkerja'];
			}
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			if($id_pengguna=='2'){
			$data['gejala']			= 	$this->Web_model->daftar_gejala();
			}
			if($id_pengguna!='2'){
			$data['gejala']			= 	$this->Web_model->daftar_gejala_bidang($bdg);
			}
			$data['content']		= 	'problem_solving';
			$this->load->view('templete',$data);
	}

/* 4 fase Metode Fuzzy Case Based Reasoning */

	function cari_solusi(){
		$id_pengguna				= 	$this->session->userdata('id_pengguna');
		$this->Web_model->reset_gejala($id_pengguna);
		$this->Web_model->reset_solusi($id_pengguna);
	
	//	PHASE 1 = RETRIEVE
		//	1. Identifikasi fitur
		foreach($_POST['inp'] as $rows){
			$rows['id_pengguna']	= 	$this->session->userdata('id_pengguna');
			$this->Web_model->cari_solusi($rows);
		}
		
		$kasus						= 	$this->Web_model->kasus_cari();		//solusi
		$tmp_gejala					= 	$this->Web_model->tmp_gejala($id_pengguna);
		$h_tmp_gejala				= 	$this->Web_model->hitung_tmp_gejala($id_pengguna);
		$kedekatan					= 	$this->Web_model->kedekatan();	//Kasus Mirip
		$hitung_gejala				= 	$this->Web_model->hitung_gejala();	//Kasus Gejala
		
		//	2. Memulai Pencocokan
		$s 	=	0;
		foreach ($tmp_gejala->result_array() as $t) {
			$bobot 	=	$t['bobot_gejala'];
			$s 	= 	$s + $bobot; 	// Total bobot identifikasi fitur
		}
		
		foreach($kasus->result_array() as $k) { 	// Daftar kasus tersimpan dalam database
			foreach($hitung_gejala->result_array() as $hg)
			if($k['id_solusi'] == $hg['id_solusi']){
				$h_gejala 	= 	$hg['jml'];
			}

			$pe = 0;
			foreach($tmp_gejala->result_array() as $t) {	// Gejala identifikasi fitur
				foreach($h_tmp_gejala->result_array() as $ht){
					$h_fitur	= 	$ht['jml'];
				}

				foreach($kedekatan->result_array() as $p) 	// Pencocokan gejala
			if($p['id_solusi'] == $k['id_solusi'] && $t['id_gejala'] == $p['id_gejala']){	
					$b=$p['bobot_gejala'];
					echo "<br/>";
					$pe = $pe + $b;
				}
			}

			$h['id_solusi']			= 	$k['id_solusi'];
			$similarity 			=	$pe/$s; 	// Rumus Similarity
			$h['nilai']				= 	$similarity;
			$h['jumlah_gejala']		= 	$h_gejala;
			$h['jumlah_fitur']		= 	$h_fitur;
			$h['id_pengguna']		= 	$id_pengguna;
			$this->Web_model->input_nilai($h);
		}

	//PHASE 2 = REUSE
		$nilai_similarity			= 	$this->Web_model->solusi_kasus($id_pengguna);
		foreach($nilai_similarity->result_array() as $n){
			$n_similarity			= 	$n['nilai'];
			$kd_solusi				= 	$n['id_solusi'];
		}

	//TAHAP 3 = REVISE	
		//jika nilai similarity antara 0,70 sampai dengan 1
		if($n_similarity >= 0.70 && $n_similarity == 1){
			
			//membuat kode solusi untuk revise
			$kode_kasus				= 	$this->Web_model->kode_kasus();
			foreach($kode_kasus->result_array() as $rows){
				$no = @$rows['urut'] + 1;
				if(strlen($no) == '1'){
				  	$kd_solusi = "S00".$no;
				}
					elseif(strlen($no) == '2'){
				  		$kd_solusi = "S0".$no;
					}
						elseif(strlen($no) == '3'){
				  			$kd_solusi = "S".$no;
						}
			}

			$data['solusi']			= 	$this->Web_model->solusi_problem($id_pengguna);
			foreach($data['solusi']->result_array() as $solusi1){
				$r['id_solusi']		= 	$kd_solusi;
				$r['nama_solusi']	= 	$solusi1['nama_solusi'];
				$r['solusi_masalah']= 	$solusi1['solusi_masalah'];
				$r['validasi']		= 	1;
				$r['urut']			= 	$no;
				$this->Web_model->input_kasus_revise($r);	// Input DB Solusi Revise 
			}

			$data['tmp_gejala']		= 	$this->Web_model->tmp_gejala($id_pengguna);
			foreach($data['tmp_gejala']->result_array() as $gm){
				$g['id_gejala']		= 	$gm['id_gejala'];
				$g['id_solusi']		= 	$kd_solusi;
				$this->Web_model->input_gejala_revise($g);	// Input DB Solusi Revise
			}
		}

		//jika nilai similarity antara 0,50 sampai dengan 0,70
		if($n_similarity >= 0.50 && $n_similarity <= 0.70) {
			//membuat kode solusi untuk revise
			$kode_kasus				= 	$this->Web_model->kode_kasus();
			foreach($kode_kasus->result_array() as $rows){
				$no = @$rows['urut'] + 1;
				if(strlen($no) == '1'){
				  	$kd_solusi = "S00".$no;
				}
					elseif(strlen($no) == '2'){
				  		$kd_solusi = "S0".$no;
					}
						elseif(strlen($no) == '3'){
				  			$kd_solusi = "S".$no;
						}
			}

			$data['solusi']			= 	$this->Web_model->solusi_problem($id_pengguna);
			foreach($data['solusi']->result_array() as $solusi1){
				$r['id_solusi']		= 	$kd_solusi;
				$r['nama_solusi']	= 	$solusi1['nama_solusi'];
				$r['solusi_masalah']= 	$solusi1['solusi_masalah'];
				$r['validasi']		= 	1;
				$r['urut']			= 	$no;
				$this->Web_model->input_kasus_revise($r);	// Input DB Solusi Revise
			}

			$data['tmp_gejala']		= 	$this->Web_model->tmp_gejala($id_pengguna);
			foreach($data['tmp_gejala']->result_array() as $gm){
				$g['id_gejala']		= 	$gm['id_gejala'];
				$g['id_solusi']		= 	$kd_solusi;
				$this->Web_model->input_gejala_revise($g);	// Input DB Solusi Revise
			}
		}

		//jika nilai similarity 0 sampai dengan 0.50
		if($n_similarity >= 0 && $n_similarity <=0.50){
			//membuat kode solusi untuk revise
			$kode_kasus				= 	$this->Web_model->kode_kasus();
			foreach($kode_kasus->result_array() as $rows){
				$no = @$rows['urut'] + 1;
				if(strlen($no) == '1'){
				  	$kd_solusi = "S00".$no;
				}
					elseif(strlen($no) == '2'){
				  		$kd_solusi = "S0".$no;
					}
						elseif(strlen($no) == '3'){
				  			$kd_solusi = "S".$no;
						}
			}
			$r['id_solusi']			= 	$kd_solusi;
			$r['nama_solusi']		= 	"Kasus belum ada di database";
			$r['solusi_masalah']	= 	"Rekomendasi solusi belum tersedia";
			$r['validasi']			= 	1;
			$r['urut']				= 	$no;
			$this->Web_model->input_kasus_revise($r);	// Input DB Solusi Revise
			
			$data['tmp_gejala']		= 	$this->Web_model->tmp_gejala($id_pengguna);
			foreach($data['tmp_gejala']->result_array() as $gm){
				$g['id_gejala']		= 	$gm['id_gejala'];
				$g['id_solusi']		= 	$kd_solusi;
				$this->Web_model->input_gejala_revise($g);	// Input DB Solusi Revise
			}
		}
		?>
		<script>window.location="detail_solusi/<?php echo $kd_solusi;?>";</script>;
		<?php
    }

	public function detail_solusi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Detail Pemecahan Masalah | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id						= 	$this->uri->segment(3);
			$data['solusi']			= 	$this->Web_model->solusi_kasus($id_pengguna);
			$data['tmp_gejala']		= 	$this->Web_model->tmp_gejala($id_pengguna);
			$data['detail_solusi']	= 	$this->Web_model->detail_solusi($id);
			$data['detail_solusi']	= 	$this->Web_model->detail_solusi($id);
			$data['riwayat']		= 	$this->Web_model->daftar_kasus_riwayat1($id);
			$jumlah_lihat			= 	$this->Web_model->detail_solusi($id);
			foreach($jumlah_lihat->result_array() as $lihat){
				$l['dilihat']		= 	$lihat['dilihat'] + 1;
			}
			$this->Web_model->update_dilihat($l,$id);
			$data['content']		= 	'detail_solusi';
			$this->load->view('templete',$data);
	}

	function revisi_solusi(){	
		$data 					=	array();
		$id						= 	$this->input->post('id_solusi');
		$data['validasi']		= 	'3';
		$r['id_solusi']			= 	$this->input->post('id_solusi');
		$r['revisi']			= 	$this->input->post('revisi');
		$r['id_pengguna']		= 	$this->input->post('id_pengguna');
		$this->Web_model->revisi_solusi($data,$id);
		$this->Web_model->input_revisi_pengguna($r);
		?>
		<script>window.location="detail_solusi/<?php echo $id;?>";</script>;
		<?php
    }

	public function revise(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Data Revisi | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['kasus']			= 	$this->Web_model->daftar_kasus_revise();
			$data['revisi']			= 	$this->Web_model->revisi_pengguna();
			$data['gejala_masalah']	= 	$this->Web_model->gejala_masalah();
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['riwayat']		= 	$this->Web_model->riwayat();
			$data['content']		= 	'data_revise';
			$this->load->view('templete',$data);
	}
	
	public function edit_revisi(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Solusi | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id						= 	$this->uri->segment(3);
			$data['gejala']			= 	$this->Web_model->daftar_gejala();
			$data['solusi']	 		= 	$this->Web_model->edit_solusi($id);
			$data['gejala_masalah']	= 	$this->Web_model->gejala_masalah();
			$data['revisi']			= 	$this->Web_model->revisi_pengguna();
			$data['content']		= 	'edit_revisi';
			$this->load->view('templete',$data);
	}

	function update_revisi(){
		$id							= 	$this->input->post('id_solusi');
		$data['nama_solusi']		= 	$this->input->post('nama_solusi');
		$data['solusi_masalah']		= 	$this->input->post('solusi_masalah');
		$data['validasi']			= 	'0';
		
		$r['id_solusi']				= 	$this->input->post('r_id_solusi');
		$r['nama_solusi']			= 	$this->input->post('r_nama_solusi');
		$r['solusi_masalah']		= 	$this->input->post('r_solusi_masalah');
		if($r['nama_solusi']	!=	"Kasus belum ada di database"){
			$this->Web_model->input_riwayat($r);
		}
		$this->Web_model->update_solusi($data,$id);
		$this->Web_model->hapus_revisi_pengguna($id);
		redirect(base_url('control/revise'), 'refresh');
	}

	function hapus_revisi(){
		$id						= 	$this->uri->segment(3);
		$this->Web_model->hapus_solusi($id);
		redirect(base_url('control/revise'), 'refresh');
	}
	
	function batal_revisi_pengguna(){
		$id						= $this->input->post('id_solusi');
		$this->Web_model->hapus_revisi_pengguna($id);
		redirect(base_url('control/revise'), 'refresh');
	}



	
	
/* Ending The Main Controller CBR Method */	

	public function search(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Edit Solusi | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$data['tacit']	 		= 	$this->Web_model->daftar_data_tacit();
			$data['explicit'] 		= 	$this->Web_model->daftar_data_explicit();
			$data['cari_tacit']		= 	$this->Web_model->search_t();
			$data['cari_explicit']	= 	$this->Web_model->search_e();
			$data['content']		= 	'search';
			$this->load->view('templete',$data);
	}

	public function riwayat(){
		$data['login']			= 	$this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('control/login'));
		
			$data['title']			=	'Riwayat Kasus | Pusat Komputer IAIN Kota Bengkulu';
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['notif']			= 	$this->Web_model->notif($id_pengguna);
			$data['valid_t']		= 	$this->Web_model->valid_t($id_pengguna);
			$data['nvalid_t']		= 	$this->Web_model->nvalid_t($id_pengguna);
			$data['valid_e']		= 	$this->Web_model->valid_e($id_pengguna);
			$data['nvalid_e']		= 	$this->Web_model->nvalid_e($id_pengguna);
			$id						= 	$this->uri->segment(3);
			$data['gejala']			= 	$this->Web_model->daftar_gejala();
			$data['kasus']			= 	$this->Web_model->daftar_kasus_riwayat($id);
			$data['riwayat']		=	$this->Web_model->daftar_kasus_riwayat1($id);
			$data['gejala_masalah']	= 	$this->Web_model->gejala_masalah();
			$data['content']		= 	'riwayat';
			$this->load->view('templete',$data);
	}
	
	
	
}

/* End of file control.php */
/* Location: ./application/controllers/control.php */