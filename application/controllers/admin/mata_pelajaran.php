<?php

class Mata_pelajaran extends CI_Controller
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

         $judul = array('judul' => 'Mata Pelajaran');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/mata_pelajaran/view_mata_pelajaran',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Mata Pelajaran');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/mata_pelajaran/form_mata_pelajaran',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Mata Pelajaran');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/mata_pelajaran/form_mata_pelajaran',$data);

    }

    function proses_tambah()
    {
         $pesan = sha1('pesan');
         $nama_matpel = $this->input->post('nama_matpel');
         $kode_matpel = $this->input->post('kode_matpel');
         $kkm = $this->input->post('nilai_kkm');
         $kelompok = $this->input->post('kelompok');
         $keterangan = $this->input->post('keterangan');

         $ins = $this->db->query("INSERT into mata_pelajaran (nama_matpel,kode_matpel,keterangan,kelompok,nilai_kkm)
                              Values ('$nama_matpel','$kode_matpel','$keterangan','$kelompok','$kkm')");
         if ($ins) {
              redirect('admin/mata_pelajaran?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/mata_pelajaran?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
         $pesan = sha1('pesan');
         $id = $this->input->post('id');
         $nama_matpel = $this->input->post('nama_matpel');
         $kode_matpel = $this->input->post('kode_matpel');
         $keterangan = $this->input->post('keterangan');
         $kelompok = $this->input->post('kelompok');
         $kkm = $this->input->post('nilai_kkm');

         $edit = $this->db->query("UPDATE mata_pelajaran set
               nama_matpel ='$nama_matpel',
               kode_matpel ='$kode_matpel',
               kelompok ='$kelompok',
               keterangan ='$keterangan',
               nilai_kkm ='$kkm'

               WHERE id_matpel = '$id'
         ");
         if ($edit) {
              redirect('admin/mata_pelajaran?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/mata_pelajaran?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id_matpel = $this->input->get('id');

         $del = $this->db->query("DELETE FROM mata_pelajaran where id_matpel = '$id_matpel'");
         if ($del) {
              redirect('admin/mata_pelajaran?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/mata_pelajaran?'.$pesan.'=hapus_gagal');
         }
     }

}


 ?>
