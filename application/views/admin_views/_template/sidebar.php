
<?php
     /*
          * SIDEBAR ADMIN
     */


     $hak_admin = $this->session->userdata('logged_in')['akses'];
     $hak_user = $this->session->userdata('logged_user')['akses'];
     $hak_guru = $this->session->userdata('logged_guru')['akses'];

    if ($hak_admin == 'admin') {
 ?>
<div class="sidebar">
     <div class="brand">
         <a href="<?=base_url()?>admin/home"><img src="<?=base_url()?>assets/img/logo2.png" alt="Klorofil Logo" style="width:110px; height:70px; margin:auto" class="img-responsive logo"></a>

     </div>
     <div class="sidebar-scroll">
          <nav>
               <ul class="nav">
                    <?php
                    $sgmt2 = $this->uri->segment(2);
                    $sgmt3 = $this->uri->segment(3);

                     ?>
                    <li><a href="<?=base_url()?>admin/home" class="<?php if($sgmt2=="home" && $sgmt3==''){echo "active";}?>" ><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

                    <li>
                         <?php $master = array('master_data_semester' , 'master_data_agama' , 'master_skala_nilai', 'master_jenis_absen'); ?>
                         <a href="#subPages" data-toggle="collapse"aria-expanded="false"
                              class="<?php if(in_array($sgmt2, $master)){echo 'active';}else{echo 'collapsed';}?>"
                         >
                              <i class="fa fa-pencil "></i> <span>Master Data</span> <i class="icon-submenu fa fa-angle-left"></i></a>
                         <div id="subPages" class="<?php if(in_array($sgmt2, $master))
                                   {echo 'collapse collapse in';} else{echo 'collapse collapse';}?>"
                           ><!--tag div subpages-->
                              <ul class="nav">
                                   <li><a href="<?=base_url()?>admin/master_data_agama" class="<?php if($sgmt2=='master_data_agama'){echo 'active';}?>" ><i class="fa fa-database"></i> Master Data Agama</a></li>
                                   <li><a href="<?=base_url()?>admin/master_skala_nilai" class="<?php if($sgmt2=='master_skala_nilai'){echo 'active';}?>" > <i class="fa fa-percent"></i>Master Skala Nilai</a></li>
                                   <li><a href="<?=base_url()?>admin/master_jenis_absen" class="<?php if($sgmt2=='master_jenis_absen'){echo 'active';}?>" ><i class="fa fa-list"></i>Master Jenis Absen</a></li>
                                   <li><a href="<?=base_url()?>admin/master_data_semester" class="<?php if($sgmt2=='master_data_semester'){echo 'active';}?>" > <i class="fa fa-cogs"></i>Master Data Semester</a></li>
                              </ul>
                         </div>
                    </li>

                    <li>
                        <?php $array_akademik = array('mata_pelajaran', 'kelas' , 'pr_siswa'); ?>
                       <a href="#subPages4" data-toggle="collapse" aria-expanded="false"
                            class="<?php if(in_array($sgmt2 , $array_akademik) ){echo 'active';} else{echo 'collapsed';}?>"
                       >
                            <i class="fa fa-industry "></i> <span>Akademik</span> <i class="icon-submenu fa fa-angle-left"></i></a>
                       <div id="subPages4" class="<?php if(in_array($sgmt2 , $array_akademik) )
                                 {echo 'collapse collapse in';} else{echo 'collapse collapse';}?>"
                        ><!--tag div subpages-->
                            <ul class="nav">
                                 <li><a href="<?=base_url()?>admin/mata_pelajaran" class="<?php if($sgmt2=='mata_pelajaran'){echo 'active';}?>" ><i class="fa fa-tasks"></i>Mata Pelajaran</a></li>
                                 <li><a href="<?=base_url()?>admin/kelas" class="<?php if($sgmt2=='kelas'){echo 'active';}?>" ><i class="fa fa-building"></i>Kelas</a></li>
                                 <li><a href="<?=base_url()?>admin/pr_siswa" class="<?php if($sgmt2=='pr_siswa'){echo 'active';}?>" > <i class="fa fa-home"></i>Pekerjaan Rumah</a></li>
                            </ul>
                       </div>
                  </li>


                    <li>
                         <?php $array_siswa = array('data_siswa','absen_siswa','nilai_harian','nilai_tugas','nilai_uas','rapor_siswa'); ?>
                        <a href="#subPages2" data-toggle="collapse" aria-expanded="false"
                             class="<?php if(in_array($sgmt2, $array_siswa)){echo 'active';} else{echo 'collapsed';}?>"
                        >
                             <i class="fa fa-users "></i> <span>Siswa</span> <i class="icon-submenu fa fa-angle-left"></i></a>
                        <div id="subPages2" class="<?php if(in_array($sgmt2, $array_siswa))
                                  {echo 'collapse collapse in';} else{echo 'collapse collapse';}?>"
                         ><!--tag div subpages-->
                             <ul class="nav">
                                  <li><a href="<?=base_url()?>admin/data_siswa" class="<?php if($sgmt2=='data_siswa'){echo 'active';} ?>" > <i class="fa fa-user-o"></i>Data Siswa</a></li>
                                  <li><a href="<?=base_url()?>admin/absen_siswa" class="<?php if($sgmt2=='absen_siswa'){echo 'active';} ?>" > <i class="fa fa-universal-access"></i>Absensi Siswa</a></li>
                                  <li><a href="<?=base_url()?>admin/nilai_harian" class="<?php if($sgmt2=='nilai_harian'){echo 'active';} ?>" ><i class="fa fa-hourglass"></i>Nilai Harian</a></li>
                                  <li><a href="<?=base_url()?>admin/nilai_tugas" class="<?php if($sgmt2=='nilai_tugas'){echo 'active';} ?>" ><i class="fa fa-book"></i>Nilai Tugas</a></li>
                                  <li><a href="<?=base_url()?>admin/nilai_uas" class="<?php if($sgmt2=='nilai_uas'){echo 'active';} ?>" ><i class="fa fa-university"></i>Nilai UAS</a></li>
                                   <li><a href="<?=base_url()?>admin/rapor_siswa" class="<?php if($sgmt2=='rapor_siswa'){echo 'active';} ?>" ><i class="fa  fa-graduation-cap"></i>Rekap Rapor Siswa</a></li>

                             </ul>
                        </div>
                   </li>



                   <li>
                        <?php $array_guru = array('data_guru','jadwal_guru'); ?>
                       <a href="#subPages3" data-toggle="collapse" aria-expanded="false"
                            class="<?php if(in_array($sgmt2 , $array_guru)){echo 'active';} else{echo 'collapsed';}?>"
                       >
                            <i class="fa fa-user "></i> <span>Guru</span> <i class="icon-submenu fa fa-angle-left"></i></a>
                       <div id="subPages3" class="<?php if(in_array($sgmt2 , $array_guru))
                                 {echo 'collapse collapse in';} else{echo 'collapse collapse';}?>"
                        ><!--tag div subpages-->
                            <ul class="nav">
                                 <li><a href="<?=base_url()?>admin/data_guru" class="<?php if($sgmt2=='data_guru'){echo 'active';} ?>" ><i class="fa fa-street-view"></i>Data Guru</a></li>
                                 <li><a href="<?=base_url()?>admin/jadwal_guru" class="<?php if($sgmt2=='jadwal_guru'){echo 'active';} ?>" ><i class="fa fa-tags"></i>Jadwal Mengajar</a></li>
                            </ul>
                       </div>
                  </li>

                  <li>
                       <?php $array_konten = array('berita'); ?>
                      <a href="#subPages1" data-toggle="collapse" aria-expanded="false"
                           class="<?php if(in_array($sgmt2 , $array_konten)) {echo 'active';} else{echo 'collapsed';}?>"
                      >
                           <i class="fa fa-globe "></i> <span>Konten</span> <i class="icon-submenu fa fa-angle-left"></i></a>
                      <div id="subPages1" class="<?php if(in_array($sgmt2 , $array_konten))
                                {echo 'collapse collapse in';} else{echo 'collapse collapse';}?>"
                       ><!--tag div subpages-->
                           <ul class="nav">
                                <li><a href="<?=base_url()?>admin/berita" class="<?php if($sgmt2=='berita'){echo 'active';} ?>" > <i class="fa fa-bullhorn"></i>Berita Akademik</a></li>
                           </ul>
                      </div>
                 </li>
               </ul>
          </nav>
     </div>
    </div>
    <?php }elseif ($hak_guru =='guru') {

         ?>
         <div class="sidebar">
             <div class="brand">
                 <a href="<?=base_url()?>staff/home"><img src="<?=base_url()?>assets/img/logo2.png" alt="Klorofil Logo" style="width:110px; height:70px; margin:auto" class="img-responsive logo"></a>

             </div>
             <div class="sidebar-scroll">
                  <nav>
                       <ul class="nav">
                            <?php
                            $sgmt2 = $this->uri->segment(2);
                            $sgmt3 = $this->uri->segment(3);

                             ?>
                            <li><a href="<?=base_url()?>staff/home" class="<?php if($sgmt2=="home" && $sgmt3==''){echo "active";}?>" ><i class="fa fa-home"></i> <span>Dashboard</span></a></li>


                            <li>
                                <?php $array_akademik = array('s_pr_siswa', 's_absen_siswa','s_nilai_harian','s_nilai_tugas','s_nilai_uas'); ?>
                               <a href="#subPages4" data-toggle="collapse" aria-expanded="false"
                                    class="<?php if(in_array($sgmt2 , $array_akademik) ){echo 'active';} else{echo 'collapsed';}?>"
                               >
                                    <i class="fa fa-industry "></i> <span>Akademik Siswa</span> <i class="icon-submenu fa fa-angle-left"></i></a>
                               <div id="subPages4" class="<?php if(in_array($sgmt2 , $array_akademik) )
                                         {echo 'collapse collapse in';} else{echo 'collapse collapse';}?>"
                                ><!--tag div subpages-->
                                    <ul class="nav">
                                         <li><a href="<?=base_url()?>staff/s_pr_siswa" class="<?php if($sgmt2=='s_pr_siswa'){echo 'active';}?>" > <i class="fa fa-home"></i>Pekerjaan Rumah </a></li>
                                         <li><a href="<?=base_url()?>staff/s_absen_siswa" class="<?php if($sgmt2=='s_absen_siswa'){echo 'active';} ?>" > <i class="fa fa-universal-access"></i>Absensi Siswa</a></li>
                                         <li><a href="<?=base_url()?>staff/s_nilai_harian" class="<?php if($sgmt2=='s_nilai_harian'){echo 'active';} ?>" ><i class="fa fa-hourglass"></i>Nilai Harian</a></li>
                                         <li><a href="<?=base_url()?>staff/s_nilai_tugas" class="<?php if($sgmt2=='s_nilai_tugas'){echo 'active';} ?>" ><i class="fa fa-book"></i>Nilai Tugas</a></li>
                                         <li><a href="<?=base_url()?>staff/s_nilai_uas" class="<?php if($sgmt2=='s_nilai_uas'){echo 'active';} ?>" ><i class="fa fa-university"></i>Nilai UAS</a></li>
                                    </ul>
                               </div>
                          </li>


                            <li>
                                 <?php $array_siswa = array('rapor_siswa','ganti_password','s_rapor_siswa'); ?>
                                <a href="#subPages2" data-toggle="collapse" aria-expanded="false"
                                     class="<?php if(in_array($sgmt2, $array_siswa)){echo 'active';} else{echo 'collapsed';}?>"
                                >
                                     <i class="fa fa-users "></i> <span>Rapor Siswa</span> <i class="icon-submenu fa fa-angle-left"></i></a>
                                <div id="subPages2" class="<?php if(in_array($sgmt2, $array_siswa))
                                          {echo 'collapse collapse in';} else{echo 'collapse collapse';}?>"
                                 ><!--tag div subpages-->
                                     <ul class="nav">


                                           <li><a href="<?=base_url()?>staff/s_rapor_siswa" class="<?php if($sgmt2=='s_rapor_siswa'){echo 'active';} ?>" ><i class="fa  fa-graduation-cap"></i>Rekap Rapor Siswa</a></li>

                                     </ul>
                                </div>
                           </li>
                           <li><a href="<?=base_url()?>staff/home/ganti_password" class="<?php if($sgmt3=="ganti_password"){echo "active";}?>" ><i class="fa fa-pencil"></i> <span>Ganti Password</span></a></li>
                           <li><a href="<?=base_url()?>staff/s_jadwal_matpel" class="<?php if($sgmt2=="s_jadwal_matpel"){echo "active";}?>" ><i class="fa fa-asterisk"></i> <span>Jadwal Guru</span></a></li>

                       </ul>
                  </nav>
             </div>
            </div>
   <?php }

