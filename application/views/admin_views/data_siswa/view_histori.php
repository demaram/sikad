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
                    $id_siswa = $this->input->get('id');
                    $data_siswa = $this->db->query("SELECT * FROM tbl_siswa WHERE id_siswa = '$id_siswa'");
                    foreach($data_siswa->result() as $rsiswa){

                    }
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

                                   case 'add_gagal_id':
               				?>
                                  <div class="alert alert-danger">
                                               <button type="button" class="close" data-dismiss="alert">×</button>
                                               <strong>Failed!</strong>Gagal Tambah Data (Siswa dengan Periode yang sama sudah ada)
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

                                   case 'upload_gagal':
                                   ?>
                                   <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Failed!</strong>Gagal Upload Foto <?=$this->session->flashdata('error')[error_upload]?>
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
                                                  $nama_controller = 'data_siswa';

                                             ?>
                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/tambah_histori?conid=<?=$id_siswa?>"><i class="fa fa-plus fa-2x"></i></a>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>
                                   <div class="panel-body no-padding">
                                        <div class="alert alert-info col-md-8">
                                             <table>
                                                     <tr>
                                                          <td width=50%><strong>Nama Siswa</td><td style=" padding: 0px 10px 0px 30px;">:</td> </strong></td>
                                                          <td> <?=$rsiswa->nm_siswa?> </td>
                                                     </tr>
                                                     <tr>
                                                         <td><strong>Nomor Induk Siswa </td> <td  style=" padding: 0px 10px 0px 30px;">:</td> </strong></td>
                                                         <td> <?=$rsiswa->nisn?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tempat Lahir </td> <td  style=" padding: 0px 10px 0px 30px;">:</td> </strong></td>
                                                        <td> <?=$rsiswa->tmpt_lahir?> </td>
                                                   </tr>
                                                   <tr>
                                                      <td  ><strong>Tanggal Lahir </td> <td  style=" padding: 0px 10px 0px 30px;">:</td> </strong></td>
                                                      <td> <?=date('d M Y',strtotime($rsiswa->tgl_lahir))?> </td>
                                                 </tr>


                                               </table>
                                          </div>
                                       <table class="table table-striped data_table">
                                             <thead>
                                                  <tr>
                                                       <th>No</th>
                                                       <th>Periode</th>
                                                       <th>Kelas</th>
                                                       <th>Jenis Pendaftaran</th>
                                                       <th>Tanggal Masuk</th>
                                                       <th style="text-align:center">Aksi</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $no = 1;
                                                  $data_pendidikan = $this->db->query("SELECT * FROM tbl_pd_siswa where id_siswa = '$id_siswa'");
                                                  foreach ($data_pendidikan->result() as $row):

                                                       $semester = $this->db->query("SELECT * FROM master_data_semester where id_smt = '$row->id_smt'");
                                                       foreach($semester->result() as $rsmt){}

                                                       $kelas = $this->db->query("SELECT * FROM kelas where id_kelas = '$row->id_kelas'");
                                                       foreach($kelas->result() as $rkls){}

                                                       ?>
                                                  <tr>
                                                       <td><?=$no?></td>
                                                       <td><?=$rsmt->nama_smt?></td>
                                                       <td><?=$rkls->nama_kelas?></td>
                                                       <td><?=$row->jns_daftar?></td>
                                                       <td><?=date('d M Y',strtotime($row->tgl_daftar))?></td>


                                                       <td style="text-align:center">

                                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/edit_histori?id=<?=$row->id_pd_siswa?>&conid=<?=$row->id_siswa?>" class="btn btn-success"><span class="fa fa-edit"></span></a>
                                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/hapus_histori?id=<?=$row->id_pd_siswa?>&conid=<?=$row->id_siswa?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
	<!-- END WRAPPER -->

     <?php
     $this->load->view('admin_views/_template/footer');
      ?>
</body>

</html>
