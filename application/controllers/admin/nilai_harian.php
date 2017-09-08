<?php

class Nilai_harian extends CI_Controller
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

         $judul = array('judul' => 'Filter Kelas',
                        'judul2' =>'Mata Pelajaran Tersedia');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/nilai_harian/view_nilai_harian',$data);
     }

     function get_siswa()
     {
          $judul = array('judul' => 'Nilai Harian Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/nilai_harian/view_nilai_siswa',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Mata Pelajaran');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/nilai_harian/form_nilai_harian',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Nilai Harian');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/nilai_harian/form_nilai_harian',$data);

    }

    function proses_tambah()
    {
         $pesan = sha1('pesan');
         $smt = $this->input->post('smt');
         $id_kelas = $this->input->post('id_kelas');
         $id_pd_siswa = $this->input->post('id_pd_siswa');
         $id_matpel = $this->input->post('id_matpel');
         $nilai_huruf_ekspresif = $this->input->post('nilai_huruf_ekspresif');
         $nilai_huruf_reseptif = $this->input->post('nilai_huruf_reseptif');

         $nilai_angka_ekspresif = $this->input->post('nilai_angka_ekspresif');
         $nilai_angka_reseptif = $this->input->post('nilai_angka_reseptif');
         $tgl_nilai = date('Y-m-d',strtotime($this->input->post('tgl_nilai')));

         $ins = $this->db->query("INSERT into nilai_harian (id_pd_siswa,     id_matpel,    nilai_angka_reseptif,nilai_angka_ekspresif,   nilai_huruf_reseptif,   nilai_huruf_ekspresif,tgl_nilai)
                                                     Values ('$id_pd_siswa','$id_matpel','$nilai_angka_reseptif','$nilai_angka_ekspresif','$nilai_huruf_reseptif','$nilai_huruf_reseptif','$tgl_nilai')");
         if ($ins) {
              redirect('admin/nilai_harian/get_siswa?id_matpel='.$id_matpel.'&id_kelas='.$id_kelas.'&smt='.$smt.'&'.$pesan.'=add_sukses');
         }else {
              redirect('admin/nilai_harian/get_siswa?id_matpel='.$id_matpel.'&id_kelas='.$id_kelas.'&smt='.$smt.'&'.$pesan.'=add_sukses');
         }
     }

     function proses_edit()
     {
         $pesan = sha1('pesan');
         $id = $this->input->post('id');

         $smt =  $this->input->post('smt');
         $id_kelas = $this->input->post('id_kelas');
         $id_pd_siswa = $this->input->post('id_pd_siswa');
         $id_matpel = $this->input->post('id_matpel');
         $nilai_huruf_ekspresif = $this->input->post('nilai_huruf_ekspresif');
         $nilai_huruf_reseptif = $this->input->post('nilai_huruf_reseptif');

         $nilai_angka_ekspresif = $this->input->post('nilai_angka_ekspresif');
         $nilai_angka_reseptif = $this->input->post('nilai_angka_reseptif');
         $tgl_nilai = date('Y-m-d',strtotime($this->input->post('tgl_nilai')));

         $edit = $this->db->query("UPDATE nilai_harian set
               id_pd_siswa ='$id_pd_siswa',
               id_matpel ='$id_matpel',
               nilai_huruf_ekspresif ='$nilai_huruf_ekspresif',
               nilai_huruf_reseptif ='$nilai_huruf_reseptif',
               nilai_angka_ekspresif = '$nilai_angka_ekspresif',
               nilai_angka_reseptif = '$nilai_angka_reseptif',
               tgl_nilai = '$tgl_nilai'

               WHERE id_nilai = '$id'
         ");
         if ($edit) {
              redirect('admin/nilai_harian/get_siswa?id_matpel='.$id_matpel.'&id_kelas='.$id_kelas.'&smt='.$smt.'&'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/nilai_harian/get_siswa?id_matpel='.$id_matpel.'&id_kelas='.$id_kelas.'&smt='.$smt.'&'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $conid = $this->input->get('conid');
         $id_matpel = $this->input->get('id_matpel');
         $id_kelas = $this->input->get('id_kelas');
         $smt = $this->input->get('smt');
         $del = $this->db->query("DELETE FROM nilai_harian where id_nilai = '$conid'");
         if ($del) {
              redirect('admin/nilai_harian/get_siswa?id_matpel='.$id_matpel.'&id_kelas='.$id_kelas.'&smt='.$smt.'&'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/nilai_harian/get_siswa?id_matpel='.$id_matpel.'&id_kelas='.$id_kelas.'&smt='.$smt.'&'.$pesan.'=hapus_gagal');
         }
     }

     function ajax_nilai()
     {
          $nilai_huruf_ekspresif = $this->input->post("nilai_huruf_ekspresif");
          $query = $this->db->query("SELECT * From skala_nilai where nilai_huruf = '$nilai_huruf_ekspresif'");
          foreach ($query->result() as $row) {

               $nilai_minimum_ekspresif =  $row->nilai_minimum;
               $nilai_maksimum_ekspresif = $row->nilai_maksimum;
               ?>
               <script type="text/javascript">
                    var nilai_minimum_ekspresif = <?= $nilai_minimum_ekspresif; ?>;
                    var nilai_maksimum_ekspresif = <?= $nilai_maksimum_ekspresif ?>;
               </script>
               <?php
               echo "Input Data Antara ".$nilai_minimum_ekspresif ." - ".$nilai_maksimum_ekspresif;
          }
     }

     function ajax_nilai_2()
     {
          $nilai_huruf_reseptif = $this->input->post("nilai_huruf_reseptif");
          $query = $this->db->query("SELECT * From skala_nilai where nilai_huruf = '$nilai_huruf_reseptif'");
          foreach ($query->result() as $row) {

               $nilai_minimum_reseptif =  $row->nilai_minimum;
               $nilai_maksimum_reseptif = $row->nilai_maksimum;
               ?>
               <script type="text/javascript">
                    var nilai_minimum_reseptif = <?= $nilai_minimum_reseptif; ?>;
                    var nilai_maksimum_reseptif = <?= $nilai_maksimum_reseptif ?>;
               </script>
               <?php
               echo "Input Data Antara ".$nilai_minimum_reseptif ." - ".$nilai_maksimum_reseptif;
          }
     }
}


 ?>
