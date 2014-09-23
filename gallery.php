<!--Tab halaman-->
<div class="tabbable">
    <div id="tabs">
        <ul class="nav nav-tabs padding-18" >
            <li class="active">
                <a href="#lokasi">
                    <i class="green icon-location-arrow bigger-120"></i>
                    Lokasi dan Pasokan Air Minimum
                </a>
            </li>

            <li>
                <a href="#laju">
                    <i class="orange icon-bolt bigger-120"></i>
                    Laju Penerapan Air
                </a>
            </li>

            <li>
                <a href="#potensi">
                    <i class="blue icon-anchor bigger-120"></i>
                    Potensi Pengangkutan Air
                </a>
            </li>

            <li>
                <a href="#result">
                    <i class="pink icon-fire-extinguisher bigger-120"></i>
                    Result
                </a>
            </li>
        </ul>
        <div class="tab-content no-border padding-24">
            <!--LOKASI-->
            <div id="lokasi" class="tab-pane in active">
                A
            </div>
            <!--END LOKASI-->
            <!--LAJU-->
            <div id="laju" class="tab-pane">
                B
                <div class="hr hr10 hr-double"></div>

                <ul class="pager pull-right">
                    <li class="previous">
                        <a class="prevtab" href="#lokasi">&larr; Prev</a>
                    </li>

                    <li class="next">
                        <a class="nexttab" href="#potensi">Next &rarr;</a>
                    </li>
                </ul>
            </div>
            <!--END LAJU-->
            <!--POTENSI-->
            <div id="potensi" class="tab-pane">
                C

                <div class="hr hr10 hr-double"></div>

                <ul class="pager pull-right">
                    <li class="previous">
                        <a class="prevtab" href="#laju">&larr; Prev</a>
                    </li>

                    <li class="next">
                        <a class="nexttab" href="#result">Next &rarr;</a>
                    </li>
                </ul>
            </div>
            <!--END POTENSI-->
            <!--RESULT-->
            <div id="result" class="tab-pane">
                <form class="form-horizontal" id="" method="POST" action="Fanalisis/analisisProses.php">


                    <div class="form-actions">
                        <div class="pull-right">
                            <button class="btn">
                                <i class="icon-arrow-left bigger-110"></i>
                                Kembali
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn btn-info" type="submit">
                                <i class="icon-ok"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--END RESULT-->
        </div>
    </div>