/*
*    Jika Hak Login sebeagai user
*    Menampilkan sidebar sebagai berikut
*/
    elseif ($hak_user == 'user') { ?>
         <div class="sidebar">
             <div class="brand">
                  <a href="<?=base_url()?>user/home"><img src="<?=base_url()?>assets/img/logo2.png" alt="Klorofil Logo" style="width:100px; height:70px; margin:auto" class="img-responsive logo"></a>
             </div>
             <div class="sidebar-scroll">
                  <nav>
                       <ul class="nav">
                            <?php
                            $sgmt2 = $this->uri->segment(2);
                            $sgmt3 = $this->uri->segment(3);
                             ?>
                            <li><a href="<?=base_url()?>user/home" class="<?php if($sgmt2=="home" && $sgmt3==''){echo "active";}?>" ><i class="fa fa-home"></i> <span>Home</span></a></li>

                     <li>
                               <?php $array_konten = array('u_nilai_harian','u_jadwal_pelajaran','u_pr_siswa','u_rapor_siswa'); ?>
                              <a href="#subPages1" data-toggle="collapse" aria-expanded="false"
                                   class="<?php if(in_array($sgmt2 , $array_konten)) {echo 'active';} else{echo 'collapsed';}?>"
                              >
                                   <i class="fa fa-globe "></i> <span>Akademik</span> <i class="icon-submenu fa fa-angle-left"></i></a>
                              <div id="subPages1" class="<?php if(in_array($sgmt2 , $array_konten))
                                        {echo 'collapse collapse in';} else{echo 'collapse collapse';}?>"
                               ><!--tag div subpages-->
                                   <ul class="nav">
                                        <li><a href="<?=base_url()?>user/u_nilai_harian" class="<?php if($sgmt2=='u_nilai_harian'){echo 'active';} ?>" > <i class="fa fa-bullhorn"></i>Nilai Harian</a></li>
                                        <li><a href="<?=base_url()?>user/u_jadwal_pelajaran" class="<?php if($sgmt2=='u_jadwal_pelajaran'){echo 'active';} ?>" > <i class="fa fa-archive"></i>Jadwal Pelajaran</a></li>
                                        <li><a href="<?=base_url()?>user/u_pr_siswa" class="<?php if($sgmt2=='u_pr_siswa'){echo 'active';} ?>" > <i class="fa fa-book"></i>Pekerjaan Rumah</a></li>
                                        <li><a href="<?=base_url()?>user/u_rapor_siswa" class="<?php if($sgmt2=='u_rapor_siswa'){echo 'active';} ?>" > <i class="fa fa-graduation-cap"></i>Rapor</a></li>
                                   </ul>
                              </div>
                         </li>
                         <li><a href="<?=base_url()?>user/home/ganti_password" class="<?php if($sgmt3=="ganti_password"){echo "active";}?>" ><i class="fa fa-pencil"></i> <span>Ganti Password</span></a></li>
                         <li><a href="<?=base_url()?>login/logout" class="<?php if($sgmt2=="logout"){echo "active";}?>" ><i class="fa fa-home"></i> <span>Logout</span></a></li>
                       </ul>
                  </nav>
             </div>
            </div>
    <?php }
    ?>
