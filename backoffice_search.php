<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/backoffice.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Back Office กองช่าง</title>
</head>

<body>
    <?php
    include('config.php');
    ?>
    <div class="sidebar">
        <div class="image">
            <img src="img/272998080_300627335426032_906579638360875634_n.png" width="180px">
        </div>
        <div class="info">
        <a href="firstoffice.php" id="first"><h4>เทศบาลตำบลบางปู </br>แผนกกองช่าง</h4></a>
        </div>
        <ul class="nav_list">
            <li><a href="backoffice.php?page=user"><i class='bx bxs-id-card'></i><span class="link_name">พนักงาน</span></a></li>
            <li><a href="backoffice.php?page=problem"><i class='bx bxs-bell-ring'></i><span class="link_name">รายการแจ้งปัญหา</span></a></li>
            <li><a href="backoffice.php?page=construct"><i class='bx bx-hard-hat'></i><span class="link_name">รายการก่อสร้าง-รื้อถอน</span></a></li>
            <li><a href="backoffice.php?page=model"><i class='bx bx-paper-plane'></i><span class="link_name">รายการแบบก่อสร้าง</span></a></li>
            <li><a href="backoffice.php?page=taiban"><i class='bx bx-buildings'></i><span class="link_name">เขตท้ายบ้าน</span></a></li>
            <li><a href="backoffice.php?page=taibanmai"><i class='bx bx-buildings'></i><span class="link_name">เขตท้ายบ้านใหม่</span></a></li>
            <li><a href="backoffice.php?page=bangpuu"><i class='bx bx-buildings'></i><span class="link_name">เขตบางปู</span></a></li>
            <li><a href="backoffice.php?page=bangpuumai"><i class='bx bx-buildings'></i><span class="link_name">เขตบางปูใหม่</span></a></li>
            <li><a href="backoffice_search.php" class="a"><i class='bx bx-search'></i><span class="link_name">ค้นหา</span></a></li>
            <br>
            <li><a href="logout.php" id="log_out"><i class='bx bx-log-out'></i><span class="link_name">ออกจากระบบ</span></a></li>
        </ul>
    </div>
    <div class="home">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr valign="top">
            <td>
                <br>
                <form method="get" id="form" enctype="multipart/form-data" action="">
                    <fieldset class="fi border border-success">
                        <h5>ค้นหาข้อมูล</h5>
                        <input type="text" name="search" id="pro" size="40" value="<?= (isset($_GET['search']) ? $_GET['search'] : ''); ?>">
                        <select name="pro" id="proselect" class="pro" value="">
                            <option value="problem" <?php if ((isset($_GET['pro']) ? $_GET['pro'] : '') == "problem") print 'selected'; ?>>แจ้งปัญหา</option>
                            <option value="construct" <?php if ((isset($_GET['pro']) ? $_GET['pro'] : '') == "construct") print 'selected'; ?>>ก่อสร้าง-รื้อถอน</option>
                            <option value="model" <?php if ((isset($_GET['pro']) ? $_GET['pro'] : '') == "model") print 'selected'; ?>>แบบก่อสร้าง</option>
                        </select> <input type="submit" class="btn btn-outline-primary" id="buttonsearch" value="ค้นหาข้อมูล">
                        <br>ตัวอย่างการค้นหาข้อมูลวันที่ : 29/06/2565 ( วันที่ 29 เดือน มิถุนายน พ.ศ.2565 )
                    </fieldset>
                </form>

                <?php
                include('config.php');
                $q = (isset($_GET['search']) ? $_GET['search'] : ''); //ช่องค้นหา
                $b = (isset($_GET['pro']) ? $_GET['pro'] : ''); //รายการ แจ้ง ก่อ แบบ


                // if ($dat != '') { //วันเดือนปี
                //     if (strlen($dat) > 5) {
                //         $tim = explode("/", $dat);
                //         $year = ($tim[2] - 543);
                //         $date = "$year-$tim[1]-$tim[0]";
                //         if ($b == "problem") {
                //             $searchsql = "SELECT * FROM problem WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         } else if ($b == "construct") {
                //             $searchsql = "SELECT * FROM construct WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         } else if ($b == "model") {
                //             $searchsql = "SELECT * FROM model WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         }
                //     }elseif(strlen($dat)== 4){
                //         $date = ($dat - 543);
                //         if ($b == "problem") {
                //             $searchsql = "SELECT * FROM problem WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         } else if ($b == "construct") {
                //             $searchsql = "SELECT * FROM construct WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         } else if ($b == "model") {
                //             $searchsql = "SELECT * FROM model WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         }
                //     }elseif(strlen($dat)==2){
                //         $date = $dat; 
                //         if ($b == "problem") {
                //             $searchsql = "SELECT * FROM problem WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         } else if ($b == "construct") {
                //             $searchsql = "SELECT * FROM construct WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         } else if ($b == "model") {
                //             $searchsql = "SELECT * FROM model WHERE time LIKE '%$date%'ORDER BY time DESC";
                //         }
                //     }
                // }else{
                //     $date = $dat;
                // }
                $num = count(explode("/","$q"));
                if($q == "รอรับเรื่อง"){
                    $status = 0;
                    print $status;
                    if ($b == "problem") {
                        $searchsql = "SELECT * FROM problem WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "construct") {
                        $searchsql = "SELECT * FROM construct WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "model") {
                        $searchsql = "SELECT * FROM model WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    }
                }else if($q == "รับเรื่องแล้ว"){
                    $status = 1;
                    if ($b == "problem") {
                        $searchsql = "SELECT * FROM problem WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "construct") {
                        $searchsql = "SELECT * FROM construct WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "model") {
                        $searchsql = "SELECT * FROM model WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    }
                }else if($q == "กำลังดำเนินการ"||$q == "กำลังตรวจสอบ"){
                    $status = 2;

                    if ($b == "problem") {
                        $searchsql = "SELECT * FROM problem WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "construct") {
                        $searchsql = "SELECT * FROM construct WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "model") {
                        $searchsql = "SELECT * FROM model WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    }
                }else if($q == "เสร็จสิ้นดำเนินการ"){
                    $status = 3;
                    if ($b == "problem") {
                        $searchsql = "SELECT * FROM problem WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "construct") {
                        $searchsql = "SELECT * FROM construct WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "model") {
                        $searchsql = "SELECT * FROM model WHERE status LIKE '%$status%'ORDER BY time DESC, user_id DESC";
                    }
                }
                
                else{
                if ($num != "1") {
                    $dat = explode("/", $q);
                    $year = ($dat[2] - 543);
                    $date = "$year-$dat[1]-$dat[0]";
                    if ($b == "problem") {
                        $searchsql = "SELECT * FROM problem WHERE time LIKE '%$date%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "construct") {
                        $searchsql = "SELECT * FROM construct WHERE time LIKE '%$date%'ORDER BY time DESC, user_id DESC";
                    } else if ($b == "model") {
                        $searchsql = "SELECT * FROM model WHERE time LIKE '%$date%'ORDER BY time DESC, user_id DESC";
                    }
                }else if ($q != '') {
                    if ($b == "problem") {
                        $searchsql = "SELECT * FROM problem WHERE inform LIKE '%$q%' OR fullname LIKE '%$q%' OR address LIKE '%$q%' OR details LIKE '%$q%' OR user_id LIKE '%$q%' OR time LIKE '%$q%' OR phone LIKE '%$q%' ORDER BY time DESC, user_id DESC";
                    } else if ($b == "construct") {
                        $searchsql = "SELECT * FROM construct WHERE inform LIKE '%$q%' OR fullname LIKE '%$q%' OR address LIKE '%$q%' OR details LIKE '%$q%' OR user_id LIKE '%$q%' OR time LIKE '%$q%' OR phone LIKE '%$q%' ORDER BY time DESC, user_id DESC";
                    } else if ($b == "model") {
                        $searchsql = "SELECT * FROM model WHERE fullname LIKE '%$q%' OR code LIKE '%$q%' OR detail LIKE '%$q%' OR address LIKE '%$q%' OR user_id LIKE '%$q%' OR time LIKE '%$q%' OR phone LIKE '%$q%' ORDER BY time DESC, user_id DESC";
                    } else {
                        $searchsql = "SELECT * FROM problem WHERE inform LIKE '%$q%' OR fullname LIKE '%$q%' OR address LIKE '%$q%' OR details LIKE '%$q%' OR user_id LIKE '%$q%' OR time LIKE '%$q%' OR phone LIKE '%$q%' ORDER BY time DESC, user_id DESC";
                    }
                }
            }
                // else if($q !=''){
                //     if ($b == "problem") {
                //         print "1";
                //         // $searchsq = "SELECT * FROM problem WHERE inform LIKE '%$q%' OR fullname LIKE '%$q%' OR address LIKE '%$q%' OR details LIKE '%$q%' ORDER BY time DESC";
                //         // $searchsql = "SELECT DISTINCT $searchsq FROM problem WHERE time LIKE '%$date%'";
                //         //$searchsql = "SELECT * FROM problem WHERE inform LIKE '%$q%' OR fullname LIKE '%$q%' OR address LIKE '%$q%' OR details LIKE '%$q%' UNION ALL SELECT * FROM problem WHERE time LIKE '%$date%'";
                //         $searchsql = "SELECT * FROM construct WHERE inform LIKE '%$q%' OR fullname LIKE '%$q%' OR address LIKE '%$q%' OR details LIKE '%$q%' AND time LIKE '%$date%'ORDER BY time DESC";
                //     } else if ($b == "construct") {
                //         $searchsql = "SELECT * FROM construct WHERE inform LIKE '%$q%' OR fullname LIKE '%$q%' OR address LIKE '%$q%' OR details LIKE '%$q%' AND time LIKE '%$date%'ORDER BY time DESC";
                //         $searchsql = "SELECT * FROM construct WHERE time LIKE '%$date%'";
                //     } else if ($b == "model") {
                //         $searchsql = "SELECT * FROM model WHERE fullname LIKE '%$q%' OR code LIKE '%$q%' OR detail LIKE '%$q%' OR address LIKE '%$q%' AND time LIKE '%$date%'ORDER BY time DESC";
                //         $searchsql = "SELECT * FROM model WHERE time LIKE '%$date%'";
                //     } else {
                //         $searchsql = "SELECT * FROM problem WHERE inform LIKE '%$q%' OR fullname LIKE '%$q%' OR address LIKE '%$q%' OR details LIKE '%$q%' AND time LIKE '%$date%' ORDER BY time DESC";
                //         $searchsql = "SELECT * FROM problem WHERE time LIKE '%$date%'";
                //     }
                // }





                error_reporting(0);//ปิด ERROR//
                $res = mysqli_query($link, $searchsql);


                if ($q != '' || $dat != '') {
                ?>
                    <br><p class="search border border-danger">ผลลัพธ์การค้นหา<?php if (mysqli_num_rows($res) == 0) {
                                                            print " <font color='red'>ไม่พบข้อมูลที่ค้นหา!! </font>";
                                                        } else {
                                                            print " พบข้อมูลที่ค้นหา " . mysqli_num_rows($res) . " รายการ";
                                                        } ?></p>
                    <?php
                    if(mysqli_num_rows($res) == 0){}
                    else{
                    if ($b == "problem") { //ถ้าเลือกแจ้งปัญหาจะแสดงตารางแจ้งปัญหา
                    ?>
                        <p class="header">รายการแจ้งปัญหา</p>
                        <table class="table table-striped table-bordered table-secondary" id="table1" border="1" cellpadding="0" cellspacing="0">
                            <thead class="table-warning">
                                <tr><th>ลำดับ</th>
                                    <th>หมวด</th>
                                    <th>ชื่อผู้แจ้ง</th>
                                    <th>บริเวณ</th>
                                    <th>รายละเอียดปัญหา</th>
                                    <th>เบอร์ติดต่อ</th>
                                    <th>อีเมลติดต่อ</th>
                                    <th>video</th>
                                    <th>วันแจ้งเรื่อง</th>
                                    <th>สถานะ</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($res)) {
                                ?>
                                    <tr><td><?= $row['user_id'] ?></td>
                                        <td><?= $row['inform'] ?></td>
                                        <td><?= $row['pre'] . $row['fullname'] ?></td>
                                        <td class="address"><?= $row['address'] ?></td>
                                        <td class="datails"><?= $row['details'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['video'] != "") {
                                            ?>
                                                <a href="video.php?user_id=<?= $row['user_id'] ?>"><video class=" text-center" src="img/problem/video/<?= $row['video'] ?> " width="100"></a>

                                            <?php
                                            } else {
                                            ?>
                                                <p>-</p>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $tim = explode("-", $row['time']);
                                            $day = $tim[2];
                                            if ($tim[1] != "10" && $tim[1] != "11" && $tim[1] != "12") {
                                                $monthtake = explode("0", $tim[1]);
                                                $monthh = $monthtake[1];
                                            } else {
                                                $monthh = $tim[1];
                                            }
                                            $month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                            $year = ($tim[0] + 543);
                                            ?>
                                            <?= $day ?> <?= $month[$monthh] ?> <?= $year ?>
                                        </td>

                                        <td>
                                            <div id="status">
                                                <?php
                                                if ($row['status'] == "0") {
                                                    echo "<font color='red'>รอรับเรื่อง</font>";
                                                } elseif ($row['status'] == "1") {
                                                    echo "<font color='yellow'>รับเรื่องแล้ว</font>";
                                                } elseif ($row['status'] == "2") {
                                                    echo "<font color='aquamarine'>กำลังดำเนินการ</font>";
                                                } elseif ($row['status'] == "3") {
                                                    echo "<font color='green'>เสร็จสิ้นดำเนินการ</font>";
                                                } else {
                                                    echo "ผลลัพธ์ไม่ถูกต้อง";
                                                }
                                                ?></div>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['status'] == "0") {
                                            ?>
                                                <a href="status_problem.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-secondary">รับเรื่อง</a><br>
                                                <div class="pt-1"></div>
                                            <?php
                                            }
                                            ?>
                                            <a href="document.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-info">แบบเอกสาร</a><br>
                                            <div class="pt-1"></div>
                                            <?php if ($row['status'] != "0") { ?>
                                                <a href="mail.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-success">ตอบกลับประชาชน</a><br>
                                                <div class="pt-1"></div><?php
                                                                    }
                                                                        ?>
                                            <a href="delete_problem.php?page=problem&user_id=<?= $row['user_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    } elseif ($b == "construct") //ถ้าเลือก ก่อสร้างจะแสดงตารางก่อสร้าง
                    {
                    ?><p class="heade">สอบถามแจ้งก่อสร้าง - รื้อถอนอาคาร</p>
                        <table class="table table-striped table-bordered table-secondary" id="table1" border="1" cellpadding="0" cellspacing="0">
                            <thead class="table-primary">
                                <tr><th>ลำดับ</th>
                                    <th>หมวด</th>
                                    <th>ชื่อผู้แจ้ง</th>
                                    <th>บริเวณ</th>
                                    <th>รายละเอียดปัญหา</th>
                                    <th>เบอร์ติดต่อ</th>
                                    <th>อีเมลติดต่อ</th>
                                    <th>video</th>
                                    <th>วันแจ้งเรื่อง</th>
                                    <th>สถานะ</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($res)) {
                                ?>
                                    <tr><td><?= $row['user_id'] ?></td>
                                        <td><?= $row['inform'] ?></td>
                                        <td><?= $row['pre'] . $row['fullname'] ?></td>
                                        <td class="address"><?= $row['address'] ?></td>
                                        <td class="datails"><?= $row['details'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td>
                                            <?php
                                            if ($row['video'] != "") {

                                            ?>
                                                <a href="videoc.php?user_id=<?= $row['user_id'] ?>"><video class=" text-center" src="img/construct/video/<?= $row['video'] ?> " width="100"></a>

                                            <?php
                                            } else {
                                            ?>
                                                <p>-</p>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $tim = explode("-", $row['time']);
                                            $day = $tim[2];
                                            if ($tim[1] != "10" && $tim[1] != "11" && $tim[1] != "12") {
                                                $monthtake = explode("0", $tim[1]);
                                                $monthh = $monthtake[1];
                                            } else {
                                                $monthh = $tim[1];
                                            }
                                            $month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                            $year = ($tim[0] + 543);
                                            ?>
                                            <?= $day ?> <?= $month[$monthh] ?> <?= $year ?>
                                        </td>
                                        <td>
                                            <div id="status">
                                                <?php
                                                if ($row['status'] == "0") {
                                                    echo "<font color='red'>รอรับเรื่อง</font>";
                                                } elseif ($row['status'] == "1") {
                                                    echo "<font color='yellow'>รับเรื่องแล้ว</font>";
                                                } elseif ($row['status'] == "2") {
                                                    echo "<font color='aquamarine'>กำลังดำเนินการ</font>";
                                                } elseif ($row['status'] == "3") {
                                                    echo "<font color='green'>เสร็จสิ้นดำเนินการ</font>";
                                                } else {
                                                    echo "ผลลัพธ์ไม่ถูกต้อง";
                                                }
                                                ?></div>
                                        </td>

                                        <td>
                                            <?php
                                            if ($row['status'] == "0") {
                                            ?>
                                                <a href="status_construct.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-secondary">รับเรื่อง</a><br>
                                                <div class="pt-1"></div>
                                            <?php
                                            }
                                            ?>
                                            <a href="documents.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-info">แบบเอกสาร</a><br>
                                            <div class="pt-1"></div>
                                            <?php if ($row['status'] != "0") { ?>
                                                <a href="construct_mail.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-success">ตอบกลับประชาชน</a><br>
                                                <div class="pt-1"></div><?php
                                                                    }
                                                                        ?>
                                            <a href="delete_construct.php?page=construct&user_id=<?= $row['user_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php
                    } elseif ($b == "model") { //ถ้าเลือก แบบจะแสดงตารางแบบ
                    ?><p class="header">รายการแบบก่อสร้าง</p>
                        <table class="table table-striped table-bordered table-secondary" id="table1" border="1" cellpadding="0" cellspacing="0">
                            <thead class="table-info">
                                <tr><th>ลำดับ</th>
                                    <th>ชื่อผู้แจ้ง</th>
                                    <th>ที่อยู่</th>
                                    <th>เลขที่แบบ</th>
                                    <th>รายละเอียด</th>
                                    <th>เบอร์ติดต่อ</th>
                                    <th>อีเมลติดต่อ</th>
                                    <th>วันแจ้งเรื่อง</th>
                                    <th>สถานะ</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($res)) {
                                ?>
                                    <tr><td><?= $row['user_id'] ?></td>
                                        <td><?= $row['pre'] . $row['fullname'] ?></td>
                                        <td class="address"><?= $row['address'] ?></td>
                                        <td><?= $row['code'] ?></td>
                                        <td><?= $row['detail'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td>
                                            <?php
                                            $tim = explode("-", $row['time']);
                                            $day = $tim[2];
                                            if ($tim[1] != "10" && $tim[1] != "11" && $tim[1] != "12") {
                                                $monthtake = explode("0", $tim[1]);
                                                $monthh = $monthtake[1];
                                            } else {
                                                $monthh = $tim[1];
                                            }
                                            $month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                            $year = ($tim[0] + 543);
                                            ?>
                                            <?= $day ?> <?= $month[$monthh] ?> <?= $year ?>
                                        </td>
                                        <td>
                                            <div id="status">
                                                <?php
                                                if ($row['status'] == "0") {
                                                    echo "<font color='red'>รอรับเรื่อง</font>";
                                                } elseif ($row['status'] == "1") {
                                                    echo "<font color='yellow'>รับเรื่องแล้ว</font>";
                                                } elseif ($row['status'] == "2") {
                                                    echo "<font color='aquamarine'>กำลังตรวจสอบ</font>";
                                                } elseif ($row['status'] == "3") {
                                                    echo "<font color='green'>เสร็จสิ้นดำเนินการ</font>";
                                                } else {
                                                    echo "ผลลัพธ์ไม่ถูกต้อง";
                                                }
                                                ?></div>
                                        </td>

                                        <td>
                                            <?php
                                            if ($row['status'] == "0") {
                                            ?>
                                                <a href="status_model.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-secondary">รับทราบแล้ว</a><br>
                                            <?php
                                            }
                                            ?>

                                            <?php
                                            if ($row['status'] == "1") {
                                            ?>
                                                <a href="change_model.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-info">ตรวจสอบแบบ</a><br>
                                                <div class="pt-1"></div>
                                            <?php
                                            }
                                            ?>
                                            <a href="model_mail.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-success">ตอบกลับประชาชน</a><br>
                                            <div class="pt-1"></div>
                                            <a href="delete_model.php?page=model&user_id=<?= $row['user_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                <?php
                    }
                }}
                ?>
</div>

</body>

</html>