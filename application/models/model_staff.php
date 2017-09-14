<?php
/**
 *
 */
class Model_staff extends CI_Model
{

     public function ambil_kelas($id_guru)
     {

          $q_kelas = $this->db->query("SELECT id_kelas FROM kelas_matpel WHERE id_guru_senin = '$id_guru'
                                        UNION SELECT id_kelas FROM kelas_matpel WHERE id_guru_selasa = '$id_guru'
                                        UNION SELECT id_kelas FROM kelas_matpel WHERE id_guru_rabu = '$id_guru'
                                        UNION SELECT id_kelas FROM kelas_matpel WHERE id_guru_kamis = '$id_guru'
                                        UNION SELECT id_kelas FROM kelas_matpel WHERE id_guru_jumat = '$id_guru'
                                        UNION SELECT id_kelas FROM kelas_matpel WHERE id_guru_sabtu = '$id_guru'

          ");
          foreach ($q_kelas->result() as $row_kelas) {
               $arr_kelas[] = $row_kelas->id_kelas;
          }
         $total_array = array('all_id_kelas' => $arr_kelas);
         return $total_array;
     }

     function ambil_matpel($id_kelas){
          $qmtpel = $this->db->query("SELECT id_matpel_senin as id_matpel from kelas_matpel where id_kelas ='$id_kelas'
               UNION select id_matpel_selasa from kelas_matpel where id_kelas ='$id_kelas'
               UNION select id_matpel_rabu from kelas_matpel where id_kelas ='$id_kelas'
               UNION select id_matpel_kamis from kelas_matpel where id_kelas ='$id_kelas'
               UNION select id_matpel_jumat from kelas_matpel where id_kelas ='$id_kelas'
               UNION select id_matpel_sabtu from kelas_matpel where id_kelas ='$id_kelas'");

               foreach ($qmtpel->result() as $rmtpel) {
                    $id_matpel[] = $rmtpel->id_matpel;
               }
          return $id_matpel;
     }
}


 ?>
