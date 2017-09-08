<?php

class Rapor_siswa extends CI_Controller
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

         $judul = array('judul' => 'Rekap Rapor Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/rapor_siswa/view_rapor',$data);
     }

     function get_siswa()
     {
          $judul = array('judul' => 'Rapor Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/rapor_siswa/form_rapor',$data);
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

    function proses_nilai()
    {
         $pesan               = sha1('pesan');
         $id_matpel  = $this->input->post('id_matpel');
         $id_pd_siswa  = $this->input->post('id_pd_siswa');
         $nilai_rapor = $this->input->post('nilai_rapor');
         $nilai_terbilang = $this->input->post('nilai_terbilang');
         $deskripsi = $this->input->post('deskripsi');

         $cek_eksis = $this->db->query("SELECT * FROM rapor_siswa where id_matpel='$id_matpel' AND id_pd_siswa='$id_pd_siswa'");
         $count = $cek_eksis->num_rows();

         if ($count == 1) {
              $query = $this->db->query("UPDATE rapor_siswa set nilai_rapor = '$nilai_rapor', nilai_terbilang ='$nilai_terbilang',deskripsi ='$deskripsi'  where id_matpel='$id_matpel' AND id_pd_siswa='$id_pd_siswa'");
              if ($query) {
                   redirect('admin/rapor_siswa?'.$pesan.'=edit_sukses');
              }else {
                   redirect('admin/rapor_siswa?'.$pesan.'=edit_gagal');
              }
         }else {
              $query = $this->db->query("INSERT INTO rapor_siswa (nilai_rapor, nilai_terbilang, deskripsi, id_pd_siswa, id_matpel) values('$nilai_rapor','$nilai_terbilang','$deskripsi','$id_pd_siswa','$id_matpel')");
              if ($query) {
                   redirect('admin/rapor_siswa?'.$pesan.'=add_sukses');
              }else {
                   redirect('admin/rapor_siswa?'.$pesan.'=add_gagal');
              }
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

     function ajax_siswa(){
          $id_kelas = $this->input->post('id_kelas');
          $smt = $this->db->query("SELECT * FROM master_data_semester where status_active = '1'");
          $smt = $smt->row();

          $id_smt = $smt->id_smt;

          $query = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas='$id_kelas' AND id_smt='$id_smt'");
          if ($query->num_rows()==0) {
               echo "Maaf Data Tidak Ditemukan";
          } else { ?>
               <select class="form-control  required chosen-select" name="id_siswa" id="id_siswa">
                    <option value="">Pilih Siswa</option>
                              <?php foreach($query->result() as $row) {
                                   $siswa = $this->db->query("SELECT * FROM tbl_siswa where id_siswa= '$row->id_siswa'");
                                   foreach ($siswa->result() as $siswa) {}

                                   ?>
                    <option value="<?=$row->id_siswa?>"> <?=$siswa->nm_siswa?> </option>
                     <?php } ?>
               </select>
<?php
          }
     }


}


 ?>