</div>
<!--End tab halaman-->
<form class="form-horizontal" id="validation-form">
    <div class="row-fluid form-horizontal">
        <div class="span12">
            <div class="span6">
                <div class="widget-box transparent">
                    <div class="widget-header header-color-blue2">
                        <h3>Lokasi Kejadian Kebakaran</h3>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-4">
                            <div class="content">
                                <div class="space-6"></div>
                                <div id="frm-lokasi">
                                    <div class="control-group">
                                        <label class="control-label" for="kecamatan">Pilih Kecamatan : </label>
                                        <?php
                                        $query_parent = mysql_query("SELECT * FROM kecamatan") or die("Query failed: " . mysql_error());
                                        ?>
                                        <div class="controls">
                                            <span>
                                                <select name="kecamatan" id="kecamatan" data-placeholder="Pilih Kecamatan...">
                                                    <option value="" />Pilih Kecamatan...
                                                    <?php while ($row = mysql_fetch_array($query_parent)): ?>
                                                        <option value="<?= $row['KECAMATAN_ID']; ?>"><?php echo $row['KECAMATAN_NAMA']; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="desa">Pilih Desa : </label>
                                        <div class="controls">
                                            <span>
                                                <select name="desa" id="desa">
                                                    <option value=""  />PIlih Desa...
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="sumber_air">Sumber Air : </label>
                                        <div class="controls">
                                            <span>
                                                <input type="hidden" name="sumber_air" id="text_content" value="" />
                                                <select id="sumber_air" name="sumber_air_" onchange="document.getElementById('text_content').value = this.options[this.selectedIndex].text">
                                                    <option value="" />Sumber Air...
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="sumber_air">Tipe Proteksi Kebakaran : </label>
                                        <div class="controls">
                                            <span>
                                                <select id="tipe_proteksi" name="tipe_proteksi">
                                                    <option value="" />Tipe Proteksi...
                                                    <option value="MPKP" >MPKP (Kota)
                                                    <option value="MPKL" >MPKL (Lingkungan)
                                                    <option value="MPKBG" >MPKBG (Bangunan Gedung)
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Jumlah Kebutuhan Air :</label>

                                        <div class="controls">
                                            <span class="span12">
                                                <label>
                                                    <input onchange='check_value();' name="exposure" value="1" type="radio"/>
                                                    <span class="lbl"> 
                                                        <b class="text-error">Tanpa</b> resiko bangunan berdekatan. 
                                                        <a href="#tanpa" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="top" title="More details.">?</span></a>
                                                    </span>
                                                </label>

                                                <label>
                                                    <input onchange='check_value();' name="exposure" value="2" type="radio"/>
                                                    <span class="lbl"> 
                                                        <b class="text-error">Dengan</b> resiko bangunan berdekatan. 
                                                        <a href="#dengan" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="bottom" title="More details.">?</span></a>
                                                    </span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label red">Penggunaan Bahan Khusus Pemadam Api: </label>

                                        <div class="controls">
                                            <span class="span12">
                                                <label>
                                                    <input name="tepol" value="Menggunkan Tepol (Cairan Basa)" type="radio"/>
                                                    <span class="lbl">
                                                        Ya
                                                    </span>
                                                </label>
                                                <label>
                                                    <input name="tepol" value="Tidak Menggunakan Tepol" type="radio"/>
                                                    <span class="lbl">
                                                        Tidak
                                                    </span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tanpa Faktor Bahaya -->
            <div class="span6" id="widget_tanpa">
                <div class="widget-box transparent">
                    <div class="widget-body">
                        <div class="widget-main padding-4">
                            <div class="content">
                                <div class="space-6"></div>
                                <p align="center" class="text-error">
                                    Pasokan Air Minuman Tanpa Resiko Bangunan Berdekatan.
                                <hr>
                                </p>

                                <div class="control-group">
                                    Rumus Pasokan Air Minimum :
                                    <p align="center">
                                        <img src="../assets/img/pam1.jpg">
                                    </p>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="tipe-bangunan">Tipe Bangunan :<br /> <small>(Angka Klasifikasi Resiko Kebakaran)</small></label>
                                    <?php
                                    $bangunan1 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                                    ?>
                                    <div class="controls">
                                        <select id="bangunan_tanpa" onchange="run();
                                                document.getElementById('nama_tipe1').value = this.options[this.selectedIndex].text" data-placeholder="Pilih Bangunan...">
                                            <option value="" />Pilih Bangunan...
                                            <?php while ($r = mysql_fetch_array($bangunan1)): ?>
                                                <option value="<?php echo $r['TINGKAT_BANGUNAN']; ?>"><?php echo $r['NAMA_BANGUNAN']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <input type="hidden" name="nama_tipe1" id="nama_tipe1" value="" />
                                        <input name="nilai_bangunan1" class="span2" id="angka_tanpa" type="number" value="" readonly="readonly"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class = "control-label">Tipe bangunan tidak terdapat dalam list ? </label>

                                    <div class="controls">
                                        <label class="inline">
                                            <input name="check" type = "checkbox" onclick="showMe('tipe_baru')" class="ace-switch ace-switch-5"/>
                                            <span class="lbl"></span>
                                        </label><strong class="red">*</strong>
                                    </div>
                                </div>


                                <div id="tipe_baru" style="display:none">
                                    <div class = "control-group">
                                        <label class = "control-label" for = "nama_tipe_baru">Tipe bangunan baru:</label>

                                        <div class = "controls">
                                            <input type = "text" id="nama_tipe_baru1" name = "nama_tipe_baru1" />
                                            <select name = "nilai_tipe_baru1" id="nilai_tipe_baru1" class="span2">
                                                <option value="">---
                                                <option value="3"> 3
                                                <option value="4"> 4
                                                <option value="5"> 5
                                                <option value="6"> 6
                                                <option value="7"> 7
                                            </select>
                                            &nbsp;<strong class="red">*</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                                    <div class="controls">
                                        <select name="angka_konstruksi1" id="angka-kostruksi_tanpa" onchange="go();">
                                            <option value="" />Pilih Faktor Bahaya...
                                            <option value="0.5"> Konstruksi tahan api
                                            <option value="0.75"> Konstruksi kayu berat (tidak mudah terbakar)
                                            <option value="1.0"> Konstruksi biasa
                                            <option value="1.5"> Konstruksi kerangka kayu (mudah terbakar)
                                        </select>

                                        <input class="span2" name="angka_kostruksi1" value="" id="faktor-konstruksi_tanpa" type="text" readonly="readonly"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="volume">Volume Bangunan :</label>
                                    <div class="controls">
                                        <input name="panjang1"class="span2" id="panjang_tanpa" type="text" placeholder="Panjang" value=""/> x
                                        <input name="lebar1" class="span2" id="lebar_tanpa" type="text" placeholder="Lebar" value=""/> x
                                        <input name="tinggi1" class="span2" id="tinggi_tanpa" type="text" placeholder="Tinggi" value=""/> (Satuan meter)&nbsp;<strong class="red">**</strong>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                    <div class="controls">
                                        <input class="span3" id="hasil_tanpa" name="hasil1" type="text" value="" readonly/> &nbsp;US Galon atau
                                        <input class="span2" id="hasil_tanpa1" type="text" value="" readonly/> &nbsp;m<sup>3</sup>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="volume"><small><u><strong>Note :</strong></u></small></label>
                                    <label for="note">&nbsp;&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Semaikin kecil nilai tipe banguanan semakin berbahaya kebakaran yang terjadi.</small></label>
                                    <label for="note">&nbsp;&nbsp;<strong class="red">**</strong>&nbsp;&nbsp; <small>Gunakan . (titik) untuk koma.</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dengan Faktor Bahaya -->
            <div class="span6" id="widget_dengan">
                <div class="widget-box transparent">
                    <div class="widget-body">
                        <div class="widget-main padding-4">
                            <div class="content">
                                <div class="space-6"></div>
                                <p align="center" class="text-error">
                                    Pasokan Air Minuman Dengan Resiko Bangunan Berdekatan.
                                <hr>
                                </p>

                                <div class="control-group">
                                    Rumus Pasokan Air Minimum :
                                    <p align="center">
                                        <img src="../assets/img/pam2.jpg">
                                    </p>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="tipe-bangunan">Tipe Bangunan :<br /> <small>(Angka Klasifikasi Resiko Kebakaran)</small></label>
                                    <?php
                                    $bangunan2 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                                    ?>
                                    <div class="controls">
                                        <select id="bangunan_dengan" onchange="run();
                                                document.getElementById('nama_tipe2').value = this.options[this.selectedIndex].text">
                                            <option value="" />Pilih Bangunan...
                                            <?php while ($r = mysql_fetch_array($bangunan2)): ?>
                                                <option value="<?php echo $r['TINGKAT_BANGUNAN']; ?>"><?php echo $r['NAMA_BANGUNAN']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                        <input type="hidden" name="nama_tipe2" id="nama_tipe2" value="" />
                                        <input class="span2" id="angka_dengan" name="nilai_bangunan2" type="text" value="" readonly="readonly"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class = "control-label">Tipe bangunan tidak terdapat dalam list ? </label>

                                    <div class="controls">
                                        <label class="inline">
                                            <input name="check2" type = "checkbox" onclick="showMe_('tipe_baru2')" class="ace-switch ace-switch-5"/>
                                            <span class="lbl"></span>
                                        </label><strong class="red">*</strong>
                                    </div>
                                </div>

                                <div id="tipe_baru2" style="display:none">
                                    <div class = "control-group">
                                        <label class = "control-label" for = "nama_tipe_baru2">Tipe bangunan baru:</label>

                                        <div class = "controls">
                                            <input type = "text" id="nama_tipe_baru2" name = "nama_tipe_baru2" />
                                            <select name = "nilai_tipe_baru2" id="nilai_tipe_baru2" class="span2">
                                                <option value="">---
                                                <option value="3"> 3
                                                <option value="4"> 4
                                                <option value="5"> 5
                                                <option value="6"> 6
                                                <option value="7"> 7
                                            </select>
                                            &nbsp;<strong class="red">*</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                                    <div class="controls">
                                        <select name="angka_konstruksi2" id="angka-kostruksi_dengan" onchange="go();">
                                            <option value="" />Pilih Faktor Bahaya...
                                            <option value="0.5"> Konstruksi tahan api
                                            <option value="0.75"> Konstruksi kayu berat (tidak mudah terbakar)
                                            <option value="1.0"> Konstruksi biasa
                                            <option value="1.5"> Konstruksi kerangka kayu (mudah terbakar)
                                        </select>

                                        <input name="angka_kostruksi2" class="span2" value="" id="faktor-konstruksi_dengan" type="text" readonly="readonly"/>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="faktor-bahaya">Faktor bahaya dari bangunan berdekatan bernilai : 1.5 kali </label>
                                    <input class="span3" type="hidden" name="faktor-bahaya" id="faktor-bahaya_dengan" value="1.5" />
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="volume">Volume Bangunan :</label>
                                    <div class="controls">
                                        <input name="panjang2" class="span2" id="panjang_dengan" type="text" placeholder="Panjang" /> x
                                        <input name="lebar2" class="span2" id="lebar_dengan" type="text" placeholder="Lebar" /> x
                                        <input class="span2" name="tinggi2" id="tinggi_dengan" type="text" placeholder="Tinggi" /> (Satuan meter)&nbsp;<strong class="red">**</strong>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                    <div class="controls">
                                        <input class="span3" id="hasil_dengan" name="hasil2" type="text" value="" readonly/> &nbsp;US Galon atau
                                        <input class="span2" id="hasil_dkubik"  type="text" value="" readonly/> &nbsp;m<sup>3</sup>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="volume"><small><u><strong>Note :</strong></u></small></label>
                                    <label for="note">&nbsp;&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Semaikin kecil nilai tipe banguanan semakin berbahaya kebakaran yang terjadi.</small></label>
                                    <label for="note">&nbsp;&nbsp;<strong class="red">**</strong>&nbsp;&nbsp; <small>Gunakan . (titik) untuk koma.</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row fliud -->
    </div>
