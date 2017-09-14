<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(E_ALL & ~E_NOTICE);
	}

	public function index()
	{

	     $data = array('title' => 'Login Akademik',
				    'text_form' => 'Login Siswa'
				   );

   		$this->load->view('v_header',$data);
		$this->load->view('v_login',$data);
	}

     function cek_login(){
		error_reporting(E_ALL & ~E_NOTICE);
	 	$username = $this->input->get("username");
          $password_hash = $this->input->get("password");
          $password = md5($password_hash);

		$smt = $this->db->query("SELECT * FROM master_data_semester where status_active = '1'");
		$ret_smt = $smt->row();
		$id_smt = $ret_smt->id_smt;


		$cekdata = $this->db->query("SELECT * FROM tbl_siswa where username='$username' AND password='$password'");
		foreach ($cekdata->result() as $row) {
			$pd_siswa = $this->db->query("SELECT id_pd_siswa, id_kelas FROM tbl_pd_siswa where id_siswa = '$row->id_siswa' AND id_smt='$id_smt'");
			foreach ($pd_siswa->result() as $pd_siswa) {}
		}

		$passing_data = array(
							'username' =>$username,
						 	'password' =>$password,
							'akses' => 'user',
							'id_smt' => $id_smt,
							'title' 	 => 'Sistem Akademik SD Kebutuhan Khusus',
							'id_siswa' => $row->id_siswa,
							'nm_siswa' => $row->nm_siswa,
							'id_pd_siswa'=>$pd_siswa->id_pd_siswa,
							'id_kelas'=>$pd_siswa->id_kelas
	 			 		);



		if ($cekdata->num_rows() ==1) {

			$this->session->set_userdata('logged_user',$passing_data);
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('logged_guru');
			redirect('user/home');
		}else {
			$gagal = sha1('gagal');
			redirect(base_url().'/login?'.$gagal.'=1');
		}

     }
	function logout()
	{
		$this->session->unset_userdata('logged_user');
		$this->session->sess_destroy();
		redirect('login','refresh');

	}
}
