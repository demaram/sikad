<?php
$this->load->view('admin_views/_template/head');
 ?>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
          <?php
               $this->load->view('admin_views/_template/sidebar');
           ?>
		<!-- END SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- NAVBAR -->
               <?php
                    $this->load->view('admin_views/_template/navbar');
                ?>
			<!-- END NAVBAR -->
               <?php
                    $kelas = $this->db->query("SELECT nama_kelas from kelas where id_kelas ='$id_kelas'");
                    foreach ($kelas->result() as $kls) {

                    }
                    $siswa = $this->db->query("SELECT nisn from tbl_siswa where id_siswa ='$id_siswa'");
                    foreach ($siswa->result() as $siswa) {

                    }

                    $smt = $this->db->query("SELECT nama_smt from master_data_semester where id_smt ='$id_smt'");
                    foreach ($smt->result() as $smt) {

                    }


                    $qmtpel = $this->db->query("SELECT id_matpel_senin as id_matpel from kelas_matpel where id_kelas ='$id_kelas'
                    UNION select id_matpel_selasa from kelas_matpel where id_kelas ='$id_kelas'
                    UNION select id_matpel_rabu from kelas_matpel where id_kelas ='$id_kelas'
                    UNION select id_matpel_kamis from kelas_matpel where id_kelas ='$id_kelas'
                    UNION select id_matpel_jumat from kelas_matpel where id_kelas ='$id_kelas'
                    UNION select id_matpel_sabtu from kelas_matpel where id_kelas ='$id_kelas'");

                    foreach ($qmtpel->result() as $rmtpel) {
                         $id_matpel[] = $rmtpel->id_matpel;

                    }
                    $imp_idmt = implode(',',$id_matpel);


                ?>
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
				<!-- OVERVIEW -->

                         <div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h1 style="text-align:center;"><?=$judul?></h1><br><br>
                                        <table>
                                             <tr>
                                                  <td>Nama Siswa</td> <td style="padding-right:20px;padding-left:10px;">:</td><td><?=$nm_siswa?></td>
                                             </tr>
                                             <tr>
                                                  <td>Kelas</td> <td style="padding-right:20px;padding-left:10px;">:</td><td><?=$kls->nama_kelas?></td>
                                             </tr>
                                             <tr>
                                                  <td>Nomor Induk</td> <td style="padding-right:20px;padding-left:10px;">:</td><td><?=$siswa->nisn?></td>
                                             </tr>
                                             <tr>
                                                  <td>Semester</td> <td style="padding-right:20px;padding-left:10px;">:</td><td><?=$smt->nama_smt?></td>
                                             </tr>
                                        </table>


                                       <div class="right">
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <table class="table table-inverse">
                                              <thead style="background-color:rgb(223, 227, 228)">
                                                   <tr>
                                                        <th rowspan="2" style="text-align:center; width:5%">No</th>
                                                        <th rowspan="2" style="text-align:center; width:25%">Mata Pelajaran</th>
                                                        <th rowspan="2" style="text-align:center">KKM</th>
                                                        <th colspan="2" style="text-align:center;margin-left:-5px">Nilai</th>
                                                        <th rowspan="2" style="text-align:center">Catatan Guru</th>
                                                   </tr>
                                                   <tr>
                                                         <th style="text-align:center;width:5%">Angka</th>
                                                         <th style="text-align:center;width:25%">Huruf</th>
                                                   </tr>
                                              </thead>
                                              <tbody>
                                                   <?php
                                                   $q_pd_siswa = $this->db->query("SELECT * FROM tbl_pd_siswa where id_kelas='$id_kelas' AND id_smt='$id_smt' AND id_siswa='$id_siswa'");
                                                   foreach($q_pd_siswa->result() as $r_pd_siswa) {}
                                                   $no = 1;
                                                   $data = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel in($imp_idmt)");
                                                   foreach ($data->result() as $row):
                                                       $rapor = $this->db->query("SELECT * FROM rapor_siswa where id_matpel = '$row->id_matpel' AND id_pd_siswa ='$id_pd_siswa'");
                                                       foreach ($rapor->result() as $rapor) {}
                                                        ?>
                                                   <tr>
                                                        <td style="text-align:center"><?=$no?></td>
                                                        <td style="text-align:center"><?=$row->nama_matpel?></td>
                                                        <td style="text-align:center"><?=$row->nilai_kkm?></td>
                                                        <td style="text-align:center"><?=$rapor->nilai_rapor?></td>
                                                        <td style="text-align:center"><?=$rapor->nilai_terbilang?></td>
                                                        <td style="text-align:center"><?=$rapor->deskripsi?></td>
                                                   </tr>
                                                   <?php $no++; endforeach; ?>
                                              </tbody>
                                        </table>
                                   </div>

                              </div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->

     <?php
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
