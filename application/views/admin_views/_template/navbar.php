
<style media="screen">
     .top-text{
          font-size: 18px;
     }
</style>
<nav class="navbar navbar-default">
     <div class="container-fluid">
          <div class="navbar-btn">
               <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
          </div>
          <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="sr-only">Toggle Navigation</span>
                    <i class="fa fa-bars icon-nav"></i>
               </button>
               <div class="row">

                    <div class="col-md-12 top-text" style="margin-left:40px">
                         <?php
                              $hak_admin = $this->session->userdata('logged_in')['akses'];
                              $hak_user = $this->session->userdata('logged_user')['akses'];
                              $hak_guru = $this->session->userdata('logged_guru')['akses'];
                              $smt = $this->db->query("SELECT nama_smt from master_data_semester where id_smt = '$id_smt'");
                              foreach ($smt->result() as $smt) {}


                              if ($hak_admin =='admin' || $hak_guru =='guru') {
                                   $user = $this->db->query("SELECT nama from users where id_user = '$id_guru'");
                                   foreach ($user->result() as $user) {}
                                   $nama_user = $user->nama;

                                   $kelas = $this->db->query("SELECT * from kelas where id_guru_wali = '$id_guru'");
                                   foreach ($kelas->result() as $kelas) {}
                                   if ($kelas->nama_kelas !=NULL) {
                                        $nama_kelas =  "Wali Kelas " . $kelas->nama_kelas ;
                                   }else {
                                        if ($hak_admin =='admin') {
                                             $nama_kelas = 'Admin';
                                        }else {
                                             $nama_kelas= "(Bukan Wali Kelas)";
                                        }

                                   }


                              }elseif ($hak_user =='user') {
                                   $user = $this->db->query("SELECT nm_siswa from tbl_siswa where id_siswa = '$id_siswa'");
                                   foreach ($user->result() as $user) {}
                                   $nama_user = $user->nm_siswa;


                                   $kelas = $this->db->query("SELECT * from kelas where id_kelas = '$id_kelas'");
                                   foreach ($kelas->result() as $kelas) {}
                                   if ($kelas->nama_kelas !=NULL) {
                                       $nama_kelas =  $kelas->nama_kelas ;
                                   }else {
                                       $nama_kelas= "(Belum Terdaftar Di kelas)";
                                   }
                              }
                          ?>
                          <table style="font-size:16px; margin-top:5px;">
                               <tr>
                                    <td>Nama</td><td style="padding-right:10px;padding-left:10px">:</td><td><?=$nama_user?></td>
                               </tr>
                               <tr>
                                    <td>Kelas</td><td style="padding-right:10px;padding-left:10px">:</td><td><?=$nama_kelas?></td>
                               </tr>
                               <tr>
                                    <td>Semester</td><td style="padding-right:10px;padding-left:10px">:</td><td><?=$smt->nama_smt?></td>
                               </tr>
                          </table>

                    </div>
               </div>


          </div>
          <div id="navbar-menu" class="navbar-collapse collapse">
               <?php

               if ($hak_admin == 'admin') { ?>

               <ul class="nav navbar-nav navbar-right">

                    <?php $query = $this->db->query("SELECT * FROM users where username = '$username'");
                         $nama = array();
                         foreach ($query->result() as $row ) {
                              $nama[] = $row->nama;
                         }

                    ?>
                    <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/foto/<?=$row->photo?>" class="img-circle" width="30" height="30" alt="Avatar"> <span><?=$nama[0]?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                         <ul class="dropdown-menu">
                              <li><a href="<?=base_url()?>/admin/profil"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                              <li><a href="<?=base_url()?>/admin/login/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                         </ul>
                    </li>
               </ul>
               <?php }

               /*
                    Jika Login sebagai user
               */
               elseif ($hak_user == 'user') { ?>

                    <ul class="nav navbar-nav navbar-right">

                         <?php $query = $this->db->query("SELECT * FROM tbl_siswa where username = '$username' AND password='$password'");
                             $nama = array();
                             foreach ($query->result() as $row ) {
                                  $nama[] = $row->nm_siswa;
                             }

                        ?>
                        <li class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/foto/<?=$row->photo?>" class="img-circle" width="30" height="30" alt="Avatar"> <span><?=$nama[0]?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                             <ul class="dropdown-menu">
                                  <li><a href="<?=base_url()?>user/home/ganti_password"><i class="lnr lnr-user"></i> <span>Ganti Password</span></a></li>
                                  <li><a href="<?=base_url()?>login/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                             </ul>
                        </li>

                    </ul>


              <?php }elseif ($hak_guru =='guru') { ?>
                   <ul class="nav navbar-nav navbar-right">

                       <?php $query = $this->db->query("SELECT * FROM users where username = '$username'");
                            $nama = array();
                            foreach ($query->result() as $row ) {
                                 $nama[] = $row->nama;
                            }

                       ?>
                       <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?=base_url()?>assets/foto/<?=$row->photo?>" class="img-circle" width="30" height="30" alt="Avatar"> <span><?=$nama[0]?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                 <li><a href="<?=base_url()?>/staff/profil"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                 <li><a href="<?=base_url()?>/admin/login/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                            </ul>
                       </li>
                  </ul>
             <?php }
               ?>
          </div>
     </div>
</nav>
