<?php
/**
 *
 */
class M_admin extends CI_Model
{

     public function cek_login_admin($passing_data)
     {

               $username = $passing_data['username'];
               $password = $passing_data['password'];
               $sql = ("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
               $query = $this->db->query($sql);
               $level = $query->row();

               if ($level->id_level == 1) {
                    return "admin";
               }
               elseif ($level->id_level ==3) {
                    return "guru";
               }else {
                    return false;
               }
     }

     public function jumlah(){

          $juml_siswa = $this->db->query("SELECT * FROM tbl_siswa")->num_rows();
          $juml_guru = $this->db->query("SELECT * FROM users where id_level ='3'")->num_rows();
          $juml_kelas = $this->db->query("SELECT * FROM kelas")->num_rows();
          $juml_matpel = $this->db->query("SELECT * FROM mata_pelajaran")->num_rows();

          $arr_jumlah = array('jumlah_siswa'=> $juml_siswa,
                              'jumlah_guru' => $juml_guru,
                              'jumlah_kelas' => $juml_kelas,
                              'jumlah_matpel' => $juml_matpel);

          return $arr_jumlah;

     }
}



 ?>
