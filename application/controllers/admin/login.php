<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(E_ALL & ~E_NOTICE);
          $this->load->model('admin_models/m_admin');
		$this->load->library('session');
	}

	public function index()
	{

	     $data = array('title' => 'Login Akademik',
				    'text_form' => 'Login Siswa'
				   );

   		$this->load->view('v_header',$data);
		$this->load->view('admin_views/v_login',$data);
	}
function cek_login(){
	 	$username = $this->input->post("username");
          $password_hash = $this->input->post("password");
          $password = md5($password_hash);

		$smt = $this->db->query("SELECT * FROM master_data_semester where status_active = '1'");
		$ret_smt = $smt->row();
		$id_smt = $ret_smt->id_smt;

		$query = $this->db->query("SELECT * FROM users where username='$username' AND password ='$password'");
		foreach ($query->result() as $row) {
			$guru_wali = $this->db->query("SELECT * FROM kelas where id_guru_wali = '$row->id_user'");
			foreach ($guru_wali->result() as $kelas) {}
		}

		$id_guru  = $row->id_user;

		$passing_data = array(
							'username' =>$username,
						 	'password' =>$password,
							'nama' => $row->nama,
							'id_guru' => $id_guru,
							'akses' => 'admin',
							'id_smt' => $id_smt,
							'id_kelas' => $kelas->id_kelas,
							'title' 	 => 'Sistem Akademik SD Kebutuhan Khusus'
	 			 		);

          $cekdata = $this->m_admin->cek_login_admin($passing_data);
		if ($cekdata == 'admin') {

// Add user data in session
			$this->session->set_userdata('logged_in',$passing_data);
			$this->session->unset_userdata('logged_user');
			$this->session->unset_userdata('logged_guru');
			redirect('admin/home');
		}else if($cekdata=='guru')
		{

			$passing_data = array(
								'username' =>$username,
							 	'password' =>$password,
								'nama' => $row->nama,
								'akses' => 'guru',
								'id_smt' => $id_smt,
								'id_kelas' => $kelas->id_kelas,
								'id_guru' => $id_guru,
								'title' 	 => 'Sistem Akademik SD Kebutuhan Khusus'
		 			 		);
			$this->session->set_userdata('logged_guru',$passing_data);
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('logged_user');
			redirect('staff/home');
		}
		else if($cekdata == false)
		{
			redirect('admin/login');
		}

     }

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('admin/login','refresh');  // <!-- note that

	}

	function logout_guru()
	{
		$this->session->unset_userdata('logged_guru');
		$this->session->sess_destroy();
		redirect('admin/login','refresh');  // <!-- note that

	}
}
