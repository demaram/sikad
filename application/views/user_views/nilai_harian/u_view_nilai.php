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


                         $pesan= $this->input->get('pesan');
                         $pesan = sha1($pesan);
                         $waktu = $this->input->post("waktu");
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


                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>

                                   <div class="panel-body no-padding">
                                      <form class="form-horizontal" action="" role="form" method="post" enctype="multipart/form-data" id="form_cari">

                                           <div class="form-group">
                                             <label class="col-lg-2 control-label" for="required">Mata Pelajaran</label>
                                                  <div class="col-lg-8">
                                                       <select name="id_matpel" class="form-control" id="id_matpel" required="true">
                                                            <option value="">Pilih Mata Pelajaran</option>
                                                               <?php
                                                                    $qmp = $this->db->query("SELECT * FROM mata_pelajaran WHERE id_matpel NOT IN (0,99)");
                                                                    foreach ($qmp->result() as $rmp) { ?>
                                                                         <option <?php if ($rmp->id_matpel == $this->input->post('id_matpel')): ?>
                                                                               selected="selected"
                                                                         <?php endif; ?> value="<?=$rmp->id_matpel?>"> <?=$rmp->nama_matpel?> </option>
                                                                    <?php }
                                                               ?>
                                                       </select>
                                             </div><div class="fix"></div>
                                           </div>

                                           <div class="form-group">
                                            <label class="col-lg-2 control-label" for="required">Pilih Waktu : </label>
                                                 <div class="col-lg-4">
                                                       <label class="fancy-radio">
									          <input name="waktu" type="radio" class="form-control" id="cari_harian" value="val_harian" <?php if ($waktu =='val_harian'){ echo "checked='checked'" ; } ?> >

										          <span><i></i>Harian</span>
									          </label>

                                                       <label class="fancy-radio">
									          <input name="waktu"type="radio" class="form-control" id="cari_bulanan" value="val_bulanan" <?php if ($waktu =='val_bulanan'){ echo "checked='checked'" ; } ?> >
										          <span><i></i>Bulanan</span>
									          </label>
                                            </div><div class="fix"></div>
                                         </div>



                                         <div class="form-group" id="tampil_harian" style="display:none">
                                                 <label class="col-lg-2 control-label" for="required">Pilih Hari : </label>
                                                 <div class="col-lg-3">
                                                      <input name="awal_hari" class="form-control datepicker" id="awal_hari" value="<?=$this->input->post('awal_hari')?>">
                                                 </div>
                                                 <div class="col-lg-3">
                                                      <input name="akhir_hari" class="form-control datepicker" id="akhir_hari" value="<?=$this->input->post('akhir_hari')?>">
                                                 </div>

                                                 <div class="fix"></div>
                                         </div>

                                         <div class="form-group col-md-12" id="tampil_bulanan" style="display:none">
                                              <label class="col-lg-2 control-label" for="required">Pilih Bulan : </label>
                                              <div class="col-md-2">
                                                   <select name="bulan1" id="bulan1" class="form-control">
                                                       <option value="" >--Pilih Bulan--</option>
                                                        <option <?php if($this->input->post('bulan1')=='01'){ echo "selected";} ?> value="01" >Januari</option>
                                                        <option <?php if($this->input->post('bulan1')=='02'){ echo "selected";} ?> value="02" >Februari</option>
                                                        <option <?php if($this->input->post('bulan1')=='03'){ echo "selected";} ?> value="03" >Maret</option>
                                                        <option <?php if($this->input->post('bulan1')=='04'){ echo "selected";} ?> value="04" >April</option>
                                                        <option <?php if($this->input->post('bulan1')=='05'){ echo "selected";} ?> value="05" >Mei</option>
                                                        <option <?php if($this->input->post('bulan1')=='06'){ echo "selected";} ?> value="06" >Juni</option>
                                                        <option <?php if($this->input->post('bulan1')=='07'){ echo "selected";} ?> value="07" >Juli</option>
                                                        <option <?php if($this->input->post('bulan1')=='08'){ echo "selected";} ?> value="08" >Agustus</option>
                                                        <option <?php if($this->input->post('bulan1')=='09'){ echo "selected";} ?> value="09" >September</option>
                                                        <option <?php if($this->input->post('bulan1')=='10'){ echo "selected";} ?> value="10" >Oktober</option>
                                                        <option <?php if($this->input->post('bulan1')=='11'){ echo "selected";} ?> value="11" >November</option>
                                                        <option <?php if($this->input->post('bulan1')=='12'){ echo "selected";} ?> value="12" >Desember</option>
                                                  </select>
                                              </div>

                                              <div class="col-md-2">
                                                   <select name="tahun1" id="tahun1" class="form-control col-md-3">
                                                     <option value="">--Pilih Tahun--</option>
                                                     <?php
                                                          $now=date('Y');
                                                          $awal=$now-10;
                                                          for($i=$awal;$i<=$now;$i++){
                                                     ?>
                                                     <option value="<?=$i?>" <?php if($this->input->post('tahun1')==$i){ echo "selected='selected'";}?>><?=$i?></option>
                                                   <?php } ?>
                                                </select>
                                              </div>

                                              <div class="col-md-1">
                                                  S/D
                                              </div>
                                             <div class="col-md-2">
                                                  <select name="bulan2" id="bulan2" class="form-control col-md-3">
                                                      <option value="" >--Pilih Bulan--</option>
                                                      <option <?php if($this->input->post('bulan2')=='01'){ echo "selected";} ?> value="01" >Januari</option>
                                                      <option <?php if($this->input->post('bulan2')=='02'){ echo "selected";} ?> value="02" >Februari</option>
                                                      <option <?php if($this->input->post('bulan2')=='03'){ echo "selected";} ?> value="03" >Maret</option>
                                                      <option <?php if($this->input->post('bulan2')=='04'){ echo "selected";} ?> value="04" >April</option>
                                                      <option <?php if($this->input->post('bulan2')=='05'){ echo "selected";} ?> value="05" >Mei</option>
                                                      <option <?php if($this->input->post('bulan2')=='06'){ echo "selected";} ?> value="06" >Juni</option>
                                                      <option <?php if($this->input->post('bulan2')=='07'){ echo "selected";} ?> value="07" >Juli</option>
                                                      <option <?php if($this->input->post('bulan2')=='08'){ echo "selected";} ?> value="08" >Agustus</option>
                                                      <option <?php if($this->input->post('bulan2')=='09'){ echo "selected";} ?> value="09" >September</option>
                                                      <option <?php if($this->input->post('bulan2')=='10'){ echo "selected";} ?> value="10" >Oktober</option>
                                                      <option <?php if($this->input->post('bulan2')=='11'){ echo "selected";} ?> value="11" >November</option>
                                                      <option <?php if($this->input->post('bulan2')=='12'){ echo "selected";} ?> value="12" >Desember</option>

                                                 </select>
                                             </div>

                                             <div class="col-md-2">
                                                  <select name="tahun2" id="tahun2" class="form-control col-md-3">
                                                     <option value="">--Pilih Tahun--</option>
                                                     <?php
                                                         $now=date('Y');
                                                         $awal=$now-10;
                                                         for($i=$awal;$i<=$now;$i++){
                                                     ?>
                                                     <option value="<?=$i?>" <?php if($this->input->post('tahun2')==$i){ echo "selected='selected'";}?>><?=$i?></option>
                                                   <?php } ?>
                                               </select>
                                             </div>

                                       </div>


