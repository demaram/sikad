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
               if(! $this->session->userdata('logged_user')){
                    echo "<script>
                    alert('Anda Belum Login, Silahkan Login Terlebih Dahulu');
                    window.location.href='../login';
                    </script>";
     		}
          }
          function index()
          {
               $passing_data = $this->session->userdata('logged_user');
               $this->load->view('user_views/dashboard',$passing_data);
          }
          function ganti_password()
          {

              $judul = array('judul' => 'Ganti Password');
              $passing_data = $this->session->userdata('logged_user');
              $data = array_merge($passing_data,$judul);

              $this->load->view('user_views/home/form_ganti_password',$data);
          }

          function proses_password()
          {
               $old_pass = md5($this->input->post("old_pass"));
               $id_siswa = $this->input->post("id_siswa");
               $password = md5($this->input->post("password"));

               $edit =$this->db->query("UPDATE tbl_siswa SET password ='$password' where id_siswa='$id_siswa'");
               if ($edit) {
                        redirect('user/home/ganti_password?'.$pesan.'=edit_sukses');
                   }else {
                        redirect('user/home/ganti_password?'.$pesan.'=edit_gagal');
                   }
          }
          function ajax_password()
          {
               $old_pass = md5($this->input->post("old_pass"));
               $id_siswa = $this->input->post("id_siswa");

               $query =$this->db->query("SELECT * FROM tbl_siswa where id_siswa ='$id_siswa' AND password='$old_pass'");
               if ($query->num_rows() == 1) {
                    echo "<span id='match' class='label label-success'>Password Lama Match</span>";

               }else {
                    echo "<span class='label label-danger'>Password Lama Tidak Match</span>";
                    echo "<input type='hidden' value='tidak_match' id='tidak_match'>";
               }

          }
     }



 ?>
