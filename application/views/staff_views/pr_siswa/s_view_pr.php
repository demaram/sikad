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
                    $imp_id_kelas = implode(',',$all_id_kelas);
                    //echo $imp_id_kelas;
                    $data = $this->db->query("SELECT * FROM tbl_pr WHERE id_smt= '$id_smt' AND id_kelas IN($imp_id_kelas)");
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

					<!-- OVERVIEW -->
					<div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h3 class="panel-title"><?=$judul?></h3>
                                       <div class="right">

                                            <a href="<?=base_url()?>staff/s_pr_siswa/tambah_data"><i class="fa fa-plus fa-2x"></i></a>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                       <table class="table table-striped data_table">
                                             <thead>
                                                  <tr>
                                                       <th>No</th>
                                                       <th style="width:10%">Periode</th>
                                                       <th style="width:10%">Kelas</th>
                                                       <th style="width:20%">Mata Pelajaran</th>
                                                       <th width="5%">Tgl Mulai</th>
                                                       <th width="5%">Tgl Dikumpulkan</th>
                                                       <th width="25%">Detail PR</th>
                                                       <th width="5%">Keterangan</th>
                                                       <th style="text-align:center ;width:26%">Aksi</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $no = 1;
                                                  foreach ($data->result() as $row):

                                                       $data_smt = $this->db->query("SELECT * FROM master_data_semester where id_smt = '$row->id_smt'");
                                                       foreach($data_smt->result() as $r_smt){}

                                                       $data_kelas = $this->db->query("SELECT * FROM kelas where id_kelas = '$row->id_kelas'");
                                                       foreach($data_kelas->result() as $r_kls){}

                                                       $data_matpel = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel'");
                                                       foreach($data_matpel->result() as $r_mtp){}


                                                       ?>
                                                  <tr>
                                                       <td><?=$no?></td>
                                                       <td><?=$r_smt->nama_smt?></td>
                                                       <td><?=$r_kls->nama_kelas?></td>
                                                       <td><?=$r_mtp->nama_matpel?></td>
                                                       <td><?=date('d-M-Y',strtotime($row->tgl_awal))?></td>
                                                       <td><?=date('d-M-Y',strtotime($row->tgl_akhir))?></td>
                                                       <td><?=strtotime(date('Y-m-d')) >= strtotime($row->tgl_akhir) ? '<span class="label label-warning">Expired </span>' : '<span class="label label-primary"> Berlangsung </span>'?></td>
                                                       <td><?=$row->detail?></td>
                                                       <td style="text-align:center;display:inline-block"><a href="<?=base_url()?>/staff/S_pr_siswa/edit_data?id=<?=$row->id_pr?>" class="btn btn-success btn-xs"><span class="fa fa-edit"></span> Edit</a>
                                                            <a href="<?=base_url()?>staff/S_pr_siswa/proses_hapus?id=<?=$row->id_pr?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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
			<footer>
				<div class="container-fluid">
					<p class="copyright">&copy; 2016. Designed &amp; Crafted by <a href="https://themeineed.com">The Develovers</a></p>
				</div>
			</footer>
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->

     <?php
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