<script type="text/javascript">
     $("document").ready(function(){
          $("#cari_harian").click(function(){
               $("#tampil_harian").show(400);
               $("#tampil_bulanan").hide(400);
          });

          $("#cari_bulanan").click(function(){
               $("#tampil_bulanan").show(400);
               $("#tampil_harian").hide(400);
          });


         <?php if ($waktu == 'val_harian') { ?>
               $("#tampil_harian").show();
               $("#tampil_bulanan").hide();
          <?php } elseif ($waktu == 'val_bulanan') { ?>

               $("#tampil_harian").hide();
               $("#tampil_bulanan").show();
          <?php } ?>
     });
</script>




                                         <div class="form-group">
                                           <div class="col-md-offset-1">
                                              <button type="submit" id="submit" class="btn btn-default marginR10">Cari</button>
                                           </div>
                                         </div><!-- End .form-group  -->

                                      </form>

                                   </div>

                              </div>
					</div>


            <?php

function getMonthNamex($i){
	switch($i){
		case "1":
		return "Januari";
		break;

		case "2":
		return "Februari";
		break;

		case "3":
		return "Maret";
		break;

		case "4":
		return "April";
		break;

		case "5":
		return "May";
		break;

		case "6":
		return "Juni";
		break;

		case "7":
		return "Juli";
		break;

		case "8":
		return "Agustus";
		break;

		case "9":
		return "September";
		break;

		case "10":
		return "Oktober";
		break;

		case "11":
		return "November";
		break;

		default:
		return "Desember";
		break;
	}
}

                    //harian diambil jika $waktu == val_harian

                    $data_pendidikan = $this->db->query("SELECT * FROM tbl_pd_siswa where id_smt = '$id_smt' AND id_siswa ='$id_siswa'");
                    $id_pd_siswa = $data_pendidikan->row()->id_pd_siswa;
                    $id_matpel = $this->input->post('id_matpel');


                    if ($waktu !== NULL) {

                         if ($waktu == 'val_harian') {

                                   $awal_hari = date('Y-m-d',strtotime($this->input->post("awal_hari")));
                                   $akhir_hari =  date('Y-m-d',strtotime($this->input->post("akhir_hari")));

                                    $range = date_range($awal_hari, $akhir_hari);
                                    foreach ($range as $date)
                                    {
                                            $rentang_hari[] = $date;
                                            $hari_indo[] = date('d M Y',strtotime($date));
                                    }

                                    $jumlah_ekspresif = array();
                                    for ($i=1; $i <=count($rentang_hari); $i++) {
                                         $q_jumlah = $this->db->query("SELECT * FROM nilai_harian where tgl_nilai = '$rentang_hari[$i]' AND id_pd_siswa='$id_pd_siswa' AND id_matpel='$id_matpel'");
                                         $angka_ekspresif = 0;
                                         $angka_reseptif = 0;
                                         foreach ($q_jumlah->result() as $juml_nilai) {

                                             $angka_ekspresif =  $angka_ekspresif + $juml_nilai->nilai_angka_ekspresif;
                                             $angka_reseptif =  $angka_reseptif + $juml_nilai->nilai_angka_reseptif;
                                         }

                                         $jumlah_ekspresif[$i] =  $angka_ekspresif;
                                         $jumlah_reseptif[$i] =  $angka_reseptif;
                                    }
                                    $max_ekspresif = max($jumlah_ekspresif);
                                    $max_reseptif = max($jumlah_reseptif);
                         }
                         elseif ($waktu =='val_bulanan') {
                              $judul = 'Nilai Bulanan';
                              $bulan1 = $this->input->post('bulan1');
                         	$tahun1 = $this->input->post('tahun1');
                         	$bulan2 = $this->input->post('bulan2');
                         	$tahun2 = $this->input->post('tahun2');

                              $tgl_awal = $tahun1."-".$bulan1."-01";
                         	 $tgl_akhir = $tahun2."-".$bulan2."-".cal_days_in_month(CAL_GREGORIAN, intval($bulan2), $tahun2);
                         	 $count =0;

                         	 $start = $month = strtotime($tgl_awal);
                         	 $end = strtotime($tgl_akhir);

                         	 while($month <= $end){
                         		 $bulan = date('m',$month);
                         		 $tahun = date('Y',$month);

                         		 $label_tahun[] = getMonthNamex(intval($bulan)).$tahun;

                         		 $bulanx[] = $bulan;
                         		 $tahunx[] = $tahun;

                         		 $month = strtotime("+1 month", $month);

                         	 }

                               for($i=0; $i<count($label_tahun);$i++){
                                    $query = $this->db->query("SELECT * FROM nilai_harian WHERE date_format(tgl_nilai,'%m') ='$bulanx[$i]' AND date_format(tgl_nilai,'%Y') ='$tahunx[$i]' AND id_pd_siswa='$id_pd_siswa' AND id_matpel ='$id_matpel'");
                                    $q_query = $query->num_rows();
                                    if ($q_query != '0') {
                                         $pembagi = $q_query;
                                    }
                                    $angka_ekspresif = 0;
                                    $angka_reseptif = 0;
                                   foreach ($query->result() as $row) {
                                        $angka_ekspresif = ( $angka_ekspresif + $row->nilai_angka_ekspresif) / $pembagi;
                                        $angka_reseptif =  ($angka_reseptif + $row->nilai_angka_reseptif) / $pembagi;
							}
                                   $jumlah_ekspresif[$i] =  $angka_ekspresif;
                                   $jumlah_reseptif[$i] =  $angka_reseptif;


                               }
                               $max_ekspresif = max($jumlah_ekspresif);
                               $max_reseptif = max($jumlah_reseptif);
                         }
                         ?>

                         <div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h3 class="panel-title">Grafik <?=$judul?></h3>
                                       <div class="right">


                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>

                                   <div class="panel-body no-padding">
                                        <?php if ($waktu =='val_harian'): ?>

                                             <div id="grafharian" style="width:98%">

                                             </div>
                                        <?php endif; ?>
                                        <?php if ($waktu =='val_bulanan'): ?>
                                             <div id="grafbulanan" style="width:98%">

                                             </div>
                                        <?php endif; ?>

                                   </div>

                              </div>
					</div>

                         <div class="panel panel-headline">
                              <div class="panel">
                                   <div class="panel-heading">
                                       <h3 class="panel-title">Dashboard Report</h3>
                                       <div class="right">
                                             <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                                       </div>
                                   </div>

                                   <div class="panel-body no-padding">
                                        <?php
                                             $matpel = $this->db->query("SELECT * FROM mata_pelajaran where id_matpel ='$id_matpel'");
                                             foreach ($matpel->result() as $matpel) {}

                                             $smt = $this->db->query("SELECT * FROM master_data_semester where id_smt ='$id_smt'");
                                             foreach ($smt->result() as $smt) {}
                                             ?>

                                             <div class="col-md-8" role="alert" style="font-size:20px;">
                                                  <table>
                                                            <tr>
                                                                 <td><b>Nama Siswa</b> </td> <td> : </td> <td style="padding-left:10px;"><?=$nm_siswa?></td>
                                                            </tr>
                                                            <tr>
                                                                 <td> <b>Mata Pelajaran</b></td> <td> : </td> <td style="padding-left:10px;"><?=$matpel->nama_matpel?></td>
                                                            </tr>
                                                            <tr>
                                                                <td> <b>Semester</b></td> <td> : </td> <td style="padding-left:10px;"><?=$smt->nama_smt?></td>
                                                            </tr>
                                                            <tr>
                                                                <td> <b><?php if ($waktu =='val_bulanan'){echo "Maksimum rata-rata nilai ekspresif";} else{echo "Nilai Ekspresif Maksimum";} ?></b> </td> <td> : </td> <td style="padding-left:10px;"><?=$max_ekspresif?></td>
                                                            </tr>
                                                            <tr>
                                                                <td> <b><?php if ($waktu =='val_bulanan'){echo "Maksimum rata-rata nilai reseptif";} else{echo "Nilai Reseptif Maksimum";} ?></b></td> <td> : </td> <td style="padding-left:10px;"><?=$max_reseptif?></td>
                                                            </tr>

                                                  </table>
                                             </div>

                                   </div>

                              </div>
					</div>
              <?php } ?>

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