</form>
<!-- Lokasi -->
<div class="row-fluid form-horizontal">
    <div class="span12">
        <div class="span6">
            <div class="widget-box transparent">
                <div class="widget-header header-color-blue2">
                    <h3>Lokasi Kejadian Kebakaran</h3>
                </div>

                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="content">
                            <div class="space-6"></div>
                            <div id="frm-lokasi">
                                <div class="control-group">
                                    <label class="control-label" for="kecamatan">Pilih Kecamatan : </label>
                                    <?php
                                    $query_parent = mysql_query("SELECT * FROM kecamatan") or die("Query failed: " . mysql_error());
                                    ?>
                                    <div class="controls">
                                        <span>
                                            <select name="kecamatan" id="kecamatan" data-placeholder="Pilih Kecamatan...">
                                                <option value="" />Pilih Kecamatan...
                                                <?php while ($row = mysql_fetch_array($query_parent)): ?>
                                                    <option value="<?= $row['KECAMATAN_ID']; ?>"><?php echo $row['KECAMATAN_NAMA']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="desa">Pilih Desa : </label>
                                    <div class="controls">
                                        <span>
                                            <select name="desa" id="desa">
                                                <option value=""  />PIlih Desa...
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="sumber_air">Sumber Air : </label>
                                    <div class="controls">
                                        <span>
                                            <input type="hidden" name="sumber_air" id="text_content" value="" />
                                            <select id="sumber_air" name="sumber_air_" onchange="document.getElementById('text_content').value = this.options[this.selectedIndex].text">
                                                <option value="" />Sumber Air...
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="sumber_air">Tipe Proteksi Kebakaran : </label>
                                    <div class="controls">
                                        <span>
                                            <select id="tipe_proteksi" name="tipe_proteksi">
                                                <option value="" />Tipe Proteksi...
                                                <option value="MPKP" >MPKP (Kota)
                                                <option value="MPKL" >MPKL (Lingkungan)
                                                <option value="MPKBG" >MPKBG (Bangunan Gedung)
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Jumlah Kebutuhan Air :</label>

                                    <div class="controls">
                                        <span class="span12">
                                            <label>
                                                <input onchange='check_value();' name="exposure" value="1" type="radio"/>
                                                <span class="lbl"> 
                                                    <b class="text-error">Tanpa</b> resiko bangunan berdekatan. 
                                                    <a href="#tanpa" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="top" title="More details.">?</span></a>
                                                </span>
                                            </label>

                                            <label>
                                                <input onchange='check_value();' name="exposure" value="2" type="radio"/>
                                                <span class="lbl"> 
                                                    <b class="text-error">Dengan</b> resiko bangunan berdekatan. 
                                                    <a href="#dengan" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="bottom" title="More details.">?</span></a>
                                                </span>
                                            </label>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label red">Penggunaan Bahan Khusus Pemadam Api: </label>

                                    <div class="controls">
                                        <span class="span12">
                                            <label>
                                                <input name="tepol" value="Menggunkan Tepol (Cairan Basa)" type="radio"/>
                                                <span class="lbl">
                                                    Ya
                                                </span>
                                            </label>
                                            <label>
                                                <input name="tepol" value="Tidak Menggunakan Tepol" type="radio"/>
                                                <span class="lbl">
                                                    Tidak
                                                </span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tanpa Faktor Bahaya -->
        <div class="span6" id="widget_tanpa">
            <div class="widget-box transparent">
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="content">
                            <div class="space-6"></div>
                            <p align="center" class="text-error">
                                Pasokan Air Minuman Tanpa Resiko Bangunan Berdekatan.
                            <hr>
                            </p>

                            <div class="control-group">
                                Rumus Pasokan Air Minimum :
                                <p align="center">
                                    <img src="../assets/img/pam1.jpg">
                                </p>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="tipe-bangunan">Tipe Bangunan :<br /> <small>(Angka Klasifikasi Resiko Kebakaran)</small></label>
                                <?php
                                $bangunan1 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                                ?>
                                <div class="controls">
                                    <select id="bangunan_tanpa" onchange="run();
                                            document.getElementById('nama_tipe1').value = this.options[this.selectedIndex].text" data-placeholder="Pilih Bangunan...">
                                        <option value="" />Pilih Bangunan...
                                        <?php while ($r = mysql_fetch_array($bangunan1)): ?>
                                            <option value="<?php echo $r['TINGKAT_BANGUNAN']; ?>"><?php echo $r['NAMA_BANGUNAN']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <input type="hidden" name="nama_tipe1" id="nama_tipe1" value="" />
                                    <input name="nilai_bangunan1" class="span2" id="angka_tanpa" type="number" value="" readonly="readonly"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class = "control-label">Tipe bangunan tidak terdapat dalam list ? </label>

                                <div class="controls">
                                    <label class="inline">
                                        <input name="check" type = "checkbox" onclick="showMe('tipe_baru')" class="ace-switch ace-switch-5"/>
                                        <span class="lbl"></span>
                                    </label><strong class="red">*</strong>
                                </div>
                            </div>


                            <div id="tipe_baru" style="display:none">
                                <div class = "control-group">
                                    <label class = "control-label" for = "nama_tipe_baru">Tipe bangunan baru:</label>

                                    <div class = "controls">
                                        <input type = "text" id="nama_tipe_baru1" name = "nama_tipe_baru1" />
                                        <select name = "nilai_tipe_baru1" id="nilai_tipe_baru1" class="span2">
                                            <option value="">---
                                            <option value="3"> 3
                                            <option value="4"> 4
                                            <option value="5"> 5
                                            <option value="6"> 6
                                            <option value="7"> 7
                                        </select>
                                        &nbsp;<strong class="red">*</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                                <div class="controls">
                                    <select name="angka_konstruksi1" id="angka-kostruksi_tanpa" onchange="go();">
                                        <option value="" />Pilih Faktor Bahaya...
                                        <option value="0.5"> Konstruksi tahan api
                                        <option value="0.75"> Konstruksi kayu berat (tidak mudah terbakar)
                                        <option value="1.0"> Konstruksi biasa
                                        <option value="1.5"> Konstruksi kerangka kayu (mudah terbakar)
                                    </select>

                                    <input class="span2" name="angka_kostruksi1" value="" id="faktor-konstruksi_tanpa" type="text" readonly="readonly"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="volume">Volume Bangunan :</label>
                                <div class="controls">
                                    <input name="panjang1"class="span2" id="panjang_tanpa" type="text" placeholder="Panjang" value=""/> x
                                    <input name="lebar1" class="span2" id="lebar_tanpa" type="text" placeholder="Lebar" value=""/> x
                                    <input name="tinggi1" class="span2" id="tinggi_tanpa" type="text" placeholder="Tinggi" value=""/> (Satuan meter)&nbsp;<strong class="red">**</strong>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                <div class="controls">
                                    <input class="span3" id="hasil_tanpa" name="hasil1" type="text" value="" readonly/> &nbsp;US Galon atau
                                    <input class="span2" id="hasil_tanpa1" type="text" value="" readonly/> &nbsp;m<sup>3</sup>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="volume"><small><u><strong>Note :</strong></u></small></label>
                                <label for="note">&nbsp;&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Semaikin kecil nilai tipe banguanan semakin berbahaya kebakaran yang terjadi.</small></label>
                                <label for="note">&nbsp;&nbsp;<strong class="red">**</strong>&nbsp;&nbsp; <small>Gunakan . (titik) untuk koma.</small></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dengan Faktor Bahaya -->
        <div class="span6" id="widget_dengan">
            <div class="widget-box transparent">
                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="content">
                            <div class="space-6"></div>
                            <p align="center" class="text-error">
                                Pasokan Air Minuman Dengan Resiko Bangunan Berdekatan.
                            <hr>
                            </p>

                            <div class="control-group">
                                Rumus Pasokan Air Minimum :
                                <p align="center">
                                    <img src="../assets/img/pam2.jpg">
                                </p>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="tipe-bangunan">Tipe Bangunan :<br /> <small>(Angka Klasifikasi Resiko Kebakaran)</small></label>
                                <?php
                                $bangunan2 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                                ?>
                                <div class="controls">
                                    <select id="bangunan_dengan" onchange="run();
                                            document.getElementById('nama_tipe2').value = this.options[this.selectedIndex].text">
                                        <option value="" />Pilih Bangunan...
                                        <?php while ($r = mysql_fetch_array($bangunan2)): ?>
                                            <option value="<?php echo $r['TINGKAT_BANGUNAN']; ?>"><?php echo $r['NAMA_BANGUNAN']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <input type="hidden" name="nama_tipe2" id="nama_tipe2" value="" />
                                    <input class="span2" id="angka_dengan" name="nilai_bangunan2" type="text" value="" readonly="readonly"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class = "control-label">Tipe bangunan tidak terdapat dalam list ? </label>

                                <div class="controls">
                                    <label class="inline">
                                        <input name="check2" type = "checkbox" onclick="showMe_('tipe_baru2')" class="ace-switch ace-switch-5"/>
                                        <span class="lbl"></span>
                                    </label><strong class="red">*</strong>
                                </div>
                            </div>

                            <div id="tipe_baru2" style="display:none">
                                <div class = "control-group">
                                    <label class = "control-label" for = "nama_tipe_baru2">Tipe bangunan baru:</label>

                                    <div class = "controls">
                                        <input type = "text" id="nama_tipe_baru2" name = "nama_tipe_baru2" />
                                        <select name = "nilai_tipe_baru2" id="nilai_tipe_baru2" class="span2">
                                            <option value="">---
                                            <option value="3"> 3
                                            <option value="4"> 4
                                            <option value="5"> 5
                                            <option value="6"> 6
                                            <option value="7"> 7
                                        </select>
                                        &nbsp;<strong class="red">*</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                                <div class="controls">
                                    <select name="angka_konstruksi2" id="angka-kostruksi_dengan" onchange="go();">
                                        <option value="" />Pilih Faktor Bahaya...
                                        <option value="0.5"> Konstruksi tahan api
                                        <option value="0.75"> Konstruksi kayu berat (tidak mudah terbakar)
                                        <option value="1.0"> Konstruksi biasa
                                        <option value="1.5"> Konstruksi kerangka kayu (mudah terbakar)
                                    </select>

                                    <input name="angka_kostruksi2" class="span2" value="" id="faktor-konstruksi_dengan" type="text" readonly="readonly"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="faktor-bahaya">Faktor bahaya dari bangunan berdekatan bernilai : 1.5 kali </label>
                                <input class="span3" type="hidden" name="faktor-bahaya" id="faktor-bahaya_dengan" value="1.5" />
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="volume">Volume Bangunan :</label>
                                <div class="controls">
                                    <input name="panjang2" class="span2" id="panjang_dengan" type="text" placeholder="Panjang" /> x
                                    <input name="lebar2" class="span2" id="lebar_dengan" type="text" placeholder="Lebar" /> x
                                    <input class="span2" name="tinggi2" id="tinggi_dengan" type="text" placeholder="Tinggi" /> (Satuan meter)&nbsp;<strong class="red">**</strong>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                                <div class="controls">
                                    <input class="span3" id="hasil_dengan" name="hasil2" type="text" value="" readonly/> &nbsp;US Galon atau
                                    <input class="span2" id="hasil_dkubik"  type="text" value="" readonly/> &nbsp;m<sup>3</sup>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="volume"><small><u><strong>Note :</strong></u></small></label>
                                <label for="note">&nbsp;&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Semaikin kecil nilai tipe banguanan semakin berbahaya kebakaran yang terjadi.</small></label>
                                <label for="note">&nbsp;&nbsp;<strong class="red">**</strong>&nbsp;&nbsp; <small>Gunakan . (titik) untuk koma.</small></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row fliud -->
