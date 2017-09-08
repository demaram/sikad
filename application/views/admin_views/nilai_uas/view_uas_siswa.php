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


			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                         <?php

                         $pesan = sha1('pesan');
                         $pesan=$_GET[$pesan];
               			switch ($pesan) {
 //                  alert tambah
               				case 'add_sukses':
               				?>
                                   <div class="alert alert-success">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <strong>Success!</strong> Berhasil Tambah Data
                                           </div>
               				<?php
               				break;
               				case 'add_gagal':
               				?>
                                  <div class="alert alert-danger">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <strong>Failed!</strong>Gagal Tambah Data
                                           </div>
               				<?php
               				break;
//                  alert edit
                                   case 'edit_sukses':
                                   ?>
                                   <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Success!</strong>Sukses Edit Data
                                            </div>
                                   <?php
                                   break;

                                   case 'edit_gagal':
                                   ?>
                                   <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Failed!</strong>Gagal Edit Data
                                           </div>
                                   <?php
                                   break;
//                  alert hapus
                                   case 'hapus_sukses':
                                   ?>
                                   <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Success!</strong>Sukses Hapus Data
                                            </div>
                                   <?php
                                   break;

                                   case 'hapus_gagal':
                                   ?>
                                   <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Failed!</strong>Gagal Hapus Data
                                           </div>
                                   <?php
                                   break;
               			}
                              ?>

					<!-- OVERVIEW -->
					<div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h3 class="panel-title"><?=$judul?></h3>
                                       <div class="right">
                                            <?php
                                                 $id_kelas = $this->input->get('id_kelas');
                                                 $id_matpel = $this->input->get('id_matpel');
                                                 $id_smt = $this->input->get('smt');
                                                  $nama_controller = 'nilai_harian';
                                                  $matpel  = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$id_matpel'");
                                                  foreach ($matpel->result() as $matpel){}

                                                  $kelas  = $this->db->query("SELECT * FROM kelas where id_kelas = '$id_kelas'");
                                                  foreach ($kelas->result() as $kelas){}

                                                  $smt  = $this->db->query("SELECT * FROM master_data_semester where id_smt = '$id_smt'");
                                                  foreach ($smt->result() as $smt){}
                                             ?>
                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/tambah_data?id_matpel=<?=$id_matpel?>&id_kelas=<?=$id_kelas?>&smt=<?=$id_smt?>"><i class="fa fa-plus fa-2x"></i></a>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="alert alert-info alert-dismissible" role="alert">
                                        <table>
                                                  <h3>Data Nilai Siswa</h3>
                                                  <tr>
                                                       <td><b>Kelas </b> </td> <td> : </td> <td style="padding-left:10px;"><?=$kelas->nama_kelas?></td>
                                                  </tr>
                                                  <tr>
                                                       <td> <b>Mata Pelajaran</b></td> <td> : </td> <td style="padding-left:10px;"><?=$matpel->nama_matpel?></td>
                                                  </tr>
                                                  <tr>
                                                      <td> <b>Semester</b></td> <td> : </td> <td style="padding-left:10px;"><?=$smt->nama_smt?></td>
                                                  </tr>

                                        </table>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <form class="form-horizontal" action="<?=base_url()?>admin/nilai_uas/proses_tambah" role="form" method="post" enctype="multipart/form-data">
                                              <input type="text" name="id_matpel" hidden value="<?=$matpel->id_matpel?>">
                                              <input type="text" name="id_kelas" hidden value="<?=$id_kelas?>">
                                              <input type="text" name="smt" hidden value="<?=$id_smt?>">
                                            <table class="table table-striped data_table">
                                                  <thead>
                                                       <tr>
                                                            <th>No</th>
                                                            <th>Nama Siswa</th>
                                                            <th>Mata Pelajaran</th>
                                                            <th>Nilai UAS</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php


                                                       $data = $this->db->query("SELECT * FROM tbl_pd_siswa where id_smt='$id_smt' AND id_kelas='$id_kelas'");
                                                       $hitung = $data->num_rows();
                                                       $no = 1;
                                                       $i =1;
                                                       foreach ($data->result() as $row): // diambil dari data

                                                            $siswa = $this->db->query("SELECT * FROM tbl_siswa where id_siswa = '$row->id_siswa'");
                                                            foreach($siswa->result() as $siswa){}

                                                            $nilai = $this->db->query("SELECT nilai_uas_angka from nilai_uas where id_pd_siswa ='$row->id_pd_siswa' AND id_matpel ='$id_matpel'");
                                                            foreach ($nilai->result() as $nilai ) {

                                                            }

                                                            ?>
                                                       <tr>
                                                            <td><?=$no?></td>
                                                            <td><?=$siswa->nm_siswa?></td>
                                                            <input type="text" name="id_pd_siswa_<?=$row->id_pd_siswa?>" hidden value="<?=$row->id_pd_siswa?>">

                                                            <td><?=$matpel->nama_matpel?></td>



                                                            <td><input maxlength="3" name="nilai_uas_angka_<?=$row->id_pd_siswa?>" class="form-control required" id="nilai_uas_angka" type="text"  value="<?=$nilai->nilai_uas_angka;?>" style="width:40%"> </td>

                                                       </tr>
                                                       <?php $no++; $i++; endforeach; ?>
                                                  </tbody>
                                            </table>
                                            <br>
                                            <div class="col-md-1">
                                                <?php if ($hitung  >=1) :?><button type="submit" class="btn btn-primary marginR10">Proses</button> <?php endif ?>
                                            </div>
                                       </form>
                                   </div>

                              </div>
					</div>
					<!-- END OVERVIEW -->
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
