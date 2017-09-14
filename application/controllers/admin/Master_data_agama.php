<?php

class Master_data_agama extends CI_Controller
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

         $judul = array('judul' => 'Master Data Agama');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/master_data_agama/view_agama',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Data Agama');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/master_data_agama/form_agama',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Data Agama');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/master_data_agama/form_agama',$data);

    }

    function proses_tambah()
    {
         $pesan = sha1('pesan');
         $nama_agama = $this->input->post('nama_agama');

         $ins = $this->db->query("INSERT into jenis_agama (nama_agama) Values ('$nama_agama')");
         if ($ins) {
              redirect('admin/master_data_agama?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/master_data_agama?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
         $pesan = sha1('pesan');
         $id = $this->input->post('id');
         $nama_agama = $this->input->post('nama_agama');

         $edit = $this->db->query("UPDATE jenis_agama set
               nama_agama ='$nama_agama'
               WHERE id_agama = '$id'
         ");
         if ($edit) {
              redirect('admin/master_data_agama?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/master_data_agama?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM jenis_agama where id_agama = '$id'");
         if ($del) {
              redirect('admin/master_data_agama?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/master_data_agama?'.$pesan.'=hapus_gagal');
         }
     }

}


 ?>
