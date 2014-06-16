<div class="ace-settings-container" id="ace-settings-container">
    <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
        <i class="icon-cog bigger-150"></i>
    </div>

    <div class="ace-settings-box" id="ace-settings-box">
        <div>
            <div class="pull-left">
                <select id="skin-colorpicker" class="hide">
                    <option data-class="default" value="#438EB9" />#438EB9
                    <option data-class="skin-1" value="#222A2D" />#222A2D
                    <option data-class="skin-2" value="#C6487E" />#C6487E
                    <option data-class="skin-3" value="#D0D0D0" />#D0D0D0
                </select>
            </div>
            <span>&nbsp; Choose Skin</span>
        </div>

        <div>
            <input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
        </div>
    </div>
</div><!--/#ace-settings-container-->
</div><!--/.main-content-->
</div><!--/.main-container-->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>

<script type="text/javascript" src="../assets/js-ace/ajax.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<script type="text/javascript">
    window.jQuery || document.write("<script src='../assets/js-ace/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>

<script type="text/javascript">
    if ("ontouchend" in document)
        document.write("<script src='../assets/js-ace/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js-map/jquery.maphilight.min.js"></script>
<script type="text/javascript">$(function() {
        $('.map').maphilight();
    });
</script>

<script src="../assets/js-ace/bootstrap.min.js"></script>

<script src="../assets/js-ace/additional-methods.min.js"></script>
<script src="../assets/js-ace/jquery-ui-1.10.3.custom.min.js"></script>
<script src="../assets/js-ace/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js-ace/jquery.gritter.min.js"></script>
<script src="../assets/js-ace/bootbox.min.js"></script>
<script src="../assets/js-ace/jquery.slimscroll.min.js"></script>
<script src="../assets/js-ace/jquery.easy-pie-chart.min.js"></script>
<script src="../assets/js-ace/jquery.sparkline.min.js"></script>
<script src="../assets/js-ace/flot/jquery.flot.min.js"></script>
<script src="../assets/js-ace/flot/jquery.flot.pie.min.js"></script>
<script src="../assets/js-ace/flot/jquery.flot.resize.min.js"></script>
<script src="../assets/js-ace/jquery.hotkeys.min.js"></script>
<script src="../assets/js-ace/bootstrap-wysiwyg.min.js"></script>
<script src="../assets/js-ace/select2.min.js"></script>
<script src="../assets/js-ace/date-time/bootstrap-datepicker.min.js"></script>
<script src="../assets/js-ace/fuelux/fuelux.spinner.min.js"></script>
<script src="../assets/js-ace/x-editable/bootstrap-editable.min.js"></script>
<script src="../assets/js-ace/x-editable/ace-editable.min.js"></script>
<script src="../assets/js-ace/jquery.maskedinput.min.js"></script>
<script src="../assets/js-ace/fullcalendar.min.js"></script>
<script src="../assets/js-ace/fuelux/fuelux.wizard.min.js"></script>

<script src="../assets/js-ace/ace-elements.min.js"></script>
<script src="../assets/js-ace/ace.min.js"></script>


<script type="text/javascript">
    $(function() {
        $('.easy-pie-chart.percentage').each(function() {
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size / 10),
                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                size: size
            });
        })

        $('.sparkline').each(function() {
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html', {tagValuesAttribute: 'data-values', type: 'bar', barColor: barColor, chartRangeMin: $(this).data('min') || 0});
        });




        var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});
        var data = [
            {label: "social networks", data: 38.7, color: "#68BC31"},
            {label: "search engines", data: 24.5, color: "#2091CF"},
            {label: "ad campaings", data: 8.2, color: "#AF4E96"},
            {label: "direct traffic", data: 18.6, color: "#DA5430"},
            {label: "other", data: 10, color: "#FEE074"}
        ]
        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt: 0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin: [-30, 15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        drawPieChart(placeholder, data);

        /**
         we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
         so that's not needed actually.
         */
        placeholder.data('chart', data);
        placeholder.data('draw', drawPieChart);



        var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
        var previousPoint = null;

        placeholder.on('plothover', function(event, pos, item) {
            if (item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });

        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d1.push([i, Math.sin(i)]);
        }

        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d2.push([i, Math.cos(i)]);
        }

        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.2) {
            d3.push([i, Math.tan(i)]);
        }


        var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
        $.plot("#sales-charts", [
            {label: "Domains", data: d1},
            {label: "Hosting", data: d2},
            {label: "Services", data: d3}
        ], {
            hoverable: true,
            shadowSize: 0,
            series: {
                lines: {show: true},
                points: {show: true}
            },
            xaxis: {
                tickLength: 0
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2,
                tickDecimals: 3
            },
            grid: {
                backgroundColor: {colors: ["#fff", "#fff"]},
                borderWidth: 1,
                borderColor: '#555'
            }
        });


        $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('.tab-content')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }


        $('.dialogs,.comments').slimScroll({
            height: '300px'
        });


        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if ("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
            $('#tasks').on('touchstart', function(e) {
                var li = $(e.target).closest('#tasks li');
                if (li.length == 0)
                    return;
                var label = li.find('label.inline').get(0);
                if (label == e.target || $.contains(label, e.target))
                    e.stopImmediatePropagation();
            });

        $('#tasks').sortable({
            opacity: 0.8,
            revert: true,
            forceHelperSize: true,
            placeholder: 'draggable-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            stop: function(event, ui) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                $(ui.item).css('z-index', 'auto');
            }
        }
        );
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function() {
            if (this.checked)
                $(this).closest('li').addClass('selected');
            else
                $(this).closest('li').removeClass('selected');
        });


    })