<script type="text/javascript">
Highcharts.chart('grafharian', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Grafik Nilai Harian Siswa'
    },
    xAxis: {
        categories: [<?php foreach ($hari_indo as $hari) {
                           echo '"'.$hari.'"'.',';
                       }      ?>]
    },
    yAxis: {
        title: {
            text: 'Nilai'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
         {
                  name: 'Nilai Harian Ekspresif',
                  data: [<?php foreach ($jumlah_ekspresif as $row) {
                       echo $row.',';
                              }?>]
          },
          {
               name: 'Nilai Harian Reseptif',
               data: [<?php foreach ($jumlah_reseptif as $rsep) {
                   echo $rsep.',';
                           }?>]
          }
         ]
});
</script>

<script type="text/javascript">
Highcharts.chart('grafbulanan', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Grafik Rata - Rata Nilai Harian Siswa per-bulan'
    },
    xAxis: {
        categories: [<?php foreach ($label_tahun as $hari) {
                           echo '"'.$hari.'"'.',';
                       }      ?>]
    },
    yAxis: {
        title: {
            text: 'Nilai'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [
         {
                  name: 'Nilai Harian Ekspresif',
                  data: [<?php foreach ($jumlah_ekspresif as $row) {
                       echo $row.',';
                              }?>]
          },
          {
               name: 'Nilai Harian Reseptif',
               data: [<?php foreach ($jumlah_reseptif as $rsep) {
                   echo $rsep.',';
                           }?>]
          }
         ]
});
</script>
