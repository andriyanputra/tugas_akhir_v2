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
        /*echo 'ID resiko = '.$id."<br/>";
        echo 'tgl resiko = '.NOW()."<br/>";
        echo 'nama pelapor = '.$nama."<br/>";
        echo 'nomor_telp = '.$no."<br/>";
        echo 'alamat_pelapor = '.$alamat."<br/>";
        echo 'ID BANGUNAN = '.$bangunan."<br/>";
        echo 'DESA_ID = '.$desa."<br/>";
        echo 'KECAMATAN_ID = '.$kecamatan."<br/>";
        echo 'ID sumber = '.$sumber."<br/>";
        echo 'exposure = '.$exposure."<br/>";
        echo 'tepol = '.$tepol."<br/>";
        echo 'p x l x t = '.$p.'x'.$l.'x'.$t."<br/>";
        echo 'pasokan_air_minimum = '.$minim."<br/>";
        echo 'penerapan_air = '.$laju."<br/>";
        echo 'pengangkutan_air = '.$hasil."<br/>";
        echo 'tipe_proteksi = '.$proteksi."<br/>";*/
        /*echo '1 <br/>';
        echo $cek['jml_mpkp'].' '.$cek['jml_mpkl'].' '.$cek['jml_mpkbg'].'<br/>';
        echo $cek['jml_perkantoran'].' '.$cek['jml_udj'].' '.$cek['jml_industri'].' '.$cek['jml_kb'].' '.$cek['jml_rmh'].' '.$cek['jml_lahan'];*/
        /*echo "2 <br/>";
        echo $cek['jml_mpkp'].' '.$cek['jml_mpkl'].' '.$cek['jml_mpkbg'].'<br/>';
        echo $cek['jml_perkantoran'].' '.$cek['jml_udj'].' '.$cek['jml_industri'].' '.$cek['jml_kb'].' '.$cek['jml_rmh'].' '.$cek['jml_lahan'];*/
        /*if(($master_id == '1' && $tipe_proteksi == 'MPKP') || ($master_id == '1' && $tipe_proteksi == 'MPKL') || ($master_id == '1' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 1 dan tipe proteksi = ".$tipe_proteksi;
            
        }else if(($master_id == '2' && $tipe_proteksi == 'MPKP') || ($master_id == '2' && $tipe_proteksi == 'MPKL') || ($master_id == '2' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 2 dan tipe proteksi = ".$tipe_proteksi;

        }else if(($master_id == '3' && $tipe_proteksi == 'MPKP') || ($master_id == '3' && $tipe_proteksi == 'MPKL') || ($master_id == '3' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 3 dan tipe proteksi = ".$tipe_proteksi;

        }else if(($master_id == '4' && $tipe_proteksi == 'MPKP') || ($master_id == '4' && $tipe_proteksi == 'MPKL') || ($master_id == '4' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 4 dan tipe proteksi = ".$tipe_proteksi;

        }else if(($master_id == '5' && $tipe_proteksi == 'MPKP') || ($master_id == '5' && $tipe_proteksi == 'MPKL') || ($master_id == '5' && $tipe_proteksi == 'MPKBG')){
            //echo "master id = 5 dan tipe proteksi = ".$tipe_proteksi;
            
        }*/