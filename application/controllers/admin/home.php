<?php
/**
 *
 */
class Home extends CI_Controller
{

     function __construct()
     {

          parent::__construct();
          error_reporting(E_ALL & ~E_NOTICE);
          $this->load->model('admin_models/m_admin');
          if(! $this->session->userdata('logged_in')){
               echo "<script>
               alert('Anda Belum Punya Akses, Silahkan Login Terlebih Dahulu');
               window.location.href='../admin/login';
               </script>";
		}
     }

     function index()
     {
         $judul = array('judul' => 'Dashboard Admin');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $jumlah = $this->m_admin->jumlah();

         $data = array_merge($data,$jumlah);

         $this->load->view('admin_views/dashboard',$data);
     }

}


 ?>