</div><!-- end span12 -->
<!--end lokasi-->
<!--laju-->
<div class="row-fluid">
    <div class="span12">
        <div class="widget-box transparent">
            <div class="widget-header header-color-blue2">
                <h3>
                    Perhitungan Laju Penerapan Air
                    <a href="#penerapan" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="bottom" title="More details.">?</span></a>
                </h3>
                <div class="widget-toolbar">
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-4">
                    <div class="content">
                        <div class="span6 center">
                            <div class="space-6"></div>
                            <img src="../assets/img/pengirimanAir.JPG" width="" height="" >
                        </div>
                        <div class="span6 form-horizontal">
                            <div class="space-6"></div>
                            <div class="control-group">
                                <label class="control-label" for="volume">Volume Bangunan :</label>
                                <div class="controls">
                                    <input readonly name="panjang_volume" class="span2" id="panjang_volume" type="text" placeholder="p" /> x
                                    <input readonly name="lebar_volume" class="span2" id="lebar_volume" type="text" placeholder="l" /> x
                                    <input readonly name="tinggi_volume" class="span2" id="tinggi_volume" type="text" placeholder="t" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="desa">Laju Penerapan Air :</label>
                                <div class="controls">
                                    <input class="span3" id="hasil_laju"  type="text" value="" readonly/> &nbsp;m<sup>3</sup> atau 
                                    <input class="span3" id="hasil_laju"  type="text" value="" readonly/> &nbsp;US Galon
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end widget-body -->
        </div>
    </div><!-- end span12 -->
