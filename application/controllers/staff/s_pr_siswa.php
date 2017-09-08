<?php
/**
 *
 */
class s_pr_siswa extends CI_Controller
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

   /*  function index()
     {
         $judul = array('judul' => 'PR Siswa');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);

         $this->load->view('staff_views/pr_siswa/s_view_pr',$data);
     }*/
     function index()
    {

         $judul = array('judul' => 'Tambah PR');
         $passing_data = $this->session->userdata('logged_guru');
         $data = array_merge($passing_data,$judul);
         $id_guru = $passing_data[id_guru];

         $kumpul_matpel = $this->model_staff->ambil_kelas($id_guru);
         $data = array_merge($kumpul_matpel,$data);
         /*echo "<pre>";
         print_r($data);
         echo "</pre>";*/
         $this->load->view('staff_views/pr_siswa/s_form_pr_siswa',$data);

    }

    function proses_tambah(){

         $id_kelas = $this->input->post('id_kelas');
         $id_smt = $this->input->post('id_smt');
         $id_matpel = $this->input->post('id_matpel');
         $detail  = $this->input->post('detail');
         $tgl_awal = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
         $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

         $ins = $this->db->query("INSERT into tbl_pr (id_kelas,id_smt, id_matpel, detail, tgl_awal, tgl_akhir)VALUES
                                                     ('$id_kelas','$id_smt','$id_matpel','$detail','$tgl_awal','$tgl_akhir')");
        if ($ins == TRUE){
             $this->session->set_flashdata('pesan_success', 'Anda Berhasil Tambah Data');
             redirect('staff/s_pr_siswa');
        }else {
             $this->session->set_flashdata('pesan_error', 'Anda Gagal Tambah Data');
             redirect('staff/s_pr_siswa');
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
