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
                    $data = $this->db->query("SELECT * FROM berita where 1=1");
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
                                            <?php
                                                  $nama_controller = 'berita';

                                             ?>
                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/tambah_data"><i class="fa fa-plus fa-2x"></i></a>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                       <table class="table table-striped data_table">
                                             <thead>
                                                  <tr>
                                                       <th>No</th>
                                                       <th style="width:15%">Judul Berita</th>
                                                       <th>Tanggal Publish</th>
                                                       <th>Publisher</th>
                                                       <th style="width:40%">Isi</th>
                                                       <th style="text-align:center">Aksi</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $no = 1;
                                                  foreach ($data->result() as $row): ?>
                                                  <tr>
                                                       <td><?=$no?></td>
                                                       <td><?=$row->judul?></td>
                                                       <td><?=date('d M Y',strtotime($row->tanggal))?></td>
                                                       <td><?=$row->publisher?></td>
                                                       <td><?=$row->isi?></td>
                                                       <td style="text-align:center"><a href="<?=base_url()?>admin/<?=$nama_controller?>/edit_data?id=<?=$row->id_berita?>" class="btn btn-success"><span class="fa fa-edit"></span></a>
                                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/proses_hapus?id=<?=$row->id_berita?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