</div>
<!--end laju-->
<!--potensi-->
<div class="row-fluid">
    <div class="span12">
        <div class="widget-box transparent">
            <div class="widget-header header-color-blue2">
                <h3>
                    Perhitungan Potensi Pengangkutan Air
                </h3>
                <div class="widget-toolbar">
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-4">
                    <div class="content">
                        <div class="span6">
                            <div class="space-6"></div>
                            <img src="../assets/img/potensi.JPG" width="400" height="500" >
                        </div>
                        <div class="span6 form-horizontal">
                            <div class="space-6"></div>
                            <div class="control-group">
                                <label class="control-label" for="volume">Kapasitas Air Kendaraan Damkar (V):</label>
                                <div class="controls">
                                    <input name="v_potensi" id="volume" type="text" placeholder="liter . . ." />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="a">Waktu Pengisian Kendaraan Pemasok Air (A) :</label>
                                <div class="controls">
                                    <input name="a_potensi" id="a" type="text" placeholder="menit . . ." />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="kecepatan">Kecepatan Konstan Kendaraan :</label>
                                <div class="controls">
                                    <input name="kecepatan" id="kecepatan" type="text" placeholder="km/jam . . ." />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="jarak1">Jarak Lokasi ke Sumber Air (D1) :</label>
                                <div class="controls">
                                    <input name="jarak1" id="jarak1" type="text" placeholder="kilometer . . ." />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="jarak2">Jarak Lokasi Kembali dari Sumber Air (D2):</label>
                                <div class="controls">
                                    <input name="jarak2" id="jarak2" type="text" placeholder="kilometer . . ." />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="t1">T1 :&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <div class="controls">
                                    <input name="t1_potensi" id="t1" type="text" placeholder="menit . . ." />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="t2">T2 :&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <div class="controls">
                                    <input name="t2_potensi" id="t2" type="text" placeholder="menit . . ." />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="b">Waktu Pengisian ke Tangki Portable (B) :</label>
                                <div class="controls">
                                    <input name="b_potensi" id="b" type="text" placeholder="menit . . ." />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- end widget-body -->
        </div>
    </div><!-- end span12 -->
