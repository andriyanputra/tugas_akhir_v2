 $query = mysql_fetch_assoc(mysql_query("SELECT MAX( resiko_id )FROM resiko"));
                                        $resiko_id = $query['MAX( resiko_id )'];
                                        $query_ = mysql_query("SELECT * FROM desa AS a INNER JOIN resiko AS b 
                                                            ON (a.DESA_ID = b.DESA_ID)
                                                        INNER JOIN kecamatan AS c
                                                            ON (a.KECAMATAN_ID = c.KECAMATAN_ID)
                                                        INNER JOIN bangunan AS d
                                                            ON (d.ID_BANGUNAN = b.ID_BANGUNAN) AND (c.KECAMATAN_ID = b.KECAMATAN_ID)
                                                        INNER JOIN master_bangunan AS e
                                                            ON (e.ID_MASTER = d.ID_MASTER) WHERE resiko_id = '$resiko_id'") or die(mysql_error());
                                        $r = mysql_fetch_array($query_);
                                        $luas = round($r['panjang'] * $r['lebar'], 1);


                                                <div class="span10 offset1">
                                                    <div class="table-header">Daftar Kejadian Kebakaran di Kabupaten Sidoarjo</div>

                                                    <table id="kejadian" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Nama Pelapor</th>
                                                                <th>Lokasi Kejadian</th>
                                                                <th>Tanggal Kejadian</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                        <?php
                                                        if(isset($_POST['kec'])){
                                                            $kecamatan = $_POST['kec'];
                                                            //$desa = $_POST['desa'];
                                                            $query = "SELECT a.nama_pelapor, a.resiko_tanggal, b.DESA_NAMA, c.NAMA_BANGUNAN, d.KECAMATAN_NAMA, a.alamat_pelapor
                                                                        FROM resiko AS a INNER JOIN desa AS b
                                                                            ON (a.DESA_ID = b.DESA_ID)
                                                                        INNER JOIN bangunan AS c
                                                                            ON (a.ID_BANGUNAN = c.ID_BANGUNAN)
                                                                        INNER JOIN kecamatan AS d
                                                                            ON (a.KECAMATAN_ID = d.KECAMATAN_ID) AND (b.KECAMATAN_ID = d.KECAMATAN_ID)
                                                                        WHERE d.KECAMATAN_ID like'%$kecamatan%' ";
                                                            $q_=mysql_query($query);
                                                        }
                                                        if($q_){
                                                            $no = 1;
                                                            while($res = mysql_fetch_array($q_)){
                                                                $result_tgl = date_create($res['resiko_tanggal']);
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no.'.'; ?></td>
                                                                <td><?php echo $res['nama_pelapor']; ?></td>
                                                                <td><?php echo $res['alamat_pelapor'].' Ds. '.$res['DESA_NAMA'].' Kec. '.$res['KECAMATAN_NAMA'].' Kab. Sidoarjo.' ?></td>
                                                                <td><?php echo date_format($result_tgl, 'd-m-Y H:i:s'); ?></td>
                                                                <td>
                                                                    <a href="#detail-1" role="button" class="blue" data-toggle="modal">
                                                                        More details...
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php  
                                                                $no++; 
                                                            }
                                                        }else{
                                                             die(mysql_error());
                                                        } 
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

 <form class="form-horizontal" id="validation-form" method="POST" action="proses/submit.php">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="nama">Nama Pelapor :</label>

                                                    <div class="controls">
                                                        <input type="text" name="nama" id="nama" readonly value="<?=$r['nama_pelapor']?>"/>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="alamat">Alamat :</label>

                                                    <div class="controls">
                                                        <textarea class="span6" name="alamat" id="alamat" readonly><?php echo $r['alamat_pelapor'].' Ds. '.$r['DESA_NAMA'].', Kec. '.$r['KECAMATAN_NAMA'].', Kab. Sidoarjo.' ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="bangunan">Bangunan Terbakar :</label>
                                                    
                                                    <div class="controls">
                                                        <input type="text" class="span6" name="bangunan" id="bangunan" readonly value="<?=$r['NAMA_BANGUNAN']?>">
                                                        <input name="check" class="ace-switch ace-switch-2" type="checkbox" onclick="showMe('bangunan_baru', 'luas_baru')" data-rel="tooltip" title="Apakah terdapat bangunan terbakar selain bangunan di samping ?" data-placement="bottom" />
                                                        <span class="lbl"></span>
                                                    </div>
                                                </div>

                                                <div id="bangunan_baru" style="display:none">
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <input type="text" name="bangunan_baru" value="" placeholder="Bangunan Terbakar...">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="penyebab">Penyebab Kebakaran :</label>

                                                    <div class="controls">
                                                        <select id="penyebab" name="penyebab">
                                                            <option value="" />Pilih Penyebab...
                                                            <option value="BBM" />Bahan Bakar Minyak
                                                            <option value="KPR/LPG" />Kompor Gas
                                                            <option value="LST" />Listrik
                                                            <option value="RK" />Rokok
                                                        </select>
                                                        <input name="check2" class="ace-switch ace-switch-2" type="checkbox" onclick="showMe_('penyebab_baru')" data-rel="tooltip" title="Penyebab kebakaran tidak terdapat dalam list ?" data-placement="bottom" />
                                                        <span class="lbl"></span>
                                                    </div>
                                                </div>

                                                <div id="penyebab_baru" style="display:none">
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <input type="text" name="penyebab_baru" value="" placeholder="Penyebab Baru...">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="luas">Luas Area Terbakar :</label>
                                                    
                                                    <div class="controls">
                                                        <input type="text" name="luas" id="luas" readonly value="<?=$luas?>">&nbsp;m<sup>2</sup>
                                                    </div>
                                                </div>

                                                <div id="luas_baru" style="display:none">
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <input type="text" name="luas_total" value="" placeholder="Luas Keseluruhan Bangunan...">&nbsp;m<sup>2</sup>
                                                        </div>
                                                    </div>
                                                </div>                                                

                                                <div class="control-group">
                                                    <label class="control-label" for="korban">Jumlah Korban :</label>

                                                    <div class="controls">
                                                        <input type="text" id="korban_luka" name="korban_luka" placeholder="Korban Luka..." value="">
                                                        <input type="text" id="korban_meninggal" name="korban_meninggal" placeholder="Korban Meninggal..." value="">
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="biaya">Estimasi Biaya Kerugian:</label>

                                                    <div class="controls">
                                                        <span class="input-icon input-icon-right">
                                                            <input type="text" id="biaya" name="biaya" placeholder="Biaya Kerugian..." value="" class="biaya" data-a-sep="." data-a-dec="," data-a-sign="Rp. "/>
                                                            <i class="icon-money"></i>
                                                        </span>

                                                        <!--<input type="text" id="biaya" name="biaya" placeholder="Biaya Kerugian..." value="">-->
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <div class="pull-right">
                                                        <button class="btn" onclick="location.reload();">
                                                            <i class="icon-repeat bigger-110"></i>
                                                            Reset
                                                        </button>
                                                    &nbsp; &nbsp; &nbsp;
                                                        <button class="btn btn-info" type="submit">
                                                            Submit
                                                            <i class="icon-ok"></i>
                                                        </button>
                                                    </div>
                                                </div>


                                            </div><!-- end span12 --> 
                                        </div><!-- end row-fluid --> 
                                    </form>
                                    <script type="text/javascript">
    $(function() {
        $('#validation-form').show();
        //documentation : http://docs.jquery.com/Plugins/Validation/validate
        $('#validation-form').validate({
            errorElement: 'span',
            errorClass: 'help-inline',
            focusInvalid: false,
            rules: {
                bangunan_baru: {
                    required: true
                },
                penyebab: {
                    required: true
                },
                penyebab_baru: {
                    required: true
                },
                luas_total: {
                    required: true
                },
                korban_luka: {
                    required: true
                },
                korban_meninggal: {
                    required: true
                },
                biaya: {
                    required: true
                }
            },
            messages: {
                bangunan_baru: "Mohon untuk mengisi field bangunan.",
                penyebab: "Mohon untuk memilih penyebab kebakaran.",
                penyebab_baru: "Mohon untuk mengisi field penyebab.",
                luas_total: "Mohon untuk memilih lokasi kecamatan.",
                biaya: "Mohon untuk mengisi field biaya."
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
                var url = "proses/submit.php";

                // mengambil nilai dari inputbox, textbox dan select
                var v_kec = $('select[name=kecamatan]').val();
                var v_air = $('select[name=sumber_air]').val();
                var v_desa = $('select[name=desa]').val();
                var v_akons1 = $('select[name=angka_konstruksi1]').val();
                var v_akons2 = $('select[name=angka_konstruksi2]').val();
                var v_tinggi1 = $('input:text[name=tinggi1]').val();
                var v_tinggi2 = $('input:text[name=tinggi2]').val();
                var v_exposure = $('input:radio[name=exposure]').val();
                var v_tepol = $('input:radio[name=tepol]').val();
                //var v_hasil1 = $('input:text[name=hasil1]').val();
                //var v_hasil2 = $('input:text[name=hasil2]').val();

                $.post(url, {tinggi2: v_tinggi2, desa: v_desa, kecamatan: v_kec, sumber_air: v_air, angka_konstruksi1: v_akons1, angka_konstruksi2: v_akons2, tinggi1: v_tinggi1, exposure: v_exposure, tepol: v_tepol, hasil1: v_hasil1, hasil2: v_hasil2}, function() {

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

                                                <form class="form-horizontal"/>
                                                    Cari Kejadian Kebakaran : 
                                                    <select id="kecamatan_" name="kecamatan_" class="span2" >
                                                            <option value="" />Pilih Kecamatan...
                                                            <?php
                                                            while ($p = mysql_fetch_array($query_kec)) {
                                                                echo "<option value=\"$p[KECAMATAN_ID]\">$p[KECAMATAN_NAMA]</option>\n";
                                                            }
                                                            ?>
                                                    </select>
                                                    <select name="desa" id="desa" class="span2" onchange="showUser(this.value)">
                                                        <option>--Pilih Desa--</option>
                                                    </select>
                                                    <!--<input type="text" class="input-medium search-query span2" placeholder="Kecamatan . . ."/> atau-->
                                                    <!--<input type="submit" name="sumbit" class="btn btn-info btn-small" value="Search" />-->
                                                    <!--<button onclick="return false;" class="btn btn-purple btn-small">
                                                        Search
                                                         <i class="icon-search icon-on-right bigger-110"></i>
                                                    </button>-->
                                                </form>
        //=======================G R A F I K=============================
        $tgl = $row['resiko_tanggal'];
        $bln = date('F', strtotime($row['resiko_tanggal']));
        if($bln == 'January')$bln = 'Jan';else if($bln == 'February')$bln = 'Feb';
        else if($bln == 'March')$bln = 'Mar';else if($bln == 'April')$bln = 'Apr';
        else if($bln == 'May')$bln = 'Mei';else if($bln == 'June')$bln = 'Jun';
        else if($bln == 'July')$bln = 'Jul';else if($bln == 'August')$bln = 'Agt';
        else if($bln == 'September')$bln = 'Sep';else if($bln == 'October')$bln = 'Okt';
        else if($bln == 'November')$bln = 'Nov';else if($bln == 'December')$bln = 'Des';
        $thn = date('Y', strtotime($row['resiko_tanggal']));

        $cek = mysql_fetch_assoc(mysql_query("SELECT grafik_id, grafik_bln, grafik_thn, SUM(grafik_perkantoran) AS jml_perkantoran,
            SUM(grafik_udj) AS jml_udj, SUM(grafik_industri) AS jml_industri,
            SUM(grafik_kb) AS jml_kb, SUM(grafik_rmh) AS jml_rmh,
            SUM(grafik_lahan) AS jml_lahan,
            SUM(grafik_mpkp) AS jml_mpkp, SUM(grafik_mpkl) AS jml_mpkl, SUM(grafik_mpkbg) AS jml_mpkbg 
            FROM grafik 
            WHERE grafik_bln = '$bln' AND grafik_thn = '$thn'")) or die("Query : ".mysql_error());
        $jml_perkantoran = $cek['jml_perkantoran']; $jml_mpkp = $cek['jml_mpkp'];  
        $jml_udj = $cek['jml_udj'];                 $jml_mpkl = $cek['jml_mpkl'];
        $jml_industri = $cek['jml_industri'];       $jml_mpkbg = $cek['jml_mpkbg'];
        $jml_kb = $cek['jml_kb'];
        $jml_rmh = $cek['jml_rmh'];
        $jml_lahan = $cek['jml_lahan'];

        //===Jika query dari cek, menghasilkan NULL record===
        if($jml_mpkp == NULL && $jml_mpkl == NULL && $jml_mpkbg == NULL && $jml_perkantoran == NULL && $jml_udj == NULL && $jml_industri == NULL && $jml_kb == NULL && $jml_rmh == NULL && $jml_lahan == NULL){
            $jml_perkantoran = '0'; $jml_mpkp = '0';  
            $jml_udj = '0';         $jml_mpkl = '0';
            $jml_industri = '0';    $jml_mpkbg = '0';
            $jml_kb = '0';
            $jml_rmh = '0';
            $jml_lahan = '0';        
        }

        $master_id = $row['ID_MASTER'];
        $id_grafik = $cek['grafik_id'];
        
        if($cek['grafik_bln'] == $bln && $cek['grafik_thn'] == $thn){
            /*
            1 = perkantoran     4 = kb
            2 = udj             5 = rumah
            3 = industri        6 = lahan/sawah
            */
            if($master_id == '1' && $proteksi == 'MPKP'){
                $add_perkantoran = $jml_perkantoran + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$add_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$add_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '1' && $proteksi == 'MPKL'){
                $add_perkantoran = $jml_perkantoran + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$add_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$add_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '1' && $proteksi == 'MPKBG'){
                $add_perkantoran = $jml_perkantoran + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$add_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$add_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '2' && $proteksi == 'MPKP'){
                $add_udj = $jml_udj + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$add_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$add_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '2' && $proteksi == 'MPKL'){
                $add_udj = $jml_udj + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$add_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$add_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '2' && $proteksi == 'MPKBG'){
                $add_udj = $jml_udj + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$add_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$add_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '3' && $proteksi == 'MPKP'){
                $add_industri = $jml_industri + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$add_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$add_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());    
            }else if($master_id == '3' && $proteksi == 'MPKL'){
                $add_industri = $jml_industri + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$add_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$add_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());   
            }else if($master_id == '3' && $proteksi == 'MPKBG'){
                $add_industri = $jml_industri + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$add_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$add_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());   
            }else if($master_id == '4' && $proteksi == 'MPKP'){
                $add_kb = $jml_kb + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$add_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$add_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error()); 
            }else if($master_id == '4' && $proteksi == 'MPKL'){
                $add_kb = $jml_kb + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$add_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$add_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error()); 
            }else if($master_id == '4' && $proteksi == 'MPKBG'){
                $add_kb = $jml_kb + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$add_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$add_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error()); 
            }else if($master_id == '5' && $proteksi == 'MPKP'){
                $add_rmh = $jml_rmh + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$add_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$add_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error()); 
            }else if($master_id == '5' && $proteksi == 'MPKL'){
                $add_rmh = $jml_rmh + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$add_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$add_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '5' && $proteksi == 'MPKBG'){
                $add_rmh = $jml_rmh + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$add_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$add_rmh', grafik_lahan = '$jml_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '6' && $proteksi == 'MPKP'){
                $add_lahan = $jml_lahan + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$add_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$add_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '6' && $proteksi == 'MPKL'){
                $add_lahan = $jml_lahan + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$add_mpkl', grafik_mpkbg = '$jml_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$add_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }else if($master_id == '6' && $proteksi == 'MPKBG'){
                $add_lahan = $jml_lahan + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("UPDATE grafik SET 
                        grafik_id = '$id_grafik', grafik_bln = '$bln', grafik_thn = '$thn',
                        grafik_mpkp = '$jml_mpkp', grafik_mpkl = '$jml_mpkl', grafik_mpkbg = '$add_mpkbg',
                        grafik_luka = '0', grafik_meninggal = '0', grafik_bbm = '0', grafik_kpr = '0', grafik_lst = '0', grafik_rk = '0', grafik_lain = '0',
                        grafik_perkantoran = '$jml_perkantoran', grafik_udj = '$jml_udj', grafik_industri = '$jml_industri',
                        grafik_kb = '$jml_kb', grafik_rmh = '$jml_rmh', grafik_lahan = '$add_lahan'
                        WHERE grafik_id = '$id_grafik')") or die("Query : ".mysql_error());
            }
        }else{
            /*
            1 = perkantoran     4 = kb
            2 = udj             5 = rumah
            3 = industri        6 = lahan/sawah
            */
            if($master_id == '1' && $proteksi == 'MPKP'){
                $add_perkantoran = $jml_perkantoran + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$add_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '1' && $proteksi == 'MPKL'){
                $add_perkantoran = $jml_perkantoran + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$add_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '1' && $proteksi == 'MPKBG'){
                $add_perkantoran = $jml_perkantoran + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                        '','',
                        '','','','','',
                        '$add_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '2' && $proteksi == 'MPKP'){
                $add_udj = $jml_udj + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$add_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '2' && $proteksi == 'MPKL'){
                $add_udj = $jml_udj + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$add_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '2' && $proteksi == 'MPKBG'){
                $add_udj = $jml_udj + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$add_udj','$jml_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '3' && $proteksi == 'MPKP'){
                $add_industri = $jml_industri + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$add_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());    
            }else if($master_id == '3' && $proteksi == 'MPKL'){
                $add_industri = $jml_industri + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$add_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());   
            }else if($master_id == '3' && $proteksi == 'MPKBG'){
                $add_industri = $jml_industri + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$add_industri','$jml_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());   
            }else if($master_id == '4' && $proteksi == 'MPKP'){
                $add_kb = $jml_kb + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$add_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '4' && $proteksi == 'MPKL'){
                $add_kb = $jml_kb + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$add_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '4' && $proteksi == 'MPKBG'){
                $add_kb = $jml_kb + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$add_kb','$jml_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '5' && $proteksi == 'MPKP'){
                $add_rmh = $jml_rmh + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$add_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '5' && $proteksi == 'MPKL'){
                $add_rmh = $jml_rmh + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$add_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '5' && $proteksi == 'MPKBG'){
                $add_rmh = $jml_rmh + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$add_rmh','$jml_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '6' && $proteksi == 'MPKP'){
                $add_lahan = $jml_lahan + 1; $add_mpkp = $jml_mpkp + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$add_mpkp','$jml_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$add_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '6' && $proteksi == 'MPKL'){
                $add_lahan = $jml_lahan + 1; $add_mpkl = $jml_mpkl + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$add_mpkl','$jml_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$add_lahan')") or die("Query : ".mysql_error());
            }else if($master_id == '6' && $proteksi == 'MPKBG'){
                $add_lahan = $jml_lahan + 1; $add_mpkbg = $jml_mpkbg + 1;
                $grafik = mysql_query("INSERT INTO grafik
                        VALUES (NULL,'$bln','$thn',
                        '$jml_mpkp','$jml_mpkl','$add_mpkbg',
                        '','',
                        '','','','','',
                        '$jml_perkantoran','$jml_udj','$jml_industri','$jml_kb','$jml_rmh','$add_lahan')") or die("Query : ".mysql_error());
            }
        }

        //==============================G R A F I K======================================
    $bln = date('F', strtotime($tgl));
    if($bln == 'January')$bln = 'Jan';else if($bln == 'February')$bln = 'Feb';
    else if($bln == 'March')$bln = 'Mar';else if($bln == 'April')$bln = 'Apr';
    else if($bln == 'May')$bln = 'Mei';else if($bln == 'June')$bln = 'Jun';
    else if($bln == 'July')$bln = 'Jul';else if($bln == 'August')$bln = 'Agt';
    else if($bln == 'September')$bln = 'Sep';else if($bln == 'October')$bln = 'Okt';
    else if($bln == 'November')$bln = 'Nov';else if($bln == 'December')$bln = 'Des';
    $thn = date('Y', strtotime($row['resiko_tanggal']));
    $cek = mysql_fetch_assoc(mysql_query("SELECT grafik_id, SUM(grafik_luka) AS jml_luka, SUM(grafik_meninggal) AS jml_meninggal,
       SUM(grafik_bbm) AS jml_bbm, SUM(grafik_kpr) AS jml_kpr,
       SUM(grafik_lst) AS jml_lst, SUM(grafik_rk) AS jml_rk, SUM(grafik_lain) AS jml_lain,
       SUM(grafik_perkantoran) AS jml_perkantoran,
       SUM(grafik_udj) AS jml_udj, SUM(grafik_industri) AS jml_industri,
       SUM(grafik_kb) AS jml_kb, SUM(grafik_rmh) AS jml_rmh,
       SUM(grafik_lahan) AS jml_lahan,
       SUM(grafik_mpkp) AS jml_mpkp, SUM(grafik_mpkl) AS jml_mpkl, SUM(grafik_mpkbg) AS jml_mpkbg 
       FROM grafik 
       WHERE grafik_bln = '$bln' AND grafik_thn = '$thn'")) or die("Query : ".mysql_error());
    $grafik_id = $cek['grafik_id'];
    $grafik_mpkp = $cek['jml_mpkp']; $grafik_mpkl = $cek['jml_mpkl']; $grafik_mpkbg = $cek['jml_mpkbg'];
    $grafik_luka = $cek['jml_luka']; $grafik_meninggal = $cek['jml_meninggal'];
    $grafik_bbm = $cek['jml_bbm'];   $grafik_kpr = $cek['jml_kpr'];   $grafik_lst = $cek['jml_lst'];
    $grafik_rk = $cek['jml_rk'];     $grafik_lain = $cek['jml_lain'];
    $grafik_perkantoran = $cek['jml_perkantoran'];
    $grafik_udj = $cek['jml_udj'];   $grafik_industri = $cek['jml_industri'];
    $grafik_kb = $cek['jml_kb']; $grafik_rmh = $cek['jml_rmh']; $grafik_lahan = $cek['jml_lahan'];

    //=== G R A F I K ===
        if($penyebab == '1'){
            $add_bbm = $jml_bbm + 1;
            $update_grafik = mysql_query("UPDATE grafik SET 
                            grafik_id='$grafik_id', grafik_bln = '$bln', grafik_thn = '$thn',
                            grafik_mpkp = '$grafik_mpkp', grafik_mpkl = '$grafik_mpkl', grafik_mpkbg = '$grafik_mpkbg',
                            grafik_luka = '$korban_luka', grafik_meninggal = '$korban_meninggal', 
                            grafik_bbm = '$add_bbm', grafik_kpr = '$jml_kpr', grafik_lst = '$jml_lst', grafik_rk = '$jml_rk', grafik_lain = '$jml_lain',
                            grafik_perkantoran = '$grafik_perkantoran', grafik_udj = '$grafik_udj', 
                            grafik_industri = '$grafik_industri', grafik_kb = '$grafik_kb', 
                            grafik_rmh = '$grafik_rmh', grafik_lahan = '$grafik_lahan'
                            WHERE grafik_id='$grafik_id'") or die("Query: ".mysql_error());
        }else if($penyebab == '2'){
            $add_kpr = $jml_kpr + 1;
            $update_grafik = mysql_query("UPDATE grafik SET 
                            grafik_id='$grafik_id', grafik_bln = '$bln', grafik_thn = '$thn',
                            grafik_mpkp = '$grafik_mpkp', grafik_mpkl = '$grafik_mpkl', grafik_mpkbg = '$grafik_mpkbg',
                            grafik_luka = '$korban_luka', grafik_meninggal = '$korban_meninggal', 
                            grafik_bbm = '$jml_bbm', grafik_kpr = '$add_kpr', grafik_lst = '$jml_lst', grafik_rk = '$jml_rk', grafik_lain = '$jml_lain',
                            grafik_perkantoran = '$grafik_perkantoran', grafik_udj = '$grafik_udj', 
                            grafik_industri = '$grafik_industri', grafik_kb = '$grafik_kb', 
                            grafik_rmh = '$grafik_rmh', grafik_lahan = '$grafik_lahan'
                            WHERE grafik_id='$grafik_id'") or die("Query: ".mysql_error());
        }else if($penyebab == '3'){
            $add_lst = $jml_lst + 1;
            $update_grafik = mysql_query("UPDATE grafik SET 
                            grafik_id='$grafik_id', grafik_bln = '$bln', grafik_thn = '$thn',
                            grafik_mpkp = '$grafik_mpkp', grafik_mpkl = '$grafik_mpkl', grafik_mpkbg = '$grafik_mpkbg',
                            grafik_luka = '$korban_luka', grafik_meninggal = '$korban_meninggal', 
                            grafik_bbm = '$jml_bbm', grafik_kpr = '$jml_kpr', grafik_lst = '$add_lst', grafik_rk = '$jml_rk', grafik_lain = '$jml_lain',
                            grafik_perkantoran = '$grafik_perkantoran', grafik_udj = '$grafik_udj', 
                            grafik_industri = '$grafik_industri', grafik_kb = '$grafik_kb', 
                            grafik_rmh = '$grafik_rmh', grafik_lahan = '$grafik_lahan'
                            WHERE grafik_id='$grafik_id'") or die("Query: ".mysql_error());
        }else if($penyebab == '4'){
            $add_rk = $jml_rk + 1;
            $update_grafik = mysql_query("UPDATE grafik SET 
                            grafik_id='$grafik_id', grafik_bln = '$bln', grafik_thn = '$thn',
                            grafik_mpkp = '$grafik_mpkp', grafik_mpkl = '$grafik_mpkl', grafik_mpkbg = '$grafik_mpkbg',
                            grafik_luka = '$korban_luka', grafik_meninggal = '$korban_meninggal', 
                            grafik_bbm = '$jml_bbm', grafik_kpr = '$jml_kpr', grafik_lst = '$jml_lst', grafik_rk = '$add_rk', grafik_lain = '$jml_lain',
                            grafik_perkantoran = '$grafik_perkantoran', grafik_udj = '$grafik_udj', 
                            grafik_industri = '$grafik_industri', grafik_kb = '$grafik_kb', 
                            grafik_rmh = '$grafik_rmh', grafik_lahan = '$grafik_lahan'
                            WHERE grafik_id='$grafik_id'") or die("Query: ".mysql_error());
        }else If($penyebab == '5'){
            $add_lain = $jml_lain + 1;
            $update_grafik = mysql_query("UPDATE grafik SET 
                            grafik_id='$grafik_id', grafik_bln = '$bln', grafik_thn = '$thn',
                            grafik_mpkp = '$grafik_mpkp', grafik_mpkl = '$grafik_mpkl', grafik_mpkbg = '$grafik_mpkbg',
                            grafik_luka = '$korban_luka', grafik_meninggal = '$korban_meninggal', 
                            grafik_bbm = '$jml_bbm', grafik_kpr = '$jml_kpr', grafik_lst = '$jml_lst', grafik_rk = '$jml_rk', grafik_lain = '$add_lain',
                            grafik_perkantoran = '$grafik_perkantoran', grafik_udj = '$grafik_udj', 
                            grafik_industri = '$grafik_industri', grafik_kb = '$grafik_kb', 
                            grafik_rmh = '$grafik_rmh', grafik_lahan = '$grafik_lahan'
                            WHERE grafik_id='$grafik_id'") or die("Query: ".mysql_error());
        }

        <?php
include ("../../config/koneksi.php");
$desa = intval($_GET['cari']);

$query = "SELECT a.nama_pelapor, a.resiko_tanggal, b.DESA_NAMA, c.NAMA_BANGUNAN, d.KECAMATAN_NAMA, a.alamat_pelapor
        FROM resiko AS a INNER JOIN desa AS b
            ON (a.DESA_ID = b.DESA_ID)
        INNER JOIN bangunan AS c
            ON (a.ID_BANGUNAN = c.ID_BANGUNAN)
        INNER JOIN kecamatan AS d
            ON (a.KECAMATAN_ID = d.KECAMATAN_ID) AND (b.KECAMATAN_ID = d.KECAMATAN_ID)
        WHERE b.DESA_ID = '$desa' ";
$q_=mysql_query($query);

echo "<div class='table-header'>Daftar Kejadian Kebakaran di Kabupaten Sidoarjo</div>

                                                    <table class='table table-striped table-bordered table-hover'>
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Nama Pelapor</th>
                                                                <th>Lokasi Kejadian</th>
                                                                <th>Tanggal Kejadian</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>";
$no = 1;
while($res = mysql_fetch_array($q_)) {
    $result_tgl = date_create($res['resiko_tanggal']);
      echo "<tr>";
      echo "<td>" . $no . "</td>";
      echo "<td>" . $res['nama_pelapor'] . "</td>";
      echo "<td>" . $res['alamat_pelapor']." Ds. ".$res['DESA_NAMA']." Kec. ".$res['KECAMATAN_NAMA']." Kab. Sidoarjo.</td>";
      echo "<td>" . date_format($result_tgl, 'd-m-Y H:i:s') . "</td>";
      echo "<td>wew</td>";
      echo "</tr>";
      $no++; 
}
echo " </tbody></table>";
?>


    include '../../config/koneksi.php';

$sth = mysql_query("SELECT grafik_mpkp, grafik_mpkl, grafik_mpkbg FROM grafik WHERE grafik_thn = 2011");
$row1 = array();$row3 = array();
$row2 = array();
$row1['name'] = 'MPKP';$row3['name'] = 'MPKBG';
$row2['name'] = 'MPKL';
while($r = mysql_fetch_array($sth)) {
    $row1['data'][] = $r['grafik_mpkp'];
    $row2['data'][] = $r['grafik_mpkl'];
    $row3['data'][] = $r['grafik_mpkbg'];
}

/*$sth = mysql_query("SELECT overhead FROM projections_sample");
$rows1 = array();
$rows1['name'] = 'Overhead';
while($rr = mysql_fetch_assoc($sth)) {
    $rows1['data'][] = $rr['overhead'];
}*/

$result = array();
array_push($result,$row1);
array_push($result,$row2);
array_push($result,$row3);


print json_encode($result, JSON_NUMERIC_CHECK);