<?php

class master_data_semester extends CI_Controller
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

         $judul = array('judul' => 'Master Data Semester');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/master_data_semester/view_semester',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Data Semester');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/master_data_semester/form_semester',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Data Semester');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/master_data_semester/form_semester',$data);

    }

    function proses_tambah()
    {
         $pesan = sha1('pesan');
         $id_smt = $this->input->post('id_smt');
         $nama_smt = $this->input->post('nama_smt');

         $ins = $this->db->query("INSERT into master_data_semester (id_smt, nama_smt) Values ('$id_smt','$nama_smt')");
         if ($ins) {
              redirect('admin/master_data_semester?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/master_data_semester?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
         $pesan = sha1('pesan');
         $id = $this->input->post('id');
         $id_smt = $this->input->post('id_smt');
         $nama_smt = $this->input->post('nama_smt');

         $edit = $this->db->query("UPDATE master_data_semester set
               nama_smt ='$nama_smt',
               id_smt = '$id_smt'
               WHERE id_smt = '$id'
         ");
         if ($edit) {
              redirect('admin/master_data_semester?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/master_data_semester?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM master_data_semester where id = '$id'");
         if ($del) {
              redirect('admin/master_data_semester?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/master_data_semester?'.$pesan.'=hapus_gagal');
         }
     }
     function cek_smt(){
          $id_smt = $this->input->post('id_smt');
          $query = $this->db->query("SELECT * FROM master_data_semester where id_smt = '$id_smt'");
          $hitung = $query->num_rows();

          if ($hitung == 1) {
               echo "ID semester Telah Terpaakai";
          }else {
               echo "Id Semester Tersedia";
          }
     }

     function set_aktif()
     {
          $pesan = sha1('pesan');
          $id_smt = $this->input->get('id');

          $upd_all = $this->db->query("UPDATE master_data_semester set status_active = '0' where id_smt is not NULL");
          $set = $this->db->query("UPDATE master_data_semester set status_active = '1' where id_smt = '$id_smt'");
          if ($set) {
              redirect('admin/master_data_semester?'.$pesan.'=active_sukses');
         }else {
              redirect('admin/master_data_semester?'.$pesan.'=active_gagal');
         }

     }

}


 ?>