</div>
<!--end potensi-->
<!--result-->
<div class="row-fluid">
    <div class="span12">
        <div class="span6">
            <div class="widget-box transparent">
                <div class="widget-header header-color-blue2">
                    <h3>Lokasi Kejadian Kebakaran</h3>
                    <div class="widget-toolbar">
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main padding-4">
                        <div class="content">
                            <div class="space-6"></div>
                            <div id="frm-lokasi">
                                <div class="control-group">
                                    <label class="control-label" for="kecamatan">Pilih Kecamatan : </label>
                                    <?php
                                    $query_parent = mysql_query("SELECT * FROM kecamatan") or die("Query failed: " . mysql_error());
                                    ?>
                                    <div class="controls">
                                        <span>
                                            <select name="kecamatan" id="kecamatan" data-placeholder="Pilih Kecamatan...">
                                                <option value="" />Pilih Kecamatan...
                                                <?php while ($row = mysql_fetch_array($query_parent)): ?>
                                                    <option value="<?= $row['KECAMATAN_ID']; ?>"><?php echo $row['KECAMATAN_NAMA']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="desa">Pilih Desa : </label>
                                    <div class="controls">
                                        <span>
                                            <select name="desa" id="desa">
                                                <option value=""  />PIlih Desa...
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="sumber_air">Sumber Air : </label>
                                    <div class="controls">
                                        <span>
                                            <input type="hidden" name="sumber_air" id="text_content" value="" />
                                            <select id="sumber_air" name="sumber_air_" onchange="document.getElementById('text_content').value = this.options[this.selectedIndex].text">
                                                <option value="" />Sumber Air...
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="sumber_air">Tipe Proteksi Kebakaran : </label>
                                    <div class="controls">
                                        <span>
                                            <select id="tipe_proteksi" name="tipe_proteksi">
                                                <option value="" />Tipe Proteksi...
                                                <option value="MPKP" >MPKP (Kota)
                                                <option value="MPKL" >MPKL (Lingkungan)
                                                <option value="MPKBG" >MPKBG (Bangunan Gedung)
                                            </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Jumlah Kebutuhan Air :</label>

                                    <div class="controls">
                                        <span class="span12">
                                            <label>
                                                <input onchange='check_value();' name="exposure" value="1" type="radio"/>
                                                <span class="lbl"> 
                                                    <b class="text-error">Tanpa</b> resiko bangunan berdekatan. 
                                                    <a href="#tanpa" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="top" title="More details.">?</span></a>
                                                </span>
                                            </label>

                                            <label>
                                                <input onchange='check_value();' name="exposure" value="2" type="radio"/>
                                                <span class="lbl"> 
                                                    <b class="text-error">Dengan</b> resiko bangunan berdekatan. 
                                                    <a href="#dengan" role="button" class="green" data-toggle="modal"> <span class="help-button" data-rel="tooltip" data-placement="bottom" title="More details.">?</span></a>
                                                </span>
                                            </label>
                                        </span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label red">Penggunaan Bahan Khusus Pemadam Api: </label>

                                        <div class="controls">
                                            <span class="span12">
                                                <label>
                                                    <input name="tepol" value="Menggunkan Tepol (Cairan Basa)" type="radio"/>
                                                    <span class="lbl">
                                                        Ya
                                                    </span>
                                                </label>
                                                <label>
                                                    <input name="tepol" value="Tidak Menggunakan Tepol" type="radio"/>
                                                    <span class="lbl">
                                                        Tidak
                                                    </span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tanpa Faktor Bahaya -->
        <div class="span6">
            <div class="space-6"></div>
            <p align="center" class="text-error">
                Pasokan Air Minuman Tanpa Resiko Bangunan Berdekatan.
            <hr>
            </p>

            <div class="control-group">
                Rumus Pasokan Air Minimum :
                <p align="center">
                    <img src="../assets/img/pam1.jpg">
                </p>
            </div>

            <div class="control-group">
                <label class="control-label" for="tipe-bangunan">Tipe Bangunan :<br /> <small>(Angka Klasifikasi Resiko Kebakaran)</small></label>
                <?php
                $bangunan1 = mysql_query("SELECT * FROM bangunan ORDER BY NAMA_BANGUNAN ASC") or die("Query failed: " . mysql_error());
                ?>
                <div class="controls">
                    <select id="bangunan_tanpa" onchange="run();
                            document.getElementById('nama_tipe1').value = this.options[this.selectedIndex].text" data-placeholder="Pilih Bangunan...">
                        <option value="" />Pilih Bangunan...
                        <?php while ($r = mysql_fetch_array($bangunan1)): ?>
                            <option value="<?php echo $r['TINGKAT_BANGUNAN']; ?>"><?php echo $r['NAMA_BANGUNAN']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <input type="hidden" name="nama_tipe1" id="nama_tipe1" value="" />
                    <input name="nilai_bangunan1" class="span2" id="angka_tanpa" type="number" value="" readonly="readonly"/>
                </div>
            </div>

            <div class="control-group">
                <label class = "control-label">Tipe bangunan tidak terdapat dalam list ? </label>

                <div class="controls">
                    <label class="inline">
                        <input name="check" type = "checkbox" onclick="showMe('tipe_baru')" class="ace-switch ace-switch-5"/>
                        <span class="lbl"></span>
                    </label><strong class="red">*</strong>
                </div>
            </div>


            <div id="tipe_baru" style="display:none">
                <div class = "control-group">
                    <label class = "control-label" for = "nama_tipe_baru">Tipe bangunan baru:</label>

                    <div class = "controls">
                        <input type = "text" id="nama_tipe_baru1" name = "nama_tipe_baru1" />
                        <select name = "nilai_tipe_baru1" id="nilai_tipe_baru1" class="span2">
                            <option value="">---
                            <option value="3"> 3
                            <option value="4"> 4
                            <option value="5"> 5
                            <option value="6"> 6
                            <option value="7"> 7
                        </select>
                        &nbsp;<strong class="red">*</strong>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="angka-kostruksi">Angka Klasifikasi Konstruksi  :</label>
                <div class="controls">
                    <select name="angka_konstruksi1" id="angka-kostruksi_tanpa" onchange="go();">
                        <option value="" />Pilih Faktor Bahaya...
                        <option value="0.5"> Konstruksi tahan api
                        <option value="0.75"> Konstruksi kayu berat (tidak mudah terbakar)
                        <option value="1.0"> Konstruksi biasa
                        <option value="1.5"> Konstruksi kerangka kayu (mudah terbakar)
                    </select>

                    <input class="span2" name="angka_kostruksi1" value="" id="faktor-konstruksi_tanpa" type="text" readonly="readonly"/>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="volume">Volume Bangunan :</label>
                <div class="controls">
                    <input name="panjang1"class="span2" id="panjang_tanpa" type="text" placeholder="Panjang" value=""/> x
                    <input name="lebar1" class="span2" id="lebar_tanpa" type="text" placeholder="Lebar" value=""/> x
                    <input name="tinggi1" class="span2" id="tinggi_tanpa" type="text" placeholder="Tinggi" value=""/> (Satuan meter)&nbsp;<strong class="red">**</strong>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="volume">Pasokan Air Minimum :</label>
                <div class="controls">
                    <input class="span3" id="hasil_tanpa" name="hasil1" type="text" value="" readonly/> &nbsp;US Galon atau
                    <input class="span2" id="hasil_tanpa1" type="text" value="" readonly/> &nbsp;m<sup>3</sup>
                </div>
            </div>
            <div class="control-group">
                <label for="volume"><small><u><strong>Note :</strong></u></small></label>
                <label for="note">&nbsp;&nbsp;<strong class="red">*</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>Semaikin kecil nilai tipe banguanan semakin berbahaya kebakaran yang terjadi.</small></label>
                <label for="note">&nbsp;&nbsp;<strong class="red">**</strong>&nbsp;&nbsp; <small>Gunakan . (titik) untuk koma.</small></label>
            </div>
        </div>
    </div>
</div>
<!--end result-->
<script type="text/javascript">
    $('.nexttab').click(function() {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.prevtab').click(function() {
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });
</script>
<script type="text/javascript">
    //var tabs = $("#tabs").tabs({
    //select: function(event, ui) {
    //  var valid = true;
    //var current = $(this).tabs("option", "selected");
    //var panelId = $("#tabs ul a").eq(current).attr("href");

    /*$(panelId).find("input").each(function() {
     console.log(valid);
     if (!validator.element(this) && valid) {
     valid = false;
     }
     });*/

    /*return valid;
     }
     });
     
     $(".nexttab").click(function() {                 $("#tabs").tabs("select", this.hash);
     });
     
     $(".prevtab").click(function() {                 $("#tabs").tabs("select", this.hash);
     });*/

    /*$('.nexttab').click(function() {
     $('.nav-tabs > .active').next('li').find('a').trigger('click');
     });
     
     $('.prevtab').click(function() {
     $('.nav-tabs > .active').prev('li').find('a').trigger('click');
     });*/

    $(function() {
        $("#tabs").tabs();
    });
</script>
<script type="text/javascript">
    var codeMap = {'1': '../assets/img/sda/large/balongbendo.png',
        '2': '../assets/img/sda/large/buduran.png',
        '3': '../assets/img/sda/large/candi.png',
        '4': '../assets/img/sda/large/gedangan.png',
        '5': '../assets/img/sda/large/jabon.png',
        '6': '../assets/img/sda/large/krembung.png',
        '7': '../assets/img/sda/large/krian.png',
        '8': '../assets/img/sda/large/porong.png',
        '9': '../assets/img/sda/large/prambon.png',
        '10': '../assets/img/sda/large/sedati.png',
        '11': '../assets/img/sda/large/sidoarjo.png',
        '12': '../assets/img/sda/large/sukodono.png',
        '13': '../assets/img/sda/large/taman.png',
        '14': '../assets/img/sda/large/tanggulangin.png',
        '15': '../assets/img/sda/large/tarik.png',
        '16': '../assets/img/sda/large/tulangan.png',
        '17': '../assets/img/sda/large/waru.png',
        '18': '../assets/img/sda/large/wonoayu.png'
    };

    $(function() {
        $('area').on('click', function() {
            updateSelection($(this).attr('id'));
        });
        $('#kecamatan').on('change', function() {
            updateSelection($(this).val());
        });
    });

    function updateSelection(code) {
        $('#gambar2').attr('src', codeMap[code]);
        $('#kecamatan').val(code);
    }
