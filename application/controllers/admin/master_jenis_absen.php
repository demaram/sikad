<?php

class master_jenis_absen extends CI_Controller
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

         $judul = array('judul' => 'Master Jenis Absen');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/master_jenis_absen/view_absen',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Jenis Absen');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/master_jenis_absen/form_absen',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Jenis Absen');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/master_jenis_absen/form_absen',$data);

    }

    function proses_tambah()
    {
         $pesan = sha1('pesan');
         $nama_absen = $this->input->post('nama_absen');
         $keterangan = $this->input->post('keterangan');
         $warna = $this->input->post('warna');

         $ins = $this->db->query("INSERT into master_jenis_absen (nama_absen, keterangan, warna) Values ('$nama_absen','$keterangan','$warna')");
         if ($ins) {
              redirect('admin/master_jenis_absen?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/master_jenis_absen?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
         $pesan = sha1('pesan');
         $id = $this->input->post('id');

         $nama_absen = $this->input->post('nama_absen');
         $keterangan = $this->input->post('keterangan');
         $warna = $this->input->post('warna');

         $edit = $this->db->query("UPDATE master_jenis_absen set
               nama_absen ='$nama_absen',
               keterangan = '$keterangan',
               warna = '$warna'
               WHERE id_jenis_absen = '$id'
         ");
         if ($edit) {
              redirect('admin/master_jenis_absen?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/master_jenis_absen?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM master_jenis_absen where id_jenis_absen = '$id'");
         if ($del) {
              redirect('admin/master_jenis_absen?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/master_jenis_absen?'.$pesan.'=hapus_gagal');
         }
     }

}


 ?>
