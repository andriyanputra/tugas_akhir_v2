<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SIM Proteksi Kebakaran Perkotaan</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--basic styles-->

        <link href="../assets/css-ace/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css-ace/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/css-ace/font-awesome.min.css" />
        <link rel="stylesheet" href="../assets/css-zoom/style.css" />

        <link rel="shortcut icon" href="../assets/img/favicon.png">

        <!--page specific plugin styles-->
        <link rel="stylesheet" href="../assets/css-ace/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="../assets/css-ace/chosen.css" />
        <link rel="stylesheet" href="../assets/css-ace/jquery.gritter.css" />
        <link rel="stylesheet" href="../assets/css-ace/select2.css" />
        <link rel="stylesheet" href="../assets/css-ace/bootstrap-editable.css" />
        <link rel="stylesheet" href="../assets/css-ace/fullcalendar.css" />
        <link rel="stylesheet" href="../assets/css-ace/bootstrap-timepicker.css" />
        <link rel="stylesheet" type="text/css" href="../assets/css-ace/sweet-alert.css">
        <!--fonts-->

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--ace styles-->
        <script type="text/javascript" src="../assets/js-ace/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#kecamatan").change(function() {
                    $(this).after('<span class="help-inline"><div id="loader"><img src="../assets/img/loading.gif" alt="loading subcategory" /></div></span>');
                    $.get('kecamatan.php?kecamatan=' + $(this).val(), function(data) {
                        $("#desa").html(data);
                        $('#loader').slideUp(200, function() {
                            $(this).remove();
                        });
                    });
                });

            });
        </script>
        <link rel="stylesheet" href="../assets/css-ace/ace.min.css" />
        <link rel="stylesheet" href="../assets/css-ace/ace-responsive.min.css" />
        <link rel="stylesheet" href="../assets/css-ace/ace-skins.min.css" />
        <style type="text/css">
            body,td,th {
                font-family: "Open Sans";
            }
            .blink {
              -moz-animation-duration: 800ms;
              -moz-animation-name: blink;
              -moz-animation-iteration-count: infinite;
              -moz-animation-direction: alternate;
              
              -webkit-animation-duration: 800ms;
              -webkit-animation-name: blink;
              -webkit-animation-iteration-count: infinite;
              -webkit-animation-direction: alternate;
              
              animation-duration: 800ms;
              animation-name: blink;
              animation-iteration-count: infinite;
              animation-direction: alternate;
            }

            @-moz-keyframes blink {
              from {
                opacity: 1;
              }
              
              to {
                opacity: 0;
              }
            }

            @-webkit-keyframes blink {
              from {
                opacity: 1;
              }
              
              to {
                opacity: 0;
              }
            }

            @keyframes blink {
              from {
                opacity: 1;
              }
              
              to {
                opacity: 0;
              }
            }
        </style>
        <!--inline styles related to this page-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>



