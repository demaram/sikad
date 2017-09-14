<?php

class Berita extends CI_Controller
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

         $judul = array('judul' => 'Berita Akademik');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/berita/view_berita',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Berita');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/berita/form_berita',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Berita');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/berita/form_berita',$data);

    }

    function proses_tambah()
    {
         $pesan = sha1('pesan');
         $judul = $this->input->post('judul');
         $isi = $this->input->post('isi');
         $tanggal = date('Y-m-d');
         $publisher = $this->input->post('publisher');

         $ins = $this->db->query("INSERT into berita (judul, isi, tanggal, publisher)
                              Values ('$judul','$isi','$tanggal','$publisher')");
         if ($ins) {
              redirect('admin/berita?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/berita?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
         $pesan = sha1('pesan');
         $id = $this->input->post('id');
         $judul = $this->input->post('judul');
         $isi = $this->input->post('isi');
         $tanggal = date('Y-m-d');
         $publisher = $this->input->post('publisher');


         $edit = $this->db->query("UPDATE berita set

               judul = '$judul',
               isi = '$isi',
               tanggal = '$tanggal',
               publisher = '$publisher'


               WHERE id_berita = '$id'
         ");
         if ($edit) {
              redirect('admin/berita?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/berita?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM berita where id_berita = '$id'");
         if ($del) {
              redirect('admin/berita?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/berita?'.$pesan.'=hapus_gagal');
         }
     }

}


 ?>
