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
                    $id = $this->input->get('id');

                    $data_kelas = $this->db->query("SELECT * FROM kelas where id_kelas = '$id'");

                    foreach ($data_kelas->result() as $r1kls){}
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
                                       <h3 class="panel-title"><?=$judul.' '.$r1kls->nama_kelas?></h3>
                                       <div class="right">

                                            <a href="<?=base_url()?>admin/kelas/add_kelas_matpel?id_kls=<?=$r1kls->id_kelas?>"><i class="fa fa-plus fa-2x"></i></a>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>

                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <a href="<?=base_url()?>admin/jadwal_guru" class="btn btn-primary">Set Jadwal Guru</a>
                                       <table class="table table-striped">
                                             <thead>
                                                  <tr style="font-size:20px">
                                                       <th style="width:3%">Jam Ke</th>
                                                       <th style="width:10%">Mulai</th>
                                                       <th style="width:10%">Selesai</th>
                                                       <th >Senin</th>
                                                       <th>Selasa</th>
                                                       <th>Rabu</th>
                                                       <th>Kamis</th>
                                                       <th>Jumat</th>
                                                       <th>Sabtu</th>
                                                       <th style="text-align:center;width:15%">Aksi</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $data_kelas_matpel = $this->db->query("SELECT * FROM kelas_matpel where id_kelas='$id' order by jam_ke asc");
                                                  $no = 1;
                                                  foreach ($data_kelas_matpel->result() as $row){
                                                       $data_kelas = $this->db->query("SELECT * FROM kelas where id_kelas = '$row->id_kelas'");
                                                       $data_matpel1 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_senin'");
                                                       $data_matpel2 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_selasa'");
                                                       $data_matpel3 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel= '$row->id_matpel_rabu'");
                                                       $data_matpel4 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_kamis'");
                                                       $data_matpel5 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_jumat'");
                                                       $data_matpel6 = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel = '$row->id_matpel_sabtu'");

                                                       foreach ($data_matpel1->result() as $r_mt1){}
                                                       foreach ($data_matpel2->result() as $r_mt2){}
                                                       foreach ($data_matpel3->result() as $r_mt3){}
                                                       foreach ($data_matpel4->result() as $r_mt4){}
                                                       foreach ($data_matpel5->result() as $r_mt5){}
                                                       foreach ($data_matpel6->result() as $r_mt6){}

                                                       foreach ($data_kelas->result() as $r_kls){}
                                                       ?>
                                                  <tr>
                                                       <td><?=$row->jam_ke?></td>
                                                       <td style="font:16px solid;color:rgb(20, 122, 15)"><?=date('H:i',strtotime($row->jam_mulai))?></td>
                                                       <td style="font:16px solid;color:rgb(254, 52, 8)"><?=date('H:i',strtotime($row->jam_selesai))?></td>
                                                       <td><?=$r_mt1->nama_matpel?></td>
                                                       <td><?=$r_mt2->nama_matpel?></td>
                                                       <td ><?=$r_mt3->nama_matpel?></td>
                                                       <td><?=$r_mt4->nama_matpel?></td>
                                                       <td><?=$r_mt5->nama_matpel?></td>
                                                       <td><?=$r_mt6->nama_matpel?></td>
                                                       <td style="text-align:center">
                                                            <a href="<?=base_url()?>admin/kelas/edit_kelas_matpel?id_kls=<?=$r1kls->id_kelas?>&id=<?=$row->id_kelas_matpel?>" class="btn btn-success btn-xs"><span class="fa fa-edit"></span></a>
                                                            <a href="<?=base_url()?>admin/kelas/proses_hapus_kmp?id_kmp=<?=$row->id_kelas_matpel?>&id=<?=$this->input->get('id')?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></a>
                                                       </td>
                                                  </tr>
                                                  <?php $no++;
                                                  } ?>
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
