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
                    $data_kelas = $this->db->query("SELECT * FROM kelas");




                ?>

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
                              <div class="panel panel-headline">
                                   <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><?=$judul?></h3>
                                            <div class="right">


                                                  <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                            </div>
                                        </div>

                                        <div class="panel-body no-padding">
                                           <form class="form-horizontal" action="" role="form" method="post" enctype="multipart/form-data" id="form_cari">

                                                <div class="form-group">
                                                 <label class="col-lg-2 control-label" for="required">Pilih Semester</label>
                                                      <div class="col-lg-4">
                                                           <select name="id_smt" class="form-control" id="id_smt">
                                                                <option value="0">-- Pilih Semester --</option>
                                                                  <?php
                                                                       $qsmt_now = $this->db->query("SELECT * FROM master_data_semester where status_active ='1'");
                                                                       $smt_now = $qsmt_now->row()->id_smt;

                                                                         if (!empty($this->input->post('id_smt'))) {
                                                                             $id_smt = $this->input->post('id_smt');
                                                                        }else {
                                                                             $id_smt = $smt_now;
                                                                        }

                                                                         $qsmt = $this->db->query("SELECT * FROM master_data_semester WHERE 1=1");
                                                                         foreach ($qsmt->result() as $rsmt) { ?>
                                                                              <option <?php if ($id_smt == $rsmt->id_smt): ?>
                                                                                   selected="selected"
                                                                              <?php endif; ?> value="<?=$rsmt->id_smt?>"> <?=$rsmt->nama_smt?> </option>
                                                                         <?php }
                                                                  ?>
                                                           </select>
                                                 </div><div class="fix"></div>
                                              </div>




                                              <div class="form-group">
                                                <div class="col-md-offset-1">
                                                   <button type="submit" id="submit" class="btn btn-default marginR10">set</button>
                                                </div>
                                              </div><!-- End .form-group  -->

                                           </form>

                                        </div>

                                   </div>
     					</div>
<?php if (!empty($id_smt)): ?>
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h3 class="panel-title"><?=$judul?></h3>
                                       <div class="right">
                                            <?php
                                                  $nama_controller = 'absen_siswa';

                                             ?>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                       <table class="table table-striped data_table">
                                             <thead>
                                                  <tr>
                                                       <th>No</th>
                                                       <th>Kelas</th>
                                                       <th>Absensi</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $no = 1;
                                                  foreach ($data_kelas->result() as $row): ?>
                                                  <tr>
                                                       <td><?=$no?></td>
                                                       <td><?=$row->nama_kelas?></td>

                                                       <td>
                                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/lihat_data?id=<?=$row->id_kelas?>&s=<?=$id_smt?>" class="btn btn-primary">Lihat Absensi</a>
                                                       </td>
                                                  </tr>
                                                  <?php $no++; endforeach; ?>
                                             </tbody>
                                       </table>
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
	<!-- END WRAPPER --><?php endif; ?>

     <?php
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
