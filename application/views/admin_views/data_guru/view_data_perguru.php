<?php
$this->load->view('admin_views/_template/head');
 ?>
 <style media="screen">
 .table-borderless td,
.table-borderless th {
border: 0;
}
 </style>
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
                    $data_siswa = $this->db->query("SELECT * FROM users WHERE id_user = '$id'");
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
                                                  $nama_controller = 'data_guru';

                                             ?>
                                            <a href="<?=base_url()?>admin/<?=$nama_controller?>/edit_data?id=<?=$id?>"><i class="fa fa-edit fa-2x"></i></a>
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>

                                   <div class="panel-body no-padding">
                                        <?php
                                             foreach ($data_siswa->result() as $row) { ?>

                                            <?php }
                                         ?>


                                         <div class=" table-responsive">
                            <style media="screen">
                                 .fonttd{
                                      font-size: 16px;
                                      font-weight: bold;
                                 }
                            </style>
                                         <table class="table">
                                              <tr>
                                                   <td class="fonttd">Nama Guru</td>
                                                   <td>:</td>
                                                   <td><?=$row->nama?></td>
                                              </tr>
                                              <tr>
                                                   <td class="fonttd">Gelar</td>
                                                   <td>:</td>
                                                   <td><?=$row->gelar?></td>
                                              </tr>
                                              <tr>
                                                  <td class="fonttd">NIP</td>
                                                  <td>:</td>
                                                  <td><?=$row->nip?></td>
                                             </tr>
                                              <tr>
                                                   <td class="fonttd">NIK</td>
                                                   <td>:</td>
                                                   <td><?=$row->nik?></td>
                                              </tr>
                                              <tr>
                                                  <td class="fonttd">Pendidikan</td>
                                                  <td>:</td>
                                                  <td> <?php
                                                    $qp = $this->db->query("SELECT * from jenjang_pendidikan where id_pendidikan ='$row->id_pendidikan'");

                                                    foreach ($qp->result() as $rp) {
                                                         echo $rp->nama_pendidikan;
                                                    }
                                             ?></td>
                                             </tr>
                                              <tr>
                                                   <td class="fonttd">Username</td>
                                                   <td>:</td>
                                                   <td><?=$row->username?></td>
                                              </tr>
                                              <tr>
                                                 <td class="fonttd">Jenis Kelamin</td>
                                                 <td>:</td>
                                                 <td> <?php switch ($row->jk) {
                                                       case 'L':
                                                            echo "Laki - Laki";
                                                            break;
                                                       case 'P':
                                                            echo "Perempuan";
                                                            break;
                                                  } ?>
                                                  </td>
                                            </tr>
                                            <tr>
                                                 <td class="fonttd">Tempat, Tanggal Lahir</td>
                                                 <td>:</td>
                                                 <td><?=$row->tmpt_lahir  .", ".   date('d-M-Y',strtotime($row->tgl_lahir));?></td>
                                            </tr>
                                            <tr>
                                                 <td class="fonttd">Kewarganegaraan</td>
                                                 <td>:</td>
                                                 <td> <?php
                                                   $data_negara = $this->db->query("SELECT * from tbl_negara where kode_negara ='$row->kode_negara'");

                                                   foreach ($data_negara->result() as $rngr) {
                                                        echo $rngr->nama_negara;
                                                   }
                                                  ?></td>
                                            </tr>
                                            <tr>
                                                 <td class="fonttd">Provinsi Asal</td>
                                                 <td>:</td>
                                                 <td> <?php
                                                   $qprov = $this->db->query("SELECT * from tbl_wilayah where kode_provinsi ='$row->kode_provinsi' AND kode_kabkot='00'");

                                                   foreach ($qprov->result() as $rprov) {
                                                        echo $rprov->nama_lokasi;
                                                   }
                                                  ?></td>
                                            </tr>
                                            <tr>
                                                 <td class="fonttd">Kabupaten / Kota Asal</td>
                                                 <td>:</td>
                                                 <td>    <?php
                                                     $qprov = $this->db->query("SELECT * from tbl_wilayah where kode_provinsi ='$row->kode_provinsi' AND kode_kabkot='$row->kode_kabkot' AND kode_kecamatan='00'");

                                                     foreach ($qprov->result() as $rprov) {
                                                          echo $rprov->nama_lokasi;
                                                     }
                                               ?></td>
                                            </tr>
                                            <tr>
                                                 <td class="fonttd">Alamat</td>
                                                 <td>:</td>
                                                 <td><?=$row->alamat?></td>
                                            </tr>
                                            <tr>
                                                 <td class="fonttd">Kode Pos</td>
                                                 <td>:</td>
                                                 <td><?=$row->kode_pos?></td>
                                            </tr>
                                            <tr>
                                                 <td class="fonttd">Nomor Telepon/HP</td>
                                                 <td>:</td>
                                                 <td><?=$row->no_hp?></td>
                                            </tr>
                                            <tr>
                                                 <td class="fonttd">Email</td>
                                                 <td>:</td>
                                                 <td><?=$row->email?></td>
                                            </tr>


                                            <tr>
                                                 <td class="fonttd">Pas Foto</td>
                                                 <td>:</td>
                                                 <td><img style="width:170px; height:200px" class="img-thumbnail"
                                                       <?php
                                                            if ($row->photo == '') { ?>
                                                                 src="<?=base_url()?>assets/foto/no_img.png">
                                                       <?php } else {
                                                        ?>
                                                       src="<?=base_url()?>assets/foto/<?=$row->photo?>">

                                                       <?php } ?></td>
                                            </tr>


                                         </table>
                                           </div>



                                               </div>
                                           </div>
                                       </div>
                                   </div>

                              </div>
					</div>
					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<footer>

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