</script>
<script type="text/javascript">
// ========================Jam========================================== //
    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "AM";
        } else {
            a_p = "PM";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);
// ========================Akhir Jam========================================== //

    function showMe(box) {

        var chboxs = document.getElementsByName("check");
        var vis = "none";
        for (var i = 0; i < chboxs.length; i++) {
            if (chboxs[i].checked) {
                vis = "block";
                break;
            }
        }
        document.getElementById(box).style.display = vis;
    }

    function showMe_(box) {

        var chboxs = document.getElementsByName("check2");
        var vis = "none";
        for (var i = 0; i < chboxs.length; i++) {
            if (chboxs[i].checked) {
                vis = "block";
                break;
            }
        }
        document.getElementById(box).style.display = vis;
    }

    $(document).ready(function() {

        $("#desa").change(function() {
            $(this).after('<span class="help-inline pull-right"><i class="icon-spinner icon-spin blue bigger-300" id="loader"></i></span>');
            $.get('asumber.php?sumber=' + $(this).val(), function(data) {
                $("#sumber_air").html(data);
                $('#loader').slideUp(200, function() {
                    $(this).remove();
                });
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#kecamatan").change(function() {
            $(this).after('<span class="help-inline pull-right"><i class="icon-spinner icon-spin blue bigger-300" id="loader"></i></span>');
            $.get('akec.php?kecamatan=' + $(this).val(), function(data) {
                $("#desa").html(data);
                $('#loader').slideUp(200, function() {
                    $(this).remove();
                });
            });
        });
    });

    function run() {
        document.getElementById("angka_tanpa").value = document.getElementById("bangunan_tanpa").value;
        document.getElementById("angka_dengan").value = document.getElementById("bangunan_dengan").value;
    }

    function go() {
        document.getElementById("faktor-konstruksi_tanpa").value = document.getElementById("angka-kostruksi_tanpa").value;
        document.getElementById("faktor-konstruksi_dengan").value = document.getElementById("angka-kostruksi_dengan").value;
    }

    $(function() {
        $(".chzn-select").chosen();
    });
    // scrollables
    $('.slim-scroll').each(function() {
        var $this = $(this);
        $this.slimScroll({
            height: $this.data('height') || 100,
            railVisible: true
        });
    });
    function myFunction()
    {
        window.location.reload();
    }

    var radio = document.getElementsByName("exposure");
    var widgetTanpa = document.getElementById("widget_tanpa");
    var widgetDengan = document.getElementById("widget_dengan");
    widgetTanpa.style.display = "none";  // hide
    widgetDengan.style.display = "none";  // hide
    for (var i = 0; i < radio.length; i++) {
        radio[i].onclick = function() {
            var val = this.value;
            if (val == '1') {
                widgetTanpa.style.display = 'block';
                widgetDengan.style.display = 'none';
                //angka.style.visibility = "hidden";
            }
            else if (val == '2') {
                widgetTanpa.style.display = 'none';
                widgetDengan.style.display = 'block';
                //angka.style.visibility = "visible";
            }

        }
    }
</script>
<script>
    $(document).ready(function()
    {
        function rumusTanpa()
        {
            var p1 = parseFloat($("#panjang_tanpa").val());
            var l1 = parseFloat($("#lebar_tanpa").val());
            var t1 = parseFloat($("#tinggi_tanpa").val());
            var angka1 = parseFloat($("#angka_tanpa").val());
            var faktor1 = parseFloat($("#faktor-konstruksi_tanpa").val());
            var total1 = (p1 * 3.2808399) * (l1 * 3.2808399) * (t1 * 3.2808399) / angka1 * faktor1;
            $("#hasil_tanpa").val(Math.round(total1));
            var total1_fixed = Math.round(total1) / 264.172052;
            var hasil = total1_fixed.toFixed(1);
            $("#hasil_tanpa1").val(hasil);
        }
        $(document).on("change, keyup", "#faktor-konstruksi_tanpa,#angka_tanpa,#panjang_tanpa, #tinggi_tanpa, #lebar_tanpa", rumusTanpa);
    });
</script>
<script>
    $(document).ready(function()
    {
        function rumusDengan()
        {
            var p = parseFloat($("#panjang_dengan").val());
            var l = parseFloat($("#lebar_dengan").val());
            var t = parseFloat($("#tinggi_dengan").val());
            var angka = parseFloat($("#angka_dengan").val());
            var faktor = parseFloat($("#faktor-konstruksi_dengan").val());
            var bahaya = parseFloat($("#faktor-bahaya_dengan").val());
            var total = Math.round(p * 3.2808399) * Math.round(l * 3.2808399) * Math.round(t * 3.2808399) / angka * faktor * bahaya;
            $("#hasil_dengan").val(Math.round(total));
            var total_fixed = Math.round(total) / 264.172052;
            var hasil = total_fixed.toFixed(1);
            $("#hasil_dkubik").val(hasil);
        }
        $(document).on("change, keyup", "#faktor-bahaya_dengan,#faktor-konstruksi_dengan,#angka_dengan,#panjang_dengan, #tinggi_dengan, #lebar_dengan", rumusDengan);
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#validation-form').show();
        //documentation : http://docs.jquery.com/Plugins/Validation/validate
        $('#validation-form').validate({
            errorElement: 'span',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                kecamatan: {
                    required: true
                },
                nama_tipe_baru1: {
                    required: true
                },
                nilai_tipe_baru1: {
                    required: true
                },
                nama_tipe_baru2: {
                    required: true
                },
                nilai_tipe_baru2: {
                    required: true
                },
                desa: {
                    required: true
                },
                sumber_air_: {
                    required: true
                },
                exposure: {
                    required: true
                },
                tipe_proteksi: {
                    required: true
                },
                nilai_bangunan1: {
                    required: true
                },
                nilai_bangunan2: {
                    required: true
                },
                angka_kostruksi1: {
                    required: true
                },
                angka_kostruksi2: {
                    required: true
                },
                tinggi1: {
                    required: true
                },
                tinggi2: {
                    required: true
                },
                tepol: {
                    required: true
                }
            },
            messages: {
                kecamatan: "Mohon untuk memilih lokasi kecamatan.",
                desa: "Mohon untuk memilih lokasi desa.",
                sumber_air_: "Mohon untuk memilih sumber air.",
                tipe_proteksi: "Mohon untuk memilih tipe proteksi kebakaran.",
                exposure: "Mohon untuk memilih.",
                tepol: "Mohon untuk memilih."
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-error', $('.login-form')).show();
            },
            highlight: function(e) {
                $(e).closest('.control-group').removeClass('info').addClass('error');
            },
            success: function(e) {
                $(e).closest('.control-group').removeClass('error').addClass('info');
                $(e).remove();
            },
            errorPlacement: function(error, element) {
                if (element.is(':checkbox') || element.is(':radio')) {
                    var controls = element.closest('.controls');
                    if (controls.find(':checkbox,:radio').length > 1)
                        controls.append(error);
                    else
                        error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if (element.is('.chzn-select')) {
                    error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                }
                else
                    error.insertAfter(element);
            },
            submitHandler: function(form) {
                var url = "Fanalisis/analisisProses.php";

                // mengambil nilai dari inputbox, textbox dan select
                var v_kec = $('select[name=kecamatan]').val();
                var v_air = $('select[name=sumber_air]').val();
                var v_desa = $('select[name=desa]').val();
                var v_bangunan1 = $('input:text[name=nilai_bangunan1]').val();
                var v_bangunan2 = $('input:text[name=nilai_bangunan2]').val();
                var v_akons1 = $('select[name=angka_konstruksi1]').val();
                var v_akons2 = $('select[name=angka_konstruksi2]').val();
                var v_tinggi1 = $('input:text[name=tinggi1]').val();
                var v_tinggi2 = $('input:text[name=tinggi2]').val();
                var v_exposure = $('input:radio[name=exposure]').val();
                var v_tepol = $('input:radio[name=tepol]').val();
                //var v_hasil1 = $('input:text[name=hasil1]').val();
                //var v_hasil2 = $('input:text[name=hasil2]').val();

                $.post(url, {tinggi2: v_tinggi2, desa: v_desa, kecamatan: v_kec, sumber_air: v_air, nilai_bangunan1: v_bangunan1, nilai_bangunan2: v_bangunan2, angka_konstruksi1: v_akons1, angka_konstruksi2: v_akons2, tinggi1: v_tinggi1, exposure: v_exposure, tepol: v_tepol, hasil1: v_hasil1, hasil2: v_hasil2}, function() {

                })
            },
            invalidHandler: function(form) {
            }
        });
    });

    $(function() {
        $(".chzn-select").chosen();
    });

    $(function() {
        ///////////////////////////////////////////
        $('#user-profile-3').end().find('button[type=reset]').on(ace.click_event, function() {
            $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
        })
    });
</script>
<table>
    <tr>
        <td>Product 1</td>
        <td>
            <input type="number" id="product1" class="formnumbers" name="ProductOne" onChange="changeTotalFromCount(this);" onLoad="changeTotalFromCount(this);" min="1" data-unitprice="7" />
        </td>
        <td><span id="1"></span>

        </td>
    </tr>
    <tr>
        <td>Product 2</td>
        <td>
            <input type="number" id="product2" class="formnumbers" name="ProductTwo" onChange="changeTotalFromCount(this);" onLoad="changeTotalFromCount(this);" min="1" data-unitprice="10" />
        </td>
        <td><span id="2"></span>

        </td>
    </tr>
    <tr>
        <td>Total Price</td>
        <td></td>
        <td id="totalPriceDisplay">TOTAL PRICE HERE</td>
    </tr>
</table>
<script type="text/javascript">
    function changeTotalFromCount(input) {
        var unitPrice = parseFloat(input.getAttribute("data-unitPrice"));
        var count = input.value;

        var price = unitPrice * count;
        var formattedPrice = '\u20ac ' + price.toFixed(2);

        var label = input.parentNode.nextElementSibling;
        label.innerHTML = '';
        label.appendChild(document.createTextNode(formattedPrice));
        getTotalPrice();
    }
    function getTotalPrice() {
        var total = 0,
                inputs = document.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value) {
                total += parseFloat(inputs[i].getAttribute("data-unitPrice")) * parseInt(inputs[i].value, 10);
            }
        }
        if (total > 0) {
            document.getElementById('totalPriceDisplay').innerText = '\u20ac ' + total.toFixed(2);

        }
    }
    function initTotals() {
        var inputs = document.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            changeTotalFromCount(inputs[i]);
        }
    }
    window.onload = initTotals;
