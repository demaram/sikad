<?php

class Profil extends CI_Controller
{

     function __construct()
     {

          parent::__construct();
          error_reporting(E_ALL & ~E_NOTICE);
          $this->load->model('admin_models/m_admin');
          if(! $this->session->userdata('logged_guru')){
               echo "<script>
               alert('Anda Belum Punya Akses, Silahkan Login Terlebih Dahulu');
               window.location.href='../admin/login';
               </script>";
		}
     }

     function index()
     {

         $judul = array('judul' => 'Profil User');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);
         $this->load->view('staff_views/profil/s_view_profil',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Profil');
          $passing_data = $this->session->userdata('logged_guru');
          $data = array_merge($passing_data,$judul);

          $this->load->view('staff_views/profil/s_form_profil',$data);

     }

     function proses_edit()
     {
          $photo   = $_FILES['photo']['name'];
          if (!empty($photo)) {
               $nama_photo = rand(0,99).$photo;
               $config['upload_path'] = './assets/foto/';
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size']     = '2000';
               $config['max_width'] = '1300';
               $config['max_height'] = '768';
               $config['file_name'] = $nama_photo;
               $this->load->library('upload', $config);
               $this->upload->do_upload('photo');
          }else {
               $nama_photo = $this->input->post('photo_asli');
          }

         $pesan = sha1('pesan');
         $id = $this->input->post('id');
         $username = $this->input->post('username');
         $nama = $this->input->post('nama');
         $tgl_lahir = date('Y-m-d',strtotime($this->input->post('tgl_lahir')));
         $no_hp =$this->input->post('no_hp');
         $email =$this->input->post('email');

         $edit = $this->db->query("UPDATE users set
               nama ='$nama',
               username ='$username',
               tgl_lahir ='$tgl_lahir',
               no_hp ='$no_hp',
               email ='$email',
               photo = '$nama_photo'

               WHERE id_user = '$id'
         ");
         if ($edit) {
              $this->session->set_flashdata('pesan_success', 'Berhasil Edit Data');
              redirect('staff/profil');
         }else {
              $this->session->set_flashdata('pesan_success', 'Berhasil Edit Data');
              redirect('staff/profil');
         }
     }



}


 ?>
