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
          if(! $this->session->userdata('logged_guru')){
               echo "<script>
               alert('Anda Belum Punya Akses, Silahkan Login Terlebih Dahulu');
               window.location.href='../admin/login';
               </script>";
		}
     }

     function index()
     {
         $judul = array('judul' => 'Dashboard Guru');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);

         $this->load->view('staff_views/dashboard',$data);
     }
     function ganti_password()
     {

         $judul = array('judul' => 'Ganti Password');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);
         $this->load->view('staff_views/view_s_ganti_password',$data);
     }

     function proses_password()
     {
          $old_pass = md5($this->input->post("old_pass"));
          $id_user= $this->input->post("id_guru");
          $password = md5($this->input->post("password"));

          $edit =$this->db->query("UPDATE users SET password ='$password' where id_user='$id_user'");
          if ($edit) {
                   redirect('staff/home/ganti_password');
              }else {
                   redirect('staff/home/ganti_password');
              }
     }
     function ajax_password()
     {
          $old_pass = md5($this->input->post("old_pass"));
          $id_user = $this->input->post("id_user");

          $query =$this->db->query("SELECT * FROM users where id_user ='$id_user' AND password='$old_pass'");
          if ($query->num_rows() == 1) {
               echo "<span id='match' class='label label-success'>Password Lama Match</span>";

          }else {
               echo "<span class='label label-danger'>Password Lama Tidak Match</span>";
               echo "<input type='hidden' value='tidak_match' id='tidak_match'>";
          }

     }

}


 ?>
