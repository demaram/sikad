<?php

class Kelas extends CI_Controller
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

         $judul = array('judul' => 'Data Kelas');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/kelas/view_data_kelas',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Data Kelas');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/kelas/form_data_kelas',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Data Kelas');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/kelas/form_data_kelas',$data);

    }

    function proses_tambah()
    {
         $pesan = sha1('pesan');
         $nama_kelas = $this->input->post('nama_kelas');
         $kode_kelas = $this->input->post('kode_kelas');
         $keterangan = $this->input->post('keterangan');
         $id_guru_wali= $this->input->post('id_guru_wali');

         $ins = $this->db->query("INSERT into kelas (nama_kelas,kode_kelas,keterangan,id_guru_wali) Values ('$nama_kelas','$kode_kelas','$keterangan','$id_guru_wali')");
         if ($ins) {
              redirect('admin/kelas?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/kelas?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
         $pesan = sha1('pesan');
         $id = $this->input->post('id');
         $nama_kelas = $this->input->post('nama_kelas');
         $kode_kelas = $this->input->post('kode_kelas');
         $keterangan = $this->input->post('keterangan');
         $id_guru_wali= $this->input->post('id_guru_wali');

         $edit = $this->db->query("UPDATE kelas set
               nama_kelas ='$nama_kelas',
               kode_kelas ='$kode_kelas',
               keterangan ='$keterangan',
               id_guru_wali = '$id_guru_wali'

               WHERE id_kelas = '$id'
         ");
         if ($edit) {
              redirect('admin/kelas?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/kelas?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM kelas where id_kelas = '$id'");
         if ($del) {
              redirect('admin/kelas?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/kelas?'.$pesan.'=hapus_gagal');
         }
     }

     function kelas_matpel()
     {
         $judul = array('judul' => 'Mata Pelajaran Kelas');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/kelas/view_kelas_matpel',$data);
     }

     function add_kelas_matpel()
     {

        $judul = array('judul' => 'Tambah Kelas Mata Pelajaran');
        $passing_data = $this->session->userdata('logged_in');
        $data = array_merge($passing_data,$judul);
        $this->load->view('admin_views/kelas/form_kelas_matpel',$data);

    }

    function edit_kelas_matpel()
    {

       $judul = array('judul' => 'Edit Kelas Mata Pelajaran');
       $passing_data = $this->session->userdata('logged_in');
       $data = array_merge($passing_data,$judul);
       $this->load->view('admin_views/kelas/form_kelas_matpel',$data);

   }
    function proses_tambah_kmp()
    {
       $id_link = $this->input->post('id_link');
       $jam_ke = $this->input->post('jam_ke');
       $id_kelas_matpel = $this->input->post('id_kelas_matpel');
       $id_kelas = $this->input->post('id_kelas');
       $jam_mulai = date('H:i',strtotime($this->input->post('jam_mulai')));
      $jam_selesai = date('H:i',strtotime($this->input->post('jam_selesai')));
      $id_matpel_senin = $this->input->post('id_matpel_senin');
      $id_matpel_selasa = $this->input->post('id_matpel_selasa');
      $id_matpel_rabu = $this->input->post('id_matpel_rabu');
      $id_matpel_kamis = $this->input->post('id_matpel_kamis');
      $id_matpel_jumat = $this->input->post('id_matpel_jumat');
      $id_matpel_sabtu = $this->input->post('id_matpel_sabtu');
       $pesan = sha1('pesan');
       $ins = $this->db->query("INSERT into kelas_matpel (id_kelas,id_matpel_senin,id_matpel_selasa,id_matpel_rabu,id_matpel_kamis,id_matpel_jumat,id_matpel_sabtu,jam_mulai,jam_selesai, jam_ke)
       Values ('$id_kelas','$id_matpel_senin','$id_matpel_selasa','$id_matpel_rabu','$id_matpel_kamis','$id_matpel_jumat','$id_matpel_sabtu','$jam_mulai','$jam_selesai','$jam_ke')");
          if ($ins) {
               redirect('admin/kelas/kelas_matpel?id='.$id_link.'&'.$pesan.'=add_sukses');
          }else {
               redirect('admin/kelas/kelas_matpel?id'.$id_link.'&'.$pesan.'=add_gagal');
          }
   }

   function proses_edit_kmp()
   {
     $jam_ke = $this->input->post('jam_ke');
     $id_link = $this->input->post('id_link');
     $jam_mulai = date('H:i',strtotime($this->input->post('jam_mulai')));
     $jam_selesai = date('H:i',strtotime($this->input->post('jam_selesai')));
     $id_kelas_matpel = $this->input->post('id');
     $id_kelas = $this->input->post('id_kelas');
     $id_matpel_senin = $this->input->post('id_matpel_senin');
     $id_matpel_selasa = $this->input->post('id_matpel_selasa');
     $id_matpel_rabu = $this->input->post('id_matpel_rabu');
     $id_matpel_kamis = $this->input->post('id_matpel_kamis');
     $id_matpel_jumat = $this->input->post('id_matpel_jumat');
     $id_matpel_sabtu = $this->input->post('id_matpel_sabtu');

     $pesan = sha1('pesan');
     $edit = $this->db->query("UPDATE kelas_matpel set
           jam_ke = '$jam_ke',
           id_kelas   = '$id_kelas',
           jam_mulai ='$jam_mulai',
           jam_selesai ='$jam_selesai',
           id_matpel_senin = '$id_matpel_senin',
           id_matpel_selasa = '$id_matpel_selasa',
           id_matpel_rabu = '$id_matpel_rabu',
           id_matpel_kamis = '$id_matpel_kamis',
           id_matpel_jumat= '$id_matpel_jumat',
           id_matpel_sabtu = '$id_matpel_sabtu'

           WHERE id_kelas_matpel = '$id_kelas_matpel'
     ");
     if ($edit) {
         redirect('admin/kelas/kelas_matpel?id='.$id_link.'&'.$pesan.'=edit_sukses');
     }else {
        redirect('admin/kelas/kelas_matpel?id='.$id_link.'&'.$pesan.'=edit_gagal');
     }
 }
   function proses_hapus_kmp()
   {
        $pesan = sha1('pesan');
        $id = $this->input->get('id');
        $id_kmp = $this->input->get('id_kmp');
        $del = $this->db->query("DELETE FROM kelas_matpel where id_kelas_matpel = '$id_kmp'");
        if ($del) {
            redirect('admin/kelas/kelas_matpel?id='.$id.'&'.$pesan.'=hapus_sukses');
        }else {
            redirect('admin/kelas/kelas_matpel?id='.$id.'&'.$pesan.'=hapus_gagal');
        }
   }

}


 ?>
