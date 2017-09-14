<?php

class master_skala_nilai extends CI_Controller
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

         $judul = array('judul' => 'Master Skala Nilai');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/master_skala_nilai/view_skala',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Skala Nilai');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/master_skala_nilai/form_skala',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Skala Nilai');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/master_skala_nilai/form_skala',$data);

    }

    function proses_tambah()
    {
         $pesan = sha1('pesan');
         $nilai_huruf = $this->input->post('nilai_huruf');
         $nilai_index = $this->input->post('nilai_index');
         $nilai_maksimum = $this->input->post('nilai_maksimum');
         $nilai_minimum = $this->input->post('nilai_minimum');

         $ins = $this->db->query("INSERT into skala_nilai (nilai_huruf, nilai_index, nilai_maksimum,nilai_minimum)
                              Values ('$nilai_huruf','$nilai_index','$nilai_maksimum','$nilai_minimum')");
         if ($ins) {
              redirect('admin/master_skala_nilai?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/master_skala_nilai?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
         $pesan = sha1('pesan');
         $id = $this->input->post('id');
         $nilai_huruf = $this->input->post('nilai_huruf');
         $nilai_index = $this->input->post('nilai_index');
         $nilai_maksimum = $this->input->post('nilai_maksimum');
         $nilai_minimum = $this->input->post('nilai_minimum');


         $edit = $this->db->query("UPDATE jenis_agama set

               nilai_huruf = '$nilai_huruf',
               nilai_index = '$nilai_index',
               nilai_maximum = '$nilai_maximum',
               nilai_minimum = '$nilai_minimum'


               WHERE id_skala_nilai = '$id'
         ");
         if ($edit) {
              redirect('admin/master_skala_nilai?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/master_skala_nilai?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM skala_nilai where id_skala_nilai = '$id'");
         if ($del) {
              redirect('admin/master_skala_nilai?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/master_skala_nilai?'.$pesan.'=hapus_gagal');
         }
     }

}


 ?>
