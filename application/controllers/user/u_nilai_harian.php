<?php
/**
 *  Kelas User Nilai Harian
 */
class U_nilai_harian extends CI_Controller
{

     function __construct()
     {
        parent::__construct();
        error_reporting(E_ALL & ~E_NOTICE);
        if(! $this->session->userdata('logged_user')){
             echo "<script>
             alert('Anda Belum Login, Silahkan Login Terlebih Dahulu');
             window.location.href='../login';
             </script>";
        }
     }

     public function index()
     {

          $judul = array('judul' => 'Nilai Harian');
          $passing_data = $this->session->userdata('logged_user');
          $data = array_merge($passing_data,$judul);
          $this->load->view('user_views/nilai_harian/u_view_nilai',$data);

     }
}


 ?>