</script>
<!--KEB AIR-->
<script type="text/javascript">
    $(function() {
        $('#validation-form').show();
        //documentation : http://docs.jquery.com/Plugins/Validation/validate
        $('#validation-form').validate({
            errorElement: 'span',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                v_potensi: {
                    required: true
                },
                a_potensi: {
                    required: true
                },
                b_potensi: {
                    required: true
                },
                kecepatan: {
                    required: true
                },
                jarak1: {
                    required: true
                },
                jarak2: {
                    required: true
                }
            },
            messages: {
                v_potensi: "Field tidak boleh kosong.",
                a_potensi: "Field tidak boleh kosong.",
                b_potensi: "Field tidak boleh kosong.",
                kecepatan: "Field tidak boleh kosong.",
                jarak1: "Field tidak boleh kosong.",
                jarak2: "Field tidak boleh kosong."

            },
            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-error', $('.login-form')).show();
            },
            highlight: function(e) {
                $(e).closest('.control-group').removeClass('info').addClass('error');
            },
            success: function(e) {
                $(e).closest('.control-group').removeClass('error').addClass('info');
                $(e).remove();
            },
            errorPlacement: function(error, element) {
                if (element.is(':checkbox') || element.is(':radio')) {
                    var controls = element.closest('.controls');
                    if (controls.find(':checkbox,:radio').length > 1)
                        controls.append(error);
                    else
                        error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if (element.is('.chzn-select')) {
                    error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                }
                else
                    error.insertAfter(element);
            },
            submitHandler: function(form) {
                var url = "Fanalisis/analisisProses.php";

                // mengambil nilai dari inputbox, textbox dan select
                var v_kec = $('select[name=kecamatan]').val();
                var v_air = $('select[name=sumber_air]').val();
                var v_desa = $('select[name=desa]').val();
                var v_bangunan = $('input:text[name=bangunan]').val();
                var v_akons = $('input:text[name=angka_konstruksi]').val();
                var v_volume1 = $('input:text[name=volume1]').val();
                var v_exposure = $('input:radio[name=exposure]').val();
                var v_tepol = $('input:radio[name=tepol]').val();
                var v_pass1 = $('input:password[name=pass1]').val();
                var v_jabatan = $('select[name=jabatan]').val();

                $.post(url, {kecamatan: v_kec, sumber_air: v_air, bangunan: v_bangunan, angka_konstruksi: v_akons, volume1: v_volume1, exposure: v_exposure, tepol: v_tepol, pass1: v_pass1, jabatan: v_jabatan}, function() {

                })
            },
            invalidHandler: function(form) {
            }
        });
    });



    /*$(function() {
     ///////////////////////////////////////////
     $('#user-profile-3').end().find('button[type=reset]').on(ace.click_event, function() {
     $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
     })
     });*/
</script>
<!--END KEB AIR-->




