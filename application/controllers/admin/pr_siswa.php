<?php

class Pr_siswa extends CI_Controller
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

         $judul = array('judul' => 'Pekerjaan Rumah Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/pr_siswa/view_pr_siswa',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Data Siswa');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/pr_siswa/form_pr_siswa',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah PR');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/pr_siswa/form_pr_siswa',$data);

    }

    function proses_tambah()
    {
         $pesan               = sha1('pesan');
         $id_kelas  = $this->input->post('id_kelas');
         $id_smt = $this->input->post('id_smt');
         $id_matpel = $this->input->post('id_matpel');
         $detail    = $this->input->post('detail');
         $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
         $tgl_awal = date('Y-m-d',strtotime($this->input->post('tgl_awal')));


         $ins                 = $this->db->query("INSERT into tbl_pr
                                         (id_kelas, id_matpel, detail, tgl_akhir, tgl_awal, id_smt)
                                  Values ('$id_kelas', '$id_matpel', '$detail', '$tgl_akhir', '$tgl_awal','$id_smt')");
         if ($ins) {
              redirect('admin/pr_siswa?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/pr_siswa?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
         $pesan     = sha1('pesan');
         $id        = $this->input->post('id');
         $id_smt = $this->input->post('id_smt');
         $id_kelas  = $this->input->post('id_kelas');
         $id_matpel = $this->input->post('id_matpel');
         $detail    = $this->input->post('detail');
         $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
         $tgl_awal  = date('Y-m-d',strtotime($this->input->post('tgl_awal')));

         $edit = $this->db->query("UPDATE tbl_pr set
                id_kelas            = '$id_kelas',
                id_matpel          = '$id_matpel',
                detail             = '$detail',
                tgl_akhir          = '$tgl_akhir',
                tgl_awal           = '$tgl_awal',
                id_smt             = '$id_smt'

               WHERE id_pr      = '$id'
         ");
         if ($edit) {
              redirect('admin/pr_siswa?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/pr_siswa?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM tbl_pr where id_pr = '$id'");
         if ($del) {
              redirect('admin/pr_siswa?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/pr_siswa?'.$pesan.'=hapus_gagal');
         }
     }



}


 ?>
