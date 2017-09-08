<?php

class Data_siswa extends CI_Controller
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

         $judul = array('judul' => 'Data Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/data_siswa/view_siswa',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Data Siswa');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/data_siswa/form_data_siswa',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Data Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/data_siswa/form_data_siswa',$data);

    }

    function proses_tambah()
    {
/*upload foto*/

$photo   = $_FILES['photo']['name'];
$nama_photo = rand(0,99).$photo;

$config['upload_path'] = './assets/foto/';
$config['allowed_types'] = 'gif|jpg|png|jpeg';
$config['max_size']     = '2000';
$config['max_width'] = '1300';
$config['max_height'] = '768';
$config['file_name'] = $nama_photo;
$this->load->library('upload', $config);
$this->upload->do_upload('photo');

         $pesan               = sha1('pesan');
         $nm_siswa            = $this->input->post('nm_siswa');
         $nisn                = $this->input->post('nisn');
         $username            = $this->input->post('username');


         $enc_password        = $this->input->post('re_password');
         $password            = md5($enc_password);

         $jk                  = $this->input->post('jk');
         $tmpt_lahir          = $this->input->post('tmpt_lahir');
         $tgl_lahir           = date('Y-m-d',strtotime($this->input->post('tgl_lahir')));
         $id_agama            = $this->input->post('id_agama');
         $kode_provinsi       = $this->input->post('kode_provinsi');
         $kode_kabkot         = $this->input->post('kode_kabkot');
         $alamat              = $this->input->post('alamat');
         $kode_pos            = $this->input->post('kode_pos');
         $no_hp               = $this->input->post('no_hp');
         $email               = $this->input->post('email');
         $id_kelas            = $this->input->post('id_kelas');

         $nm_ayah             = $this->input->post('nm_ayah');
         $tgl_lahir_ayah      = date('Y-m-d',strtotime($this->input->post('tgl_lahir_ayah')));
         $id_pendidikan_ayah  = $this->input->post('id_pendidikan_ayah');
         $id_pekerjaan_ayah   = $this->input->post('id_pekerjaan_ayah');
         $id_penghasilan_ayah = $this->input->post('id_penghasilan_ayah');

         $nm_ibu              = $this->input->post('nm_ibu');
         $tgl_lahir_ibu       = date('Y-m-d',strtotime($this->input->post('tgl_lahir_ibu')));
         $id_pendidikan_ibu   = $this->input->post('id_pendidikan_ibu');
         $id_pekerjaan_ibu    = $this->input->post('id_pekerjaan_ibu');
         $id_penghasilan_ibu  = $this->input->post('id_penghasilan_ibu');


         $ins                 = $this->db->query("INSERT into tbl_siswa
                                         (nm_siswa,id_kelas,nisn,username, photo, password,jk,tmpt_lahir,tgl_lahir,id_agama,kode_provinsi,kode_kabkot,alamat,kode_pos,no_hp,email,nm_ayah,tgl_lahir_ayah,id_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah,nm_ibu,tgl_lahir_ibu,id_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu)
                                  Values ('$nm_siswa','$id_kelas','$nisn','$username','$nama_photo','$password','$jk','$tmpt_lahir','$tgl_lahir','$id_agama','$kode_provinsi','$kode_kabkot','$alamat','$kode_pos','$no_hp','$email','$nm_ayah','$tgl_lahir_ayah','$id_pendidikan_ayah','$id_pekerjaan_ayah','$id_penghasilan_ayah',
                                       '$nm_ibu','$tgl_lahir_ibu','$id_pendidikan_ibu','$id_pekerjaan_ibu','$id_penghasilan_ibu')");
         if ($ins) {
              redirect('admin/data_siswa?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/data_siswa?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
          $pesan               = sha1('pesan');

          $photo   = $_FILES['photo']['name'];
          if (!empty($photo)) {
               $nama_photo = rand(0,99).$photo;
               $config['upload_path'] = './assets/foto/';
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['max_size']     = '2000';
               $config['max_width'] = '1300';
               $config['max_height'] = '768';
               $config['file_name'] = $nama_photo;
               $this->load->library('upload', $config);
               $upload = $this->upload->do_upload('photo');

               if (!$upload) {
                   $error = array('error_upload' =>$this->upload->display_errors());
                   $this->session->set_flashdata('error',$error);
                    redirect('admin/data_siswa?'.$pesan.'=upload_gagal');
               }

          }else {
               $nama_photo = $this->input->post('photo_asli');
          }



         $id                  = $this->input->post('id');
         $nm_siswa            = $this->input->post('nm_siswa');
         $nisn                = $this->input->post('nisn');
         $username            = $this->input->post('username');
         $jk                  = $this->input->post('jk');
         $tmpt_lahir          = $this->input->post('tmpt_lahir');
         $tgl_lahir           = date('Y-m-d',strtotime($this->input->post('tgl_lahir')));
         $id_agama            = $this->input->post('id_agama');
         $kode_provinsi       = $this->input->post('kode_provinsi');
         $kode_kabkot         = $this->input->post('kode_kabkot');
         $alamat              = $this->input->post('alamat');
         $kode_pos            = $this->input->post('kode_pos');
         $no_hp               = $this->input->post('no_hp');
         $email               = $this->input->post('email');
         $id_kelas            = $this->input->post('id_kelas');

         $nm_ayah             = $this->input->post('nm_ayah');
         $tgl_lahir_ayah      = date('Y-m-d',strtotime($this->input->post('tgl_lahir_ayah')));
         $id_pendidikan_ayah  = $this->input->post('id_pendidikan_ayah');
         $id_pekerjaan_ayah   = $this->input->post('id_pekerjaan_ayah');
         $id_penghasilan_ayah = $this->input->post('id_penghasilan_ayah');

         $nm_ibu              = $this->input->post('nm_ibu');
         $tgl_lahir_ibu       = date('Y-m-d',strtotime($this->input->post('tgl_lahir_ibu')));
         $id_pendidikan_ibu   = $this->input->post('id_pendidikan_ibu');
         $id_pekerjaan_ibu    = $this->input->post('id_pekerjaan_ibu');
         $id_penghasilan_ibu = $this->input->post('id_penghasilan_ibu');


         $edit = $this->db->query("UPDATE tbl_siswa set
               nm_siswa            = '$nm_siswa',
               nisn                = '$nisn',
               username            = '$username',
               photo               = '$nama_photo',
               jk                  = '$jk',
               tmpt_lahir          = '$tmpt_lahir',
               tgl_lahir           = '$tgl_lahir',
               id_agama            = '$id_agama',
               kode_provinsi       = '$kode_provinsi',
               kode_kabkot         = '$kode_kabkot',
               alamat              = '$alamat',
               kode_pos            = '$kode_pos',
               no_hp               = '$no_hp',
               email               = '$email',
               id_kelas            = '$id_kelas',

               nm_ayah             = '$nm_ayah',
               tgl_lahir_ayah      = '$tgl_lahir_ayah',
               id_pendidikan_ayah  = '$id_pendidikan_ayah',
               id_pekerjaan_ayah   = '$id_pekerjaan_ayah',
               id_penghasilan_ayah = '$id_penghasilan_ayah',

               nm_ibu              = '$nm_ibu',
               tgl_lahir_ibu       = '$tgl_lahir_ibu',
               id_pendidikan_ibu   = '$id_pendidikan_ibu',
               id_pekerjaan_ibu    = '$id_pekerjaan_ibu',
               id_penghasilan_ibu  = '$id_penghasilan_ibu'
               WHERE id_siswa      = '$id'
         ");
         if ($edit) {
              redirect('admin/data_siswa?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/data_siswa?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM tbl_siswa where id_siswa = '$id'");
         if ($del) {
              redirect('admin/data_siswa?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/data_siswa?'.$pesan.'=hapus_gagal');
         }
     }

     function ajax_kabkot()
     {
          $kode_provinsi = $this->input->post("kode_provinsi");
          $qkot = $this->db->query("SELECT * FROM tbl_wilayah where kode_provinsi ='$kode_provinsi' AND kode_kecamatan = '00' AND kode_kabkot!='00'");
          if ($qkot->num_rows()==0) {
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

     function lihat_data()
     {

         $judul = array('judul' => 'Biodata Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/data_siswa/view_data_persiswa',$data);
     }


     function ganti_password()
     {

         $judul = array('judul' => 'Ganti Password Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/data_siswa/form_ganti_password',$data);
     }

     function ajax_password()
     {
          $old_pass = md5($this->input->post("old_pass"));
          $id_siswa = $this->input->post("id_siswa");

          $query =$this->db->query("SELECT * FROM tbl_siswa where id_siswa ='$id_siswa' AND password='$old_pass'");
          if ($query->num_rows() == 1) {
               echo "<span class='label label-success'>Password Lama Match</span>";
          }else {
               echo "<span id='match' class='label label-danger'>Password Lama Tidak Match</span>";
          }

     }

     function proses_password()
     {
          $old_pass = md5($this->input->post("old_pass"));
          $id_siswa = $this->input->post("id_siswa");
          $password = md5($this->input->post("password"));

          $edit =$this->db->query("UPDATE tbl_siswa SET password ='$password' where id_siswa='$id_siswa'");
          if ($edit) {
              redirect('admin/data_siswa?'.$pesan.'=edit_sukses');
              }else {
                   redirect('admin/data_siswa?'.$pesan.'=edit_gagal');
              }
     }

     function lihat_histori()
     {

         $judul = array('judul' => 'Histori Pendidikan Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/data_siswa/view_histori',$data);
     }

     function tambah_histori(){
         $judul = array('judul' => 'Tambah Pendidikan Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/data_siswa/form_histori',$data);

     }

     function edit_histori(){
         $judul = array('judul' => 'Edit Pendidikan Siswa');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/data_siswa/form_histori',$data);

     }
     function proses_form()
     {
           $pesan = sha1('pesan');
          $id_pd_siswa = $this->input->post('id_pd_siswa');
          $id_siswa = $this->input->post("id_siswa");
          $id_kelas = $this->input->post("id_kelas");
          $id_smt = $this->input->post("id_smt");
          $jns_daftar = $this->input->post("jns_daftar");
          $tgl_daftar = date('Y-m-d',strtotime($this->input->post("tgl_daftar")));

          $act = $this->input->get('act');

          switch ($act) {
               case 'add':
                         $cek_smt = $this->db->query("SELECT * FROM tbl_pd_siswa where id_siswa = '$id_siswa' AND id_smt = '$id_smt'");
                         $count = $cek_smt->num_rows();

                         if ($count >= 1) {
                              redirect('admin/data_siswa/lihat_histori?id='.$id_siswa.'&'.$pesan.'=add_gagal_id');
                         }
                         echo $count;

                         $ins = $this->db->query("INSERT into tbl_pd_siswa (id_siswa , id_kelas, id_smt , jns_daftar, tgl_daftar) values ('$id_siswa','$id_kelas','$id_smt','$jns_daftar','$tgl_daftar')");
                         if ($ins) {
                              redirect('admin/data_siswa/lihat_histori?id='.$id_siswa.'&'.$pesan.'=add_sukses');
                         }else {
                              redirect('admin/data_siswa/lihat_histori?id='.$id_siswa.'&'.$pesan.'=add_gagal');
                         }
                    break;

               case 'edit':
                         $upd = $this->db->query("UPDATE tbl_pd_siswa set
                              id_siswa = '$id_siswa', id_kelas = '$id_kelas', id_smt = '$id_smt', jns_daftar = '$jns_daftar', tgl_daftar = '$tgl_daftar'
                              where id_pd_siswa = '$id_pd_siswa'
                         ");
                         if ($upd) {
                              redirect('admin/data_siswa/lihat_histori?id='.$id_siswa.'&'.$pesan.'=edit_sukses');
                         }else {
                              redirect('admin/data_siswa/lihat_histori?id='.$id_siswa.'&'.$pesan.'=edit_gagal');
                         }
                    break;
          }
     }
     function hapus_histori()
    {
        $pesan = sha1('pesan');
        $id = $this->input->get('id');
        $id_siswa = $this->input->get('conid');

        $del = $this->db->query("DELETE FROM tbl_pd_siswa where id_pd_siswa = '$id'");
        if ($del) {
            redirect('admin/data_siswa/lihat_histori?id='.$id_siswa.'&'.$pesan.'=hapus_sukses');
        }else {
            redirect('admin/data_siswa/lihat_histori?id='.$id_siswa.'&'.$pesan.'=hapus_gagal   ');
        }
    }



}


 ?>
