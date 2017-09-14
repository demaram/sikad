<?php
/**
 *
 */
class S_absen_siswa extends CI_Controller
{

     function __construct()
     {

          parent::__construct();
          error_reporting(E_ALL & ~E_NOTICE);
          $this->load->model('model_staff');
          if(! $this->session->userdata('logged_guru')){
               echo "<script>
               alert('Anda Belum Punya Akses, Silahkan Login Terlebih Dahulu');
               window.location.href='../admin/login';
               </script>";
		}
     }

     function index()
    {

         $judul = array('judul' => 'Absensi Siswa');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);

         $this->load->view('staff_views/absen_siswa/s_view_absen',$data);

    }

    function proses_tambah()
    {

         $pesan     = sha1('pesan');
         $id_kelas  = $this->input->post('id_kelas');
         $tgl_absen = date('Y-m-d',strtotime($this->input->post('tgl_absen')));
         $id_smt    = $this->input->post('id_smt');

        $siswa      = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas = '$id_kelas'");
        $jumlah     = $siswa->num_rows();

        $cari       = $this->db->query("SELECT * FROM tbl_absen_siswa where tgl_absen = '$tgl_absen' AND id_pd_siswa=''");
        $count      = $cari->num_rows();
        $i = 1;
        foreach ($siswa->result() as $row) {
             $id_pd_siswa = $this->input->post('id_pd_siswa_'.$row->id_pd_siswa);
             $id_jenis_absen = $this->input->post('id_jenis_absen_'.$i);
             $cari       = $this->db->query("SELECT * FROM tbl_absen_siswa where tgl_absen = '$tgl_absen' AND id_pd_siswa='$row->id_pd_siswa'");

               if ($cari->num_rows()== 1) {
                   $upd = $this->db->query("UPDATE tbl_absen_siswa set id_kelas = '$id_kelas', id_pd_siswa = '$id_pd_siswa', tgl_absen ='$tgl_absen', id_jenis_absen = '$id_jenis_absen' WHERE tgl_absen = '$tgl_absen' AND id_pd_siswa = '$id_pd_siswa'");
                       if ($upd == TRUE ) {
                            $sukses_update = 1;
                       }
               }else{
                       $ins = $this->db->query("INSERT into tbl_absen_siswa (id_kelas, id_pd_siswa, tgl_absen, id_jenis_absen)     VALUES('$id_kelas','$id_pd_siswa','$tgl_absen','$id_jenis_absen')");
                       if ($ins == TRUE) {
                            $sukses_insert=1;
                       }
               }
               $i++;
         }
         if ($sukses_update==1) {
              $this->session->set_flashdata('pesan_success', 'Berhasil Edit Data');
              redirect('staff/s_absen_siswa');
         }elseif ($sukses_insert == 1) {
              $this->session->set_flashdata('pesan_success', 'Berhasil Tambah Data');
              redirect('staff/s_absen_siswa');
         }else {
              $this->session->set_flashdata('pesan_error', 'Anda Gagal Melakukan Kegiatan Ini');
              redirect('staff/s_absen_siswa');
         }
    }
    function ajax_matpel(){

         $id_kelas = $this->input->post('id_kelas');
         $kelas = $this->db->query("SELECT * FROM kelas where id_kelas ='$id_kelas'");
         foreach ($kelas->result() as $kelas) {}

         $fil_id_matpel = $this->model_staff->ambil_matpel($id_kelas);
         $imp_id_matpel = implode(',',$fil_id_matpel);
         $qmtpel = $this->db->query("SELECT * FROM mata_pelajaran WHERE id_matpel IN($imp_id_matpel)");
         if ($qmtpel->num_rows()==0) {
              echo "Maaf Data Tidak Ditemukan";
         } else { ?>
              <select class="form-control  required chosen-select" name="kode_kabkot" id="kode_kabkot">
                   <option value="">-- Pilih Mata Pelajaran Dari Kelas <?=$kelas->nama_kelas?> --</option>
                             <?php foreach($qmtpel->result() as $mtpel) { ?>
                   <option value="<?=$mtpel->id_matpel?>"> <?=$mtpel->nama_matpel?> </option>
                    <?php } ?>
              </select>
<?php
         }
    }




}// END class


 ?>
