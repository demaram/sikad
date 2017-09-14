<?php
/**
 *
 */
class S_rapor_siswa extends CI_Controller
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

         $judul = array('judul' => 'Rapor Siswa');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);
         $this->load->view('staff_views/rapor_siswa/s_view_rapor',$data);

    }

    function get_siswa()
    {
         $id_matpel = $this->input->get('id_matpel');
         $id_pd_siswa = $this->input->get('conid');
         $id_smt = $this->input->get('smt');

         $gabung = array('judul' => 'Nilai Tugas Siswa',
                         'id_matpel_pilih' => $id_matpel,
                         'id_pd_siswa' => $id_pd_siswa,
                         'id_smt' => $id_smt
                    );
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$gabung);

        $this->load->view('staff_views/rapor_siswa/s_form_rapor',$data);
    }

    function proses_tambah()
    {
         $pesan           = sha1('pesan');
         $id_matpel       = $this->input->post('id_matpel');
         $id_pd_siswa     = $this->input->post('id_pd_siswa');
         $nilai_rapor     = $this->input->post('nilai_rapor');
         $nilai_terbilang = $this->input->post('nilai_terbilang');
         $deskripsi       = $this->input->post('deskripsi');

         $cek_eksis = $this->db->query("SELECT * FROM rapor_siswa where id_matpel='$id_matpel' AND id_pd_siswa='$id_pd_siswa'");
         $count = $cek_eksis->num_rows();

         if ($count == 1) {
             $query = $this->db->query("UPDATE rapor_siswa set nilai_rapor = '$nilai_rapor', nilai_terbilang ='$nilai_terbilang',deskripsi ='$deskripsi'  where id_matpel='$id_matpel' AND id_pd_siswa='$id_pd_siswa'");
             if ($query) {
                  $this->session->set_flashdata('pesan_success', 'Berhasil Edit Data');
                  redirect('staff/s_rapor_siswa');
             }else {
                  $this->session->set_flashdata('pesan_error', 'Gagal Edit Data');
                  redirect('staff/s_rapor_siswa');
             }
         }else {
             $query = $this->db->query("INSERT INTO rapor_siswa (nilai_rapor, nilai_terbilang, deskripsi, id_pd_siswa, id_matpel) values('$nilai_rapor','$nilai_terbilang','$deskripsi','$id_pd_siswa','$id_matpel')");
             if ($query) {
                  $this->session->set_flashdata('pesan_success', 'Berhasil Input Data');
                 redirect('staff/s_rapor_siswa');
            }else {
                 $this->session->set_flashdata('pesan_error', 'Gagal Input Data');
                 redirect('staff/s_rapor_siswa');
             }
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
