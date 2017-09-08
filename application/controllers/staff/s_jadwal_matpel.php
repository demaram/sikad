<?php
/**
 *
 */
class S_jadwal_matpel extends CI_Controller
{

     function __construct()
     {

          parent::__construct();
          error_reporting(E_ALL & ~E_NOTICE);
          $this->load->model('model_staff');
          if(! $this->session->userdata('logged_guru')){
               echo "<script>
               alert('Anda Belum Punya Akses, Silahkan Login Terlebih Dahulu');
               window.location.href='../admin/login';
               </script>";
		}
     }

     function index()
    {

         $judul = array('judul' => 'Jadwal Guru');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);

         $this->load->view('staff_views/jadwal_guru/s_view_jadwal',$data);

    }


}// END class


 ?>
