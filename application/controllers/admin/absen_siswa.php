<?php

class Absen_siswa extends CI_Controller
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

         $judul = array('judul' => 'Data Absen Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/absen_siswa/view_absen',$data);
     }

     function lihat_data()
     {

         $judul = array('judul' => 'Data Absen');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/absen_siswa/view_absen_persiswa',$data);
     }


     function edit_data()
     {


          $judul = array('judul' => 'Edit Data Absen');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/absen_siswa/form_absen_siswa',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Data Absen');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/absen_siswa/form_absen_siswa',$data);

    }

    function proses_tambah()
    {

         $pesan               = sha1('pesan');
         $id_kelas = $this->input->post('id_kelas');
         $tgl_absen = date('Y-m-d',strtotime($this->input->post('tgl_absen')));
         $id_smt = $this->input->post('id_smt');

        $siswa = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas = '$id_kelas'");
        $jumlah = $siswa->num_rows();

        $cari = $this->db->query("SELECT * FROM tbl_absen_siswa where tgl_absen = '$tgl_absen'");
        $count = $cari->num_rows();

        $del = $this->db->query("DELETE FROM tbl_absen_siswa where tgl_absen = '$tgl_absen' AND id_kelas ='$id_kelas'");
        if ($del) {
             for ($i=1; $i<=$jumlah; $i++) {
                  $id_pd_siswa = $this->input->post('id_pd_siswa_'.$i);
                  $id_jenis_absen = $this->input->post('id_jenis_absen_'.$i);
                  $insert = $this->db->query("INSERT into tbl_absen_siswa (id_kelas, tgl_absen, id_pd_siswa, id_jenis_absen) values('$id_kelas','$tgl_absen','$id_pd_siswa','$id_jenis_absen')");

                  $sukses_insert = 1;
             }
             if ($sukses_insert == 1) {
                 redirect('admin/absen_siswa/lihat_data?id='.$id_kelas.'&'.$pesan.'=add_sukses'.'&s='.$id_smt);
            }else {
                redirect('admin/absen_siswa/lihat_data?id='.$id_kelas.'&'.$pesan.'=add_gagal'.'&s='.$id_smt);
            }
        }


        /*else{
             for ($i=1; $i<=$jumlah; $i++) {
                  $id_absen = $this->input->post('id_absen_'.$i);
                  $id_siswa = $this->input->post('id_siswa_'.$i);
                  $id_jenis_absen = $this->input->post('id_jenis_absen_'.$i);

                  echo "id_absen =" . $id_absen."<br>";
                  echo "id_siswa =" . $id_siswa."<br>";
                  echo "id_jenis_absen =" . $id_jenis_absen."<br>";

                  $insert = $this->db->query("UPDATE tbl_absen_siswa set
                       id_siswa            = '$id_siswa',
                       tgl_absen            = '$tgl_absen',
                       id_jenis_absen       = '$id_jenis_absen',
                       id_kelas = '$id_kelas'

                       where id_absen = '$id_absen'
                  ");

                  $sukses_update = 1;
             }
             if ($sukses_update == 1) {
                 redirect('admin/absen_siswa/lihat_data?id='.$id_kelas.'&'.$pesan.'=edit_sukses');
             }

        }*/




        /* if ($ins) {
              redirect('admin/absen_siswa/lihat_data?id='.$id_siswa.'&'.$pesan.'=add_sukses');
         }else {
              redirect('admin/data_siswa/lihat_data?id='.$id_siswa.'&'.$pesan.'=add_gagal');
         }*/
     }

     function proses_edit()
     {

          $pesan      = sha1('pesan');
          $id_siswa   = $this->input->post('id_siswa');
          $id         = $this->input->post('id_absen');
          $tgl_absen  = date('Y-m-d',strtotime($this->input->post('tgl_absen')));
          $jns_absen  = $this->input->post('jns_absen');
          $keterangan = $this->input->post('keterangan');

         $edit = $this->db->query("UPDATE tbl_absen_siswa set
                                   id_siswa       = '$id_siswa',
                                   tgl_absen      = '$tgl_absen',
                                   jns_absen      = '$jns_absen',
                                   keterangan     = '$keterangan'
                                   WHERE id_absen = '$id'
         ");
         if ($edit) {
               redirect('admin/absen_siswa/lihat_data?id='.$id_siswa.'&'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/absen_siswa/lihat_data?id='.$id_siswa.'&'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');
         $id_siswa = $this->input->get('id_siswa');
         $del = $this->db->query("DELETE FROM tbl_absen_siswa where id_absen = '$id'");
         if ($del) {
             redirect('admin/absen_siswa/lihat_data?id='.$id_siswa.'&'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/absen_siswa/lihat_data?id='.$id_siswa.'&'.$pesan.'=hapus_gagal');
         }
     }

     function ajax_kabkot()
     {
          $kode_provinsi = $this->input->post("kode_provinsi");
          $qkot = $this->db->query("SELECT * FROM tbl_wilayah where kode_provinsi ='$kode_provinsi' AND kode_kecamatan = '00' AND kode_kabkot!='00'");
          if ($qkot -> num_rows()==0) {
               echo "Maaf Data Tidak Ditemukan";
          } else { ?>
               <select class="form-control  required chosen-select" name="kode_kabkot" id="kode_kabkot">
                    <option value="">Pilih Kabupaten/Kota</option>
                              <?php foreach($qkot->result() as $rkot) { ?>
                    <option value="<?=$rkot->kode_kabkot?>"> <?=$rkot->nama_lokasi?> </option>
                     <?php } ?>
               </select>
<?php
          }
     }


}


 ?>
