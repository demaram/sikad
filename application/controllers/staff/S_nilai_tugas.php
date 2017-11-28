<?php
/**
 *
 */
class S_nilai_tugas extends CI_Controller
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

         $judul = array('judul' => 'Nilai Tugas Siswa');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);
         $id_guru = $passing_data[id_guru];

         $kumpul_matpel = $this->model_staff->ambil_kelas($id_guru);
         $data = array_merge($kumpul_matpel,$data);

         $this->load->view('staff_views/nilai_tugas/s_view_tugas',$data);

    }

    function get_siswa(){
         $id_matpel = $this->input->get('id_matpel');
         $id_kelas = $this->input->get('id_kelas');
         $id_smt = $this->input->get('smt');
         $tgl_nilai = date('Y-m-d',strtotime($this->input->get('day')));

         $gabung = array('judul' => 'Nilai Tugas Siswa',
                         'id_matpel_pilih' => $id_matpel,
                         'id_kelas_pilih' => $id_kelas,
                         'id_smt' => $id_smt,
                         'tgl_nilai'=>$tgl_nilai
                    );
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$gabung);
         if ($id_matpel !== NULL || $id_kelas !=NULL || $tgl_nilai !=NULL) {
             $this->load->view('staff_views/nilai_tugas/s_form_tugas',$data);
        }else {
             echo "<script>
             alert('Anda Tidak Bisa Melakukan Kegiatan Ini');
             window.location.href='S_nilai_harian';
             </script>";
        }


    }

    function proses_tambah()
    {

         $pesan     = sha1('pesan');
         $id_kelas  = $this->input->post('id_kelas');
         $tgl_nilai = $this->input->post('tgl_nilai');
         $id_matpel = $this->input->post('id_matpel');
         $id_smt    = $this->input->post('id_smt');


        $siswa      = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas = '$id_kelas'");
        $i = 1;
        foreach ($siswa->result() as $row) {
             $id_pd_siswa = $this->input->post('id_pd_siswa_'.$row->id_pd_siswa);
             $nilai_angka = $this->input->post('nilai_angka_'.$row->id_pd_siswa);
             $deskripsi = $this->input->post('deskripsi_'.$row->id_pd_siswa);

             $cari       = $this->db->query("SELECT * FROM nilai_tugas where tgl_nilai = '$tgl_nilai' AND id_pd_siswa='$row->id_pd_siswa' AND id_matpel='$id_matpel'");

               if ($cari->num_rows()== 1) {
                   $upd = $this->db->query("UPDATE nilai_tugas set id_matpel = '$id_matpel', id_pd_siswa = '$id_pd_siswa', tgl_nilai ='$tgl_nilai',
                                             nilai_angka = '$nilai_angka' , deskripsi = '$deskripsi'
                                             WHERE tgl_nilai = '$tgl_nilai' AND id_pd_siswa = '$id_pd_siswa' AND id_matpel='$id_matpel'");
                       if ($upd == TRUE ) {
                            $sukses_update = 1;
                       }
               }else{
                       $ins = $this->db->query("INSERT into nilai_tugas (id_matpel, id_pd_siswa, tgl_nilai, nilai_angka,deskripsi)
                                                                 VALUES('$id_matpel','$id_pd_siswa','$tgl_nilai','$nilai_angka','$deskripsi')");
                       if ($ins == TRUE) {
                            $sukses_insert=1;
                       }
               }
         }
         if ($sukses_update==1) {
              $this->session->set_flashdata('pesan_success', 'Berhasil Edit Data');
              redirect('staff/s_nilai_tugas');
         }elseif ($sukses_insert == 1) {
              $this->session->set_flashdata('pesan_success', 'Berhasil Tambah Data');
              redirect('staff/s_nilai_tugas');
         }else {
              $this->session->set_flashdata('pesan_error', 'Anda Gagal Melakukan Kegiatan Ini');
              redirect('staff/s_nilai_tugas');
         }
    }





}// END class


 ?>
