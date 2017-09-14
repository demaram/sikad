<?php

class Data_guru extends CI_Controller
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

         $judul = array('judul' => 'Data Guru');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/data_guru/view_guru',$data);
     }

     function edit_data()
     {


          $judul = array('judul' => 'Edit Data Guru');
          $passing_data = $this->session->userdata('logged_in');
          $data = array_merge($passing_data,$judul);

          $this->load->view('admin_views/data_guru/form_data_guru',$data);

     }

     function tambah_data()
    {

         $judul = array('judul' => 'Tambah Data Guru');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);
         $this->load->view('admin_views/data_guru/form_data_guru',$data);

    }

    function proses_tambah()
    {
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

         $id_level            = '3';
         $pesan               = sha1('pesan');
         $gelar                 = $this->input->post('gelar');
         $nama                = $this->input->post('nama');
         $nip                 = $this->input->post('nip');
         $nik                 = $this->input->post('nik');
         $username            = $this->input->post('username');
         $id_pendidikan       = $this->input->post('id_pendidikan');
         $kode_negara         = $this->input->post('kode_negara');

         $enc_password        = $this->input->post('re_password');
         $password            = md5($enc_password);

         $jk                  = $this->input->post('jk');
         $tmpt_lahir          = $this->input->post('tmpt_lahir');
         $tgl_lahir           = date('Y-m-d',strtotime($this->input->post('tgl_lahir')));
         $id_agama            = $this->input->post('id_agama');
         $kode_provinsi       = $this->input->post('kode_provinsi');
         $kode_kabkot         = $this->input->post('kode_kabkot');
         $kode_negara         = $this->input->post('kode_negara');
         $alamat              = $this->input->post('alamat');
         $kode_pos            = $this->input->post('kode_pos');
         $no_hp               = $this->input->post('no_hp');
         $email               = $this->input->post('email');



         $ins                 = $this->db->query("INSERT into users
                (nama,nik,nip,gelar,id_pendidikan,photo,kode_negara,username,password,jk,tmpt_lahir,tgl_lahir,id_agama,kode_provinsi,kode_kabkot,alamat,kode_pos,no_hp,email,id_level)
         Values ('$nama','$nik','$nip','$gelar','$id_pendidikan','$photo','$kode_negara','$username','$password','$jk','$tmpt_lahir','$tgl_lahir','$id_agama','$kode_provinsi','$kode_kabkot','$alamat','$kode_pos','$no_hp','$email',
                 '$id_level')");
         if ($ins) {
              redirect('admin/data_guru?'.$pesan.'=add_sukses');
         }else {
              redirect('admin/data_guru?'.$pesan.'=add_gagal');
         }
     }

     function proses_edit()
     {
          $pesan         = sha1('pesan');
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
                    redirect('admin/data_guru?'.$pesan.'=upload_gagal');
               }
          }else {
               $nama_photo = $this->input->post('photo_asli');
          }
         $id_level      = '3';

         $id            = $this->input->post('id');
         $nama          = $this->input->post('nama');
         $nik           = $this->input->post('nik');
         $gelar         = $this->input->post('gelar');
         $nip           = $this->input->post('nip');
         $username      = $this->input->post('username');
         $jk            = $this->input->post('jk');
         $id_pendidikan = $this->input->post('id_pendidikan');
         $kode_negara   = $this->input->post('kode_negara');

         $tmpt_lahir          = $this->input->post('tmpt_lahir');
         $tgl_lahir           = date('Y-m-d',strtotime($this->input->post('tgl_lahir')));
         $id_agama            = $this->input->post('id_agama');
         $kode_provinsi       = $this->input->post('kode_provinsi');
         $kode_kabkot         = $this->input->post('kode_kabkot');
         $alamat              = $this->input->post('alamat');
         $kode_pos            = $this->input->post('kode_pos');
         $no_hp               = $this->input->post('no_hp');
         $email               = $this->input->post('email');

         $edit = $this->db->query("UPDATE users set
               nama            = '$nama',
               nik                = '$nik',
               kode_negara         = '$kode_negara',
               id_pendidikan       = '$id_pendidikan',
               nip                 = '$nip',
               photo               = '$nama_photo',
               gelar               = '$gelar',
               username            = '$username',
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
               id_level            ='3'
               WHERE id_user      = '$id'
         ");
         if ($edit) {
              redirect('admin/data_guru?'.$pesan.'=edit_sukses');
         }else {
              redirect('admin/data_guru?'.$pesan.'=edit_gagal');
         }
     }

     function proses_hapus()
     {
         $pesan = sha1('pesan');
         $id = $this->input->get('id');

         $del = $this->db->query("DELETE FROM users where id_user = '$id'");
         if ($del) {
              redirect('admin/data_guru?'.$pesan.'=hapus_sukses');
         }else {
              redirect('admin/data_guru?'.$pesan.'=hapus_gagal');
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

     function lihat_data()
     {

         $judul = array('judul' => 'Lihat Data Guru');
         $passing_data = $this->session->userdata('logged_in');
         $data = array_merge($passing_data,$judul);

         $this->load->view('admin_views/data_guru/view_data_perguru',$data);
     }

}


 ?>