</script>

<script type="text/javascript">
    //set timezone
<?php date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime() {
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        var ss = time.getSeconds().toString();
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
    }
</script>

<!--PROFILE PAGE BEGINS-->
<script type="text/javascript">
    $(function() {

        //editables on first profile page
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>' +
                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';

        //editables 
        $('#username').editable({
            type: 'text',
            name: 'username'
        });

        var countries = [];
        $.each({"CA": "Canada", "IN": "India", "NL": "Netherlands", "TR": "Turkey", "US": "United States"}, function(k, v) {
            countries.push({id: k, text: v});
        });

        var cities = [];
        cities["CA"] = [];
        $.each(["Toronto", "Ottawa", "Calgary", "Vancouver"], function(k, v) {
            cities["CA"].push({id: v, text: v});
        });
        cities["IN"] = [];
        $.each(["Delhi", "Mumbai", "Bangalore"], function(k, v) {
            cities["IN"].push({id: v, text: v});
        });
        cities["NL"] = [];
        $.each(["Amsterdam", "Rotterdam", "The Hague"], function(k, v) {
            cities["NL"].push({id: v, text: v});
        });
        cities["TR"] = [];
        $.each(["Ankara", "Istanbul", "Izmir"], function(k, v) {
            cities["TR"].push({id: v, text: v});
        });
        cities["US"] = [];
        $.each(["New York", "Miami", "Los Angeles", "Chicago", "Wysconsin"], function(k, v) {
            cities["US"].push({id: v, text: v});
        });

        var currentValue = "NL";
        $('#country').editable({
            type: 'select2',
            value: 'NL',
            source: countries,
            success: function(response, newValue) {
                if (currentValue == newValue)
                    return;
                currentValue = newValue;

                var source = (!newValue || newValue == "") ? [] : cities[newValue];
                $('#city').editable('destroy').editable({
                    type: 'select2',
                    source: source
                }).editable('setValue', null);
            }
        });

        $('#city').editable({
            type: 'select2',
            value: 'Amsterdam',
            source: cities[currentValue]
        });



        $('#signup').editable({
            type: 'date',
            format: 'yyyy-mm-dd',
            viewformat: 'dd/mm/yyyy',
            datepicker: {
                weekStart: 1
            }
        });

        $('#age').editable({
            type: 'spinner',
            name: 'age',
            spinner: {
                min: 16, max: 99, step: 1
            }
        });

        //var $range = document.createElement("INPUT");
        //$range.type = 'range';
        $('#login').editable({
            type: 'slider', //$range.type == 'range' ? 'range' : 'slider',
            name: 'login',
            slider: {
                min: 1, max: 50, width: 100
            },
            success: function(response, newValue) {
                if (parseInt(newValue) == 1)
                    $(this).html(newValue + " hour ago");
                else
                    $(this).html(newValue + " hours ago");
            }
        });

        $('#about').editable({
            mode: 'inline',
            type: 'wysiwyg',
            name: 'about',
            wysiwyg: {
                //css : {'max-width':'300px'}
            },
            success: function(response, newValue) {
            }
        });



        // *** editable avatar *** //
        try {//ie8 throws some harmless exception, so let's catch it

            //it seems that editable plugin calls appendChild, and as Image doesn't have it, it causes errors on IE at unpredicted points
            //so let's have a fake appendChild for it!
            if (/msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()))
                Image.prototype.appendChild = function(el) {
                }

            var last_gritter
            $('#avatar').editable({
                type: 'image',
                name: 'avatar',
                value: null,
                image: {
                    //specify ace file input plugin's options here
                    btn_choose: 'Change Avatar',
                    droppable: true,
                    /**
                     //this will override the default before_change that only accepts image files
                     before_change: function(files, dropped) {
                     return true;
                     },
                     */

                    //and a few extra ones here
                    name: 'avatar', //put the field name here as well, will be used inside the custom plugin
                    max_size: 110000, //~100Kb
                    on_error: function(code) {//on_error function will be called when the selected file has a problem
                        if (last_gritter)
                            $.gritter.remove(last_gritter);
                        if (code == 1) {//file format error
                            last_gritter = $.gritter.add({
                                title: 'File is not an image!',
                                text: 'Please choose a jpg|gif|png image!',
                                class_name: 'gritter-error gritter-center'
                            });
                        } else if (code == 2) {//file size rror
                            last_gritter = $.gritter.add({
                                title: 'File too big!',
                                text: 'Image size should not exceed 100Kb!',
                                class_name: 'gritter-error gritter-center'
                            });
                        }
                        else {//other error
                        }
                    },
                    on_success: function() {
                        $.gritter.removeAll();
                    }
                },
                url: function(params) {
                    // ***UPDATE AVATAR HERE*** //
                    //You can replace the contents of this function with examples/profile-avatar-update.js for actual upload


                    var deferred = new $.Deferred

                    //if value is empty, means no valid files were selected
                    //but it may still be submitted by the plugin, because "" (empty string) is different from previous non-empty value whatever it was
                    //so we return just here to prevent problems
                    var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
                    if (!value || value.length == 0) {
                        deferred.resolve();
                        return deferred.promise();
                    }


                    //dummy upload
                    setTimeout(function() {
                        if ("FileReader" in window) {
                            //for browsers that have a thumbnail of selected image
                            var thumb = $('#avatar').next().find('img').data('thumb');
                            if (thumb)
                                $('#avatar').get(0).src = thumb;
                        }

                        deferred.resolve({'status': 'OK'});

                        if (last_gritter)
                            $.gritter.remove(last_gritter);
                        last_gritter = $.gritter.add({
                            title: 'Avatar Updated!',
                            text: 'Uploading to server can be easily implemented. A working example is included with the template.',
                            class_name: 'gritter-info gritter-center'
                        });

                    }, parseInt(Math.random() * 800 + 800))

                    return deferred.promise();
                },
                success: function(response, newValue) {
                }
            })
        } catch (e) {
        }



        //another option is using modals
        $('#avatar2').on('click', function() {
            var modal =
                    '<div class="modal hide fade">\
                                                <div class="modal-header">\
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>\
                                                        <h4 class="blue">Change Avatar</h4>\
                                                </div>\
                                                \
                                                <form class="no-margin">\
                                                <div class="modal-body">\
                                                        <div class="space-4"></div>\
                                                        <div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
                                                </div>\
                                                \
                                                <div class="modal-footer center">\
                                                        <button type="submit" class="btn btn-small btn-success"><i class="icon-ok"></i> Submit</button>\
                                                        <button type="button" class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancel</button>\
                                                </div>\
                                                </form>\
                                        </div>';


            var modal = $(modal);
            modal.modal("show").on("hidden", function() {
                modal.remove();
            });

            var working = false;

            var form = modal.find('form:eq(0)');
            var file = form.find('input[type=file]').eq(0);
            file.ace_file_input({
                style: 'well',
                btn_choose: 'Click to choose new avatar',
                btn_change: null,
                no_icon: 'icon-picture',
                thumbnail: 'small',
                before_remove: function() {
                    //don't remove/reset files while being uploaded
                    return !working;
                },
                before_change: function(files, dropped) {
                    var file = files[0];
                    if (typeof file === "string") {
                        //file is just a file name here (in browsers that don't support FileReader API)
                        if (!(/\.(jpe?g|png|gif)$/i).test(file))
                            return false;
                    }
                    else {//file is a File object
                        var type = $.trim(file.type);
                        if ((type.length > 0 && !(/^image\/(jpe?g|png|gif)$/i).test(type))
                                || (type.length == 0 && !(/\.(jpe?g|png|gif)$/i).test(file.name))//for android default browser!
                                )
                            return false;

                        if (file.size > 110000) {//~100Kb
                            return false;
                        }
                    }

                    return true;
                }
            });

            form.on('submit', function() {
                if (!file.data('ace_input_files'))
                    return false;

                file.ace_file_input('disable');
                form.find('button').attr('disabled', 'disabled');
                form.find('.modal-body').append("<div class='center'><i class='icon-spinner icon-spin bigger-150 orange'></i></div>");

                var deferred = new $.Deferred;
                working = true;
                deferred.done(function() {
                    form.find('button').removeAttr('disabled');
                    form.find('input[type=file]').ace_file_input('enable');
                    form.find('.modal-body > :last-child').remove();

                    modal.modal("hide");

                    var thumb = file.next().find('img').data('thumb');
                    if (thumb)
                        $('#avatar2').get(0).src = thumb;

                    working = false;
                });


                setTimeout(function() {
                    deferred.resolve();
                }, parseInt(Math.random() * 800 + 800));

                return false;
            });

        });



        //////////////////////////////
        $('#profile-feed-1').slimScroll({
            height: '250px',
            alwaysVisible: true
        });

        $('.profile-social-links > a').tooltip();

        $('.easy-pie-chart.percentage').each(function() {
            var barColor = $(this).data('color') || '#555';
            var trackColor = '#E2E2E2';
            var size = parseInt($(this).data('size')) || 72;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size / 10),
                animate: false,
                size: size
            }).css('color', barColor);
        });

        ///////////////////////////////////////////

        //show the user info on right or left depending on its position
        $('#user-profile-2 .memberdiv').on('mouseenter', function() {
            var $this = $(this);
            var $parent = $this.closest('.tab-pane');

            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $this.offset();
            var w2 = $this.width();

            var place = 'left';
            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                place = 'right';

            $this.find('.popover').removeClass('right left').addClass(place);
        }).on('click', function() {
            return false;
        });


        ///////////////////////////////////////////
        $('#user-profile-3')
                .find('input[type=file]').ace_file_input({
            style: 'well',
            btn_choose: 'Change avatar',
            btn_change: null,
            no_icon: 'icon-picture',
            thumbnail: 'large',
            droppable: true,
            before_change: function(files, dropped) {
                var file = files[0];
                if (typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
                    if (!(/\.(jpe?g|png|gif)$/i).test(file))
                        return false;
                }
                else {//file is a File object
                    var type = $.trim(file.type);
                    if ((type.length > 0 && !(/^image\/(jpe?g|png|gif)$/i).test(type))
                            || (type.length == 0 && !(/\.(jpe?g|png|gif)$/i).test(file.name))//for android default browser!
                            )
                        return false;

                    if (file.size > 110000) {//~100Kb
                        return false;
                    }
                }

                return true;
            }
        })
                .end().find('button[type=reset]').on(ace.click_event, function() {
            $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
        })
                .end().find('.date-picker').datepicker().next().on(ace.click_event, function() {
            $(this).prev().focus();
        })
        $('.input-mask-phone').mask('(999) 999-9999');



        ////////////////////
        //change profile
        $('[data-toggle="buttons-radio"]').on('click', function(e) {
            var target = $(e.target);
            var which = parseInt($.trim(target.text()));
            $('.user-profile').parent().hide();
            $('#user-profile-' + which).parent().show();
        });
    });
</script>
<!--PROFILE PAGE ENDS-->

<!--PROFILE TAMBAH PAGE BEGINS-->

<!--PROFILE TAMBAH PAGE ENDS-->








