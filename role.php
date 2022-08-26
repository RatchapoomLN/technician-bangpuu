<?php
session_start();

if (!isset($_SESSION['authen'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/backoffice.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Back Office กองช่าง(Employee)</title>
</head>

<body>
    <div class="sidebar">
        <div class="image">
            <img src="img/272998080_300627335426032_906579638360875634_n.png" width="180px">
        </div>
        <div class="info">
        <a href="office_role.php" id="first"><h4>เทศบาลตำบลบางปู </br>แผนกกองช่าง</h4></a>
        </div>
        <ul class="nav_list">

            <li><a href="role.php?page=user"><i class='bx bxs-id-card'></i><span class="link_name">พนักงาน</span></a></li>
            <li><a href="role.php?page=problem"><i class='bx bxs-bell-ring'></i><span class="link_name">รายการแจ้งปัญหา</span></a></li>
            <li><a href="role.php?page=construct"><i class='bx bx-hard-hat'></i><span class="link_name">รายการก่อสร้าง-รื้อถอน</span></a></li>
            <li><a href="role.php?page=model"><i class='bx bx-paper-plane'></i><span class="link_name">รายการแบบก่อสร้าง</span></a></li>
            <li><a href="role.php?page=taiban"><i class='bx bx-buildings'></i><span class="link_name">เขตท้ายบ้าน</span></a></li>
            <li><a href="role.php?page=taibanmai"><i class='bx bx-buildings'></i><span class="link_name">เขตท้ายบ้านใหม่</span></a></li>
            <li><a href="role.php?page=bangpuu"><i class='bx bx-buildings'></i><span class="link_name">เขตบางปู</span></a></li>
            <li><a href="role.php?page=bangpuumai"><i class='bx bx-buildings'></i><span class="link_name">เขตบางปูใหม่</span></a></li>
            <li><a href="role_backoffice_search.php" class="a"><i class='bx bx-search'></i><span class="link_name">ค้นหา</span></a></li>
            <br>
            <li><a href="logout.php" id="log_out"><i class='bx bx-log-out'></i><span class="link_name">ออกจากระบบ</span></a></li>
        </ul>
    </div>
    <div class="home">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td>
                    <?php

                    include('config.php');
                    if (!isset($_GET['page'])) //role//
                        $_GET['page'] = 'user';
                    if ($_GET['page'] == 'user') {
                        $sql = "SELECT * FROM account ORDER BY role";
                        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                    ?> <br>
                        <fieldset class="h border border-warning">
                            <div class="User">
                                <p class="use">ยินดีต้อนรับ เข้าสู่ระบบการใช้งาน</p>
                                <p class="usee">ชื่อผู้ใช้ : <?= $_SESSION['pre'] . " " . $_SESSION['fullname'] ?> <br>
                                    ตำแหน่งงาน : <?= $_SESSION['work'] ?></p>

                                <?php
                                if ($_SESSION['profile_img'] != "") {
                                ?>
                                    <img src="img/account/<?= $_SESSION['profile_img'] ?>" class=" rounded-2" width="400">
                                <?php
                                } else {
                                ?>
                                    <img src="img/none.png" class=" rounded-2" width="400">
                                <?php
                                }
                                ?>
                                <div class="signup-link">
                                    <a href="edit_role.php?user_id=<?= $_SESSION['user_id'] ?>" class="btn btn-outline-primary">เปลี่ยน Password</a>
                                </div>
                            </div>
                        </fieldset>
                    <?php
                    } elseif ($_GET['page'] == 'problem') { // รายการแจ้งปัญหา //
                        // ฟังก์ชัน หน้าถัดไป
                        $query = mysqli_query($link, "SELECT COUNT(user_id) FROM `problem`");
                        $rowu = mysqli_fetch_row($query);
                        $rows = $rowu[0];
                        $page_rows = 5;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 
                        $last = ceil($rows / $page_rows);
                        if ($last < 1) {
                            $last = 1;
                        }
                        $pagenum = 1;
                        if (isset($_GET['pn'])) {
                            $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
                        }
                        if ($pagenum < 1) {
                            $pagenum = 1;
                        } else if ($pagenum > $last) {
                            $pagenum = $last;
                        }
                        $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;
                        $nquery = mysqli_query($link, "SELECT * from  problem ORDER BY time DESC $limit");
                        $paginationCtrls = '';
                        if ($last != 1) {
                            if ($pagenum > 1) {
                                $previous = $pagenum - 1;
                                $paginationCtrls .= '><a href="' . $_SERVER['PHP_SELF'] . '?page=problem&pn=' . $previous . '" class="btn btn-info">กลับ</a> &nbsp; &nbsp; ';
                                for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                                    if ($i > 0) {
                                        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=problem&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                                    }
                                }
                            }
                            $paginationCtrls .= '' . $pagenum . ' &nbsp; ';
                            for ($i = $pagenum + 1; $i <= $last; $i++) {
                                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=problem&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                                if ($i >= $pagenum + 4) {
                                    break;
                                }
                            }
                            if ($pagenum != $last) {
                                $next = $pagenum + 1;
                                $paginationCtrls .= '&nbsp;&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '?page=problem&pn=' . $next . '" class="btn btn-info">ถัดไป</a>';
                            }
                        }
                    ?>
                        <p class="header">รายการแจ้งปัญหา</p>
                        <p class="text">เมื่อประชาชนแจ้งปัญหา = "รอรับเรื่อง", กดรับเรื่อง = "รับเรื่อง" , เข้าหน้าแบบเอกสารกดรับเรื่อง = "กำลังดำเนินการ" , ตอบกลับประชาชนหลังเสร็จสิ้นการดำเนินงานแก้ไข = "เสร็จสิ้นดำเนินการ"</p>
                        <table class="table table-striped table-bordered table-secondary" id="table1" border="1" class="tabaa" cellpadding="0" cellspacing="0">
                            <thead class="table-warning">
                                <tr>
                                    <th>ลำดับ</th>
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
                                while ($row = mysqli_fetch_array($nquery)) {
                                ?>
                                    <td><?= $row['user_id'] ?></td>
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
                                            <a href="role_video.php?user_id=<?= $row['user_id'] ?>"><video class=" text-center" src="img/problem/video/<?= $row['video'] ?> " width="100"></a>
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
                                            <a href="status_role_problem.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-secondary">รับเรื่อง</a><br>
                                            <div class="pt-1"></div>
                                        <?php
                                        }
                                        ?>
                                        <a href="role_document.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-info">แบบเอกสาร</a><br>
                                        <div class="pt-1"></div>
                                        <?php if ($row['status'] != "0") { ?>
                                            <a href="role_mail.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-success">ตอบกลับประชาชน</a><br>
                                            <div class="pt-1"></div><?php
                                                                }
                                                                    ?>
                                        <a href="delete_role_problem.php?page=problem&user_id=<?= $row['user_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                                    </td>
            </tr>
        <?php
                                }
        ?>
        </tbody>
        </table>
        <div id="pagination_controls" class="ps-4"><?php echo $paginationCtrls; ?></div>
        <br>
    <?php
                    } elseif ($_GET['page'] == 'construct') { // รายการแจ้งเรื่องก่อสร้างรื้อถอนอาคาร
                        // ฟังก์ชัน หน้าถัดไป
                        $query = mysqli_query($link, "SELECT COUNT(user_id) FROM `construct`");
                        $rowu = mysqli_fetch_row($query);
                        $rows = $rowu[0];
                        $page_rows = 5;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 
                        $last = ceil($rows / $page_rows);
                        if ($last < 1) {
                            $last = 1;
                        }
                        $pagenum = 1;
                        if (isset($_GET['pn'])) {
                            $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
                        }
                        if ($pagenum < 1) {
                            $pagenum = 1;
                        } else if ($pagenum > $last) {
                            $pagenum = $last;
                        }
                        $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;
                        $nquery = mysqli_query($link, "SELECT * from  construct ORDER BY time DESC $limit");
                        $paginationCtrls = '';
                        if ($last != 1) {
                            if ($pagenum > 1) {
                                $previous = $pagenum - 1;
                                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=construct&pn=' . $previous . '" class="btn btn-info">กลับ</a> &nbsp; &nbsp; ';
                                for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                                    if ($i > 0) {
                                        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=construct&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                                    }
                                }
                            }
                            $paginationCtrls .= '' . $pagenum . ' &nbsp; ';
                            for ($i = $pagenum + 1; $i <= $last; $i++) {
                                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=construct&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                                if ($i >= $pagenum + 4) {
                                    break;
                                }
                            }
                            if ($pagenum != $last) {
                                $next = $pagenum + 1;
                                $paginationCtrls .= '&nbsp;&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '?page=construct&pn=' . $next . '" class="btn btn-info">ถัดไป</a>';
                            }
                        }
    ?>
        <p class="heade">สอบถามแจ้งก่อสร้าง - รื้อถอนอาคาร</p>
        <p class="text">เมื่อประชาชนแจ้งเข้ามา = "รอดำเนินการ", กดรับเรื่อง = "รับเรื่องแล้ว" , เข้าหน้าแบบเอกสารกดรับเรื่อง = "กำลังดำเนินการ" , ตอบกลับประชาชนหลังเสร็จสิ้นการดำเนินงานแก้ไข = "เสร็จสิ้นดำเนินการ"</p>
        <table class="table table-striped table-bordered table-secondary" id="table1" border="1" cellpadding="0" cellspacing="0">
            <thead class="table-primary">
                <tr>
                    <th>ลำดับ</th>
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
                        while ($row = mysqli_fetch_array($nquery)) {
                ?>
                    <tr>
                        <td><?= $row['user_id'] ?></td>
                        <td><?= $row['inform'] ?></td>
                        <td><?= $row['pre'] . $row['fullname'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['details'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                            <?php
                            if ($row['video'] != "") {
                            ?>
                                <a href="role_videoc.php?user_id=<?= $row['user_id'] ?>"><video class=" text-center" src="img/construct/video/<?= $row['video'] ?> " width="100"></a>
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
                                <a href="status_role_construct.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-secondary">รับเรื่อง</a><br>
                                <div class="pt-1"></div>
                            <?php
                            }
                            ?>
                            <a href="role_documents.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-info">แบบเอกสาร</a><br>
                            <div class="pt-1"></div>
                            <?php if ($row['status'] != "0") { ?>
                                <a href="role_construct_mail.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-success">ตอบกลับประชาชน</a><br>
                                <div class="pt-1"></div><?php
                                                    }
                                                        ?>
                            <a href="delete_role_construct.php?page=construct&user_id=<?= $row['user_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                        </td>
                    </tr>
                <?php
                        }
                ?>
            </tbody>
        </table>
        <div id="pagination_controls" class="ps-4"><?php echo $paginationCtrls; ?></div>
        <br>
    <?php
                    } elseif ($_GET['page'] == 'model') { // รายการสอบถามแบบก่อสร้าง //
                        // ฟังก์ชัน หน้าถัดไป
                        $query = mysqli_query($link, "SELECT COUNT(user_id) FROM `model`");
                        $rowu = mysqli_fetch_row($query);
                        $rows = $rowu[0];
                        $page_rows = 5;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 
                        $last = ceil($rows / $page_rows);
                        if ($last < 1) {
                            $last = 1;
                        }
                        $pagenum = 1;
                        if (isset($_GET['pn'])) {
                            $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
                        }
                        if ($pagenum < 1) {
                            $pagenum = 1;
                        } else if ($pagenum > $last) {
                            $pagenum = $last;
                        }
                        $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;
                        $nquery = mysqli_query($link, "SELECT * from  model ORDER BY time DESC $limit");
                        $paginationCtrls = '';
                        if ($last != 1) {
                            if ($pagenum > 1) {
                                $previous = $pagenum - 1;
                                $paginationCtrls .= '<div class="g"><a href="' . $_SERVER['PHP_SELF'] . '?page=model&pn=' . $previous . '" class="btn btn-info">กลับ</a> &nbsp; &nbsp; ';
                                for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                                    if ($i > 0) {
                                        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=model&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                                    }
                                }
                            }
                            $paginationCtrls .= '' . $pagenum . ' &nbsp; ';
                            for ($i = $pagenum + 1; $i <= $last; $i++) {
                                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=model&pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                                if ($i >= $pagenum + 4) {
                                    break;
                                }
                            }
                            if ($pagenum != $last) {
                                $next = $pagenum + 1;
                                $paginationCtrls .= '&nbsp;&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '?page=model&pn=' . $next . '" class="btn btn-info">ถัดไป</a> </div>';
                            }
                        }
    ?>
        <p class="header">รายการแบบก่อสร้าง</p>
        <p class="text">เมื่อประชาชนสอบถาม = "รอดำเนินการ", กดรับทราบ = "รับเรื่อง" , เข้าหน้าแบบเอกสารกดรับเรื่อง = "กำลังตรวจสอบ" , ตอบกลับประชาชนหลังเสร็จสิ้นการดำเนินงาน = "เสร็จสิ้นดำเนินการ"</p>
        <table class="table table-striped table-bordered table-secondary" id="table1" border="1" cellpadding="0" cellspacing="0">
            <thead class="table-info">
                <tr>
                    <th>ลำดับ</th>
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
                        while ($row = mysqli_fetch_array($nquery)) {
                ?>
                    <tr>
                        <td><?= $row['user_id'] ?></td>
                        <td><?= $row['pre'] . $row['fullname'] ?></td>
                        <td><?= $row['address'] ?></td>
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
                                <a href="status_role_model.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-secondary">รับทราบแล้ว</a><br><div class="pt-1"></div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($row['status'] == "1") {
                            ?>
                                <a href="change_role_model.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-info">ตรวจสอบแบบ</a><br>
                                <div class="pt-1"></div>
                            <?php
                            }
                            ?>
                            <a href="role_model_mail.php?user_id=<?= $row['user_id'] ?>" class="btn btn-outline-success">ตอบกลับประชาชน</a><br>
                            <div class="pt-1"></div>
                            <a href="delete_role_model.php?page=model&user_id=<?= $row['user_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                        </td>
                    </tr>
                <?php
                        }
                ?>
            </tbody>
        </table>
        <div id="pagination_controls" class="ps-4"><?php echo $paginationCtrls; ?></div>
        <br>
    <?php
                    } elseif ($_GET['page'] == 'taiban') { //ท้ายบ้าน//
                        $sql = "SELECT * FROM taiban
                ORDER BY CONVERT (moo USING tis620) ";
                        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>
        <p class="header">เขตท้ายบ้าน</p>
        <p class="text">กดแก้ไข จะแสดงผลในส่วนด้านล่าง "ข้อมูลข้าราชการ" , รายละเอียดการรับผิดชอบ สามารถเว้นบรรทัดได้โดย Spacebar 1 ครั้ง</p>
        <table class="table table-striped table-bordered table-secondary" id="table1" border="1" cellpadding="0" cellspacing="0">
            <thead class="table-info">
                <tr>
                    <th>รูป</th>
                    <th>ชื่อนายช่าง</th>
                    <th>ตำแหน่งงาน</th>
                    <th>หมู่</th>
                    <th>ตำบล</th>
                    <th>รายละเอียดเขตรับผิดชอบ</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td>
                            <?php
                            if ($row['picture'] != "") {
                            ?>
                                <img src="img/taiban/<?= $row['picture'] ?>" width="80">
                            <?php
                            } else {
                            ?>
                                <img src="img/none.png" width="80">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?= $row['pre'] . $row['fullname'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td><?= $row['moo'] ?></td>
                        <td><?= $row['district'] ?></td>
                        <td class="bh"><?php
                                        $city = str_replace(' ', '<br>', $row['detail']);
                                        ?>
                            <?= print_r($city, true) ?></td>
                        <td>
                            <a href="role.php?page=taiban&pro_id=<?= $row['pro_id'] ?>" class="btn btn-outline-warning">แก้ไข</a>
                            &nbsp;&nbsp;
                            <a href="delete_role_taiban.php?page=taiban&pro_id=<?= $row['pro_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                        </td>
                    </tr>
                <?php
                        }
                ?>
            </tbody>
        </table>
        <?php
                        if (isset($_GET['pro_id'])) {
                            $sql = "SELECT * FROM taiban 
                                WHERE pro_id='" . $_GET['pro_id'] . "' LIMIT 1";
                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                            if (mysqli_num_rows($result) > 0) {
                                $p_info = mysqli_fetch_assoc($result);
                            }
                        }
        ?>
        <form action="save_role_taiban.php" id="formtai" method="post" autocomlete="off" enctype="multipart/form-data">
            <input type="hidden" name="page" value="taiban">
            <input type="hidden" name="pro_id" value="<?= @$_GET['pro_id'] ?>">
            <fieldset>
                <legend>ข้อมูลข้าราชการ</legend>
                <div class="form-group">
                    <label for="pre" class="tex">คำนำหน้า</label>
                    <select name="pre" id="pre" value="<?= @$p_info['pre'] ?>">
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>
                <div class=" p-1"></div>
                <div class="form-group">

                    <input type="text" name="fullname" id="input" placeholder="ชื่อนายช่าง" value="<?= @$p_info['fullname'] ?>">
                </div>
                <div class=" p-1"></div>
                <div class="form-group">
                    <input type="text" name="role" id="input" placeholder="ตำแหน่งงาน" value="<?= @$p_info['role'] ?>">
                </div>
                <div class=" p-1"></div>
                <div class="form-group">
                    <label for="moo">หมู่</label>
                    <select name="moo" id="moo" >
                                        <option value="1"<?php if(@$p_info['moo'] == 1){echo "selected";}?>>1</option>
                                        <option value="2"<?php if(@$p_info['moo'] == 2){echo "selected";}?>>2</option>
                                        <option value="3"<?php if(@$p_info['moo'] == 3){echo "selected";}?>>3</option>
                                        <option value="4"<?php if(@$p_info['moo'] == 4){echo "selected";}?>>4</option>
                                        <option value="5"<?php if(@$p_info['moo'] == 5){echo "selected";}?>>5</option>
                                        <option value="6"<?php if(@$p_info['moo'] == 6){echo "selected";}?>>6</option>
                                        <option value="7"<?php if(@$p_info['moo'] == 7){echo "selected";}?>>7</option>
                                        <option value="8"<?php if(@$p_info['moo'] == 8){echo "selected";}?>>8</option>
                                        <option value="9"<?php if(@$p_info['moo'] == 9){echo "selected";}?>>9</option>
                                        <option value="10"<?php if(@$p_info['moo'] == 10){echo "selected";}?>>10</option>
                                    </select>
                </div>
                <div class=" p-1"></div>
                <div class="form-group">
                    <label for="district" class="tex">ตำบล</label>
                    <select name="district" id="district" value="<?= @$p_info['district'] ?>">
                        <option value="ท้ายบ้าน">ท้ายบ้าน</option>
                    </select>
                </div>
                <div class=" p-1"></div>
                <div class="form-group">
                <textarea type="text" name="detail" id="input" placeholder="รายละเอียดเขตรับผิดชอบ"><?php echo htmlspecialchars(@$p_info['detail'] ?? ''); ?></textarea>

                </div>
                <div class=" p-1"></div>
                <div class="form-group">
                    <label for="picture" class="tex">รูป</label>
                    <input type="file" name="picture" id="picture" value="<?= $p_info['picture'] ?>">
                </div>
                <div class=" p-1"></div>
                <input type="button" class="btn btn-primary float-end w-25" id="btn-ok" value="บันทึก">
            </fieldset>
        </form>

    <?php
                    } elseif ($_GET['page'] == 'taibanmai') { //ท้ายบ้านใหม่//
                        $sql = "SELECT * FROM taibanmai
                ORDER BY CONVERT (moo USING tis620) ";
                        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>
        <p class="header">เขตท้ายบ้านใหม่</p>
        <p class="text">กดแก้ไข จะแสดงผลในส่วนด้านล่าง "ข้อมูลข้าราชการ" , รายละเอียดการรับผิดชอบ สามารถเว้นบรรทัดได้โดย Spacebar 1 ครั้ง</p>
        <table class="table table-striped table-bordered table-secondary" id="table1" border="1" cellpadding="0" cellspacing="0">
            <thead class="table-info">
                <tr>
                    <th>รูป</th>
                    <th>ชื่อนายช่าง</th>
                    <th>ตำแหน่งงาน</th>
                    <th>หมู่</th>
                    <th>ตำบล</th>
                    <th>รายละเอียดเขตรับผิดชอบ</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td>
                            <?php
                            if ($row['picture'] != "") {
                            ?>
                                <img src="img/taibanmai/<?= $row['picture'] ?>" width="80">
                            <?php
                            } else {
                            ?>
                                <img src="img/none.png" width="80">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?= $row['pre'] . $row['fullname'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td><?= $row['moo'] ?></td>
                        <td><?= $row['district'] ?></td>
                        <td class="bh"><?php
                                        $city = str_replace(' ', '<br>', $row['detail']);
                                        ?>
                            <?= print_r($city, true) ?></td>
                        <td>
                            <a href="role.php?page=taibanmai&pro_id=<?= $row['pro_id'] ?>" class="btn btn-outline-warning">แก้ไข</a>
                            &nbsp;&nbsp;
                            <a href="delete_role_taibanmai.php?page=taibanmai&pro_id=<?= $row['pro_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                        </td>
                    </tr>
                <?php
                        }
                ?>
            </tbody>
        </table>
        <?php
                        if (isset($_GET['pro_id'])) {
                            $sql = "SELECT * FROM taibanmai 
                                WHERE pro_id='" . $_GET['pro_id'] . "' LIMIT 1";
                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                            if (mysqli_num_rows($result) > 0) {
                                $p_info = mysqli_fetch_assoc($result);
                            }
                        }
        ?>
        <form action="save_role_taibanmai.php" id="formtai" method="post" autocomlete="off" enctype="multipart/form-data">
            <input type="hidden" name="page" value="taibanmai">
            <input type="hidden" name="pro_id" value="<?= @$_GET['pro_id'] ?>">
            <fieldset>
                <legend>ข้อมูลข้าราชการ</legend>
                <div class="form-group">
                    <label for="pre" class="tex">คำนำหน้า</label>
                    <select name="pre" id="pre" value="<?= @$p_info['pre'] ?>">
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div><div class=" p-1"></div>
                <div class="form-group">
                    <input type="text" name="fullname" id="input" placeholder="ชื่อนายช่าง" value="<?= @$p_info['fullname'] ?>">
                </div><div class=" p-1"></div>
                <div class="form-group">
                    <input type="text" name="role" id="input" placeholder="ตำแหน่งงาน" value="<?= @$p_info['role'] ?>">
                </div><div class=" p-1"></div>
                <div class="form-group">
                    <label for="moo" class="tex">หมู่</label>
                    <select name="moo" id="moo" >
                                        <option value="1"<?php if(@$p_info['moo'] == 1){echo "selected";}?>>1</option>
                                        <option value="2"<?php if(@$p_info['moo'] == 2){echo "selected";}?>>2</option>
                                        <option value="3"<?php if(@$p_info['moo'] == 3){echo "selected";}?>>3</option>
                                        <option value="4"<?php if(@$p_info['moo'] == 4){echo "selected";}?>>4</option>
                                        <option value="5"<?php if(@$p_info['moo'] == 5){echo "selected";}?>>5</option>
                                        <option value="6"<?php if(@$p_info['moo'] == 6){echo "selected";}?>>6</option>
                                        <option value="7"<?php if(@$p_info['moo'] == 7){echo "selected";}?>>7</option>
                                        <option value="8"<?php if(@$p_info['moo'] == 8){echo "selected";}?>>8</option>
                                        <option value="9"<?php if(@$p_info['moo'] == 9){echo "selected";}?>>9</option>
                                        <option value="10"<?php if(@$p_info['moo'] == 10){echo "selected";}?>>10</option>
                                    </select>
                </div><div class=" p-1"></div>
                <div class="form-group">
                    <label for="district" class="tex">ตำบล</label>
                    <select name="district" id="district" value="<?= @$p_info['district'] ?>">
                        <option value="ท้ายบ้านใหม่" selected>ท้ายบ้านใหม่</option>
                    </select>
                </div><div class=" p-1"></div>
                <div class="form-group">
                <textarea type="text" name="detail" id="input" placeholder="รายละเอียดเขตรับผิดชอบ"><?php echo htmlspecialchars(@$p_info['detail'] ?? ''); ?></textarea>

                </div><div class=" p-1"></div>
                <div class="form-group">
                <label for="picture" class="tex">รูป</label>
                <input type="file" name="picture" id="picture" value="<?= $p_info['picture'] ?>">
    </div><div class=" p-1"></div>
    <input type="button" class="btn btn-primary float-end w-25" id="btn-ok" value="บันทึก">
    </fieldset>
    </form>
<?php
                    } elseif ($_GET['page'] == 'bangpuu') { //บางปู//
                        $sql = "SELECT * FROM bangpuu
                ORDER BY CONVERT (moo USING tis620) ";
                        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <p class="header">เขตบางปู</p>
    <p class="text">กดแก้ไข จะแสดงผลในส่วนด้านล่าง "ข้อมูลข้าราชการ" , รายละเอียดการรับผิดชอบ สามารถเว้นบรรทัดได้โดย Spacebar 1 ครั้ง</p>
    <table class="table table-striped table-bordered table-secondary" id="table1" border="1" cellpadding="0" cellspacing="0">
        <thead class="table-info">
            <tr>
                <th>รูป</th>
                <th>ชื่อนายช่าง</th>
                <th>ตำแหน่งงาน</th>
                <th>หมู่</th>
                <th>ตำบล</th>
                <th>รายละเอียดเขตรับผิดชอบ</th>
                <th>แก้ไข</th>
            </tr>
        </thead>
        <tbody>
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td>
                        <?php
                            if ($row['picture'] != "") {
                        ?>
                            <img src="img/bangpuu/<?= $row['picture'] ?>" width="80">
                        <?php
                            } else {
                        ?>
                            <img src="img/none.png" width="80">
                        <?php
                            }
                        ?>
                    </td>
                    <td><?= $row['pre'] . $row['fullname'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><?= $row['moo'] ?></td>
                    <td><?= $row['district'] ?></td>
                    <td class="bh"><?php
                                    $city = str_replace(' ', '<br>', $row['detail']);
                                    ?>
                        <?= print_r($city, true) ?></td>
                    <td>
                        <a href="role.php?page=bangpuu&pro_id=<?= $row['pro_id'] ?>" class="btn btn-outline-warning">แก้ไข</a>
                        &nbsp;&nbsp;
                        <a href="delete_role_bangpuu.php?page=bangpuu&pro_id=<?= $row['pro_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                    </td>
                </tr>
            <?php
                        }
            ?>
        </tbody>
    </table>
    <?php
                        if (isset($_GET['pro_id'])) {
                            $sql = "SELECT * FROM bangpuu 
                                WHERE pro_id='" . $_GET['pro_id'] . "' LIMIT 1";
                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                            if (mysqli_num_rows($result) > 0) {
                                $p_info = mysqli_fetch_assoc($result);
                            }
                        }
    ?>
    <form action="save_role_bangpuu.php" id="formtai" method="post" autocomlete="off" enctype="multipart/form-data">
        <input type="hidden" name="page" value="bangpuu">
        <input type="hidden" name="pro_id" value="<?= @$_GET['pro_id'] ?>">
        <fieldset>
            <legend>ข้อมูลข้าราชการ</legend>
            <div class="form-group">
                <label for="pre" class="tex">คำนำหน้า</label>
                <select name="pre" id="pre" value="<?= @$p_info['pre'] ?>">
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div><div class=" p-1"></div>
            <div class="form-group">
                <input type="text" name="fullname" id="input" placeholder="ชื่อนายช่าง" value="<?= @$p_info['fullname'] ?>">
            </div><div class=" p-1"></div>
            <div class="form-group">
                <input type="text" name="role" id="input" placeholder="ตำแหน่งงาน" value="<?= @$p_info['role'] ?>">
            </div><div class=" p-1"></div>
            <div class="form-group">
                <label for="moo" class="tex">หมู่</label>
                <select name="moo" id="moo" >
                                        <option value="1"<?php if(@$p_info['moo'] == 1){echo "selected";}?>>1</option>
                                        <option value="2"<?php if(@$p_info['moo'] == 2){echo "selected";}?>>2</option>
                                        <option value="3"<?php if(@$p_info['moo'] == 3){echo "selected";}?>>3</option>
                                        <option value="4"<?php if(@$p_info['moo'] == 4){echo "selected";}?>>4</option>
                                        <option value="5"<?php if(@$p_info['moo'] == 5){echo "selected";}?>>5</option>
                                        <option value="6"<?php if(@$p_info['moo'] == 6){echo "selected";}?>>6</option>
                                        <option value="7"<?php if(@$p_info['moo'] == 7){echo "selected";}?>>7</option>
                                        <option value="8"<?php if(@$p_info['moo'] == 8){echo "selected";}?>>8</option>
                                        <option value="9"<?php if(@$p_info['moo'] == 9){echo "selected";}?>>9</option>
                                        <option value="10"<?php if(@$p_info['moo'] == 10){echo "selected";}?>>10</option>
                                    </select>
            </div><div class=" p-1"></div>
            <div class="form-group">
                <label for="district" class="tex">ตำบล</label>
                <select name="district" id="district" value="<?= @$p_info['district'] ?>">
                    <option value="บางปู" selected>บางปู</option>
                </select>
            </div><div class=" p-1"></div>
            <div class="form-group">
            <textarea type="text" name="detail" id="input" placeholder="รายละเอียดเขตรับผิดชอบ"><?php echo htmlspecialchars(@$p_info['detail'] ?? ''); ?></textarea>

            </div><div class=" p-1"></div>
            <div class="form-group">
            <label for="picture" class="tex">รูป</label>
            <input type="file" name="picture" id="picture" value="<?= $p_info['picture'] ?>">
            </div><div class=" p-1"></div>
            <input type="button" class="btn btn-primary float-end w-25" id="btn-ok" value="บันทึก">
        </fieldset>
    </form>
<?php
                    } elseif ($_GET['page'] == 'bangpuumai') { //บางปูใหม่//
                        $sql = "SELECT * FROM bangpuumai
                ORDER BY CONVERT (moo USING tis620) ";
                        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
?>
    <p class="header">เขตบางปูใหม่</p>
    <p class="text">กดแก้ไข จะแสดงผลในส่วนด้านล่าง "ข้อมูลข้าราชการ" , รายละเอียดการรับผิดชอบ สามารถเว้นบรรทัดได้โดย Spacebar 1 ครั้ง</p>
    <table class="table table-striped table-bordered table-secondary" border="1" cellpadding="0" cellspacing="0">
        <thead class="table-info">
            <tr>
                <th>รูป</th>
                <th>ชื่อนายช่าง</th>
                <th>ตำแหน่งงาน</th>
                <th>หมู่</th>
                <th>ตำบล</th>
                <th>รายละเอียดเขตรับผิดชอบ</th>
                <th>แก้ไข</th>
            </tr>
        </thead>
        <tbody>
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td>
                        <?php
                            if ($row['picture'] != "") {
                        ?>
                            <img src="img/bangpuumai/<?= $row['picture'] ?>" width="80">
                        <?php
                            } else {
                        ?>
                            <img src="img/none.png" width="80">
                        <?php
                            }
                        ?>
                    </td>
                    <td><?= $row['pre'] . $row['fullname'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><?= $row['moo'] ?></td>
                    <td><?= $row['district'] ?></td>
                    <td class="bh"><?php
                                    $city = str_replace(' ', '<br>', $row['detail']);
                                    ?>
                        <?= print_r($city, true) ?>

                    </td>
                    <td>
                        <a href="role.php?page=bangpuumai&pro_id=<?= $row['pro_id'] ?>" class="btn btn-outline-warning">แก้ไข</a>
                        &nbsp;&nbsp;
                        <a href="delete_role_bangpuumai.php?page=bangpuumai&pro_id=<?= $row['pro_id'] ?>" class="btn-del btn btn-outline-danger">ลบ</a>
                    </td>
                </tr>
            <?php
                        }
            ?>
        </tbody>
    </table>
    <?php
                        if (isset($_GET['pro_id'])) {
                            $sql = "SELECT * FROM bangpuumai 
                                WHERE pro_id='" . $_GET['pro_id'] . "' LIMIT 1";
                            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                            if (mysqli_num_rows($result) > 0) {
                                $p_info = mysqli_fetch_assoc($result);
                            }
                        }
    ?>
    <form action="save_role_bangpuumai.php" id="formtai" method="post" autocomlete="off" enctype="multipart/form-data">
        <input type="hidden" name="page" value="bangpuumai">
        <input type="hidden" name="pro_id" value="<?= @$_GET['pro_id'] ?>">
        <fieldset>
            <legend>ข้อมูลข้าราชการ</legend>
            <div class="form-group">
                <label for="pre" class="tex">คำนำหน้า</label>
                <select name="pre" id="pre" value="<?= @$p_info['pre'] ?>">
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div><div class=" p-1"></div>
            <div class="form-group">
                <input type="text" name="fullname" id="input" placeholder="ชื่อนายช่าง" value="<?= @$p_info['fullname'] ?>">
            </div><div class=" p-1"></div>
            <div class="form-group">
                <input type="text" name="role" id="input" placeholder="ตำแหน่งงาน" value="<?= @$p_info['role'] ?>">
            </div><div class=" p-1"></div>
            <div class="form-group">
                <label for="moo" class="tex">หมู่</label>
                <select name="moo" id="moo" >
                                        <option value="1"<?php if(@$p_info['moo'] == 1){echo "selected";}?>>1</option>
                                        <option value="2"<?php if(@$p_info['moo'] == 2){echo "selected";}?>>2</option>
                                        <option value="3"<?php if(@$p_info['moo'] == 3){echo "selected";}?>>3</option>
                                        <option value="4"<?php if(@$p_info['moo'] == 4){echo "selected";}?>>4</option>
                                        <option value="5"<?php if(@$p_info['moo'] == 5){echo "selected";}?>>5</option>
                                        <option value="6"<?php if(@$p_info['moo'] == 6){echo "selected";}?>>6</option>
                                        <option value="7"<?php if(@$p_info['moo'] == 7){echo "selected";}?>>7</option>
                                        <option value="8"<?php if(@$p_info['moo'] == 8){echo "selected";}?>>8</option>
                                        <option value="9"<?php if(@$p_info['moo'] == 9){echo "selected";}?>>9</option>
                                        <option value="10"<?php if(@$p_info['moo'] == 10){echo "selected";}?>>10</option>
                                    </select>
            </div><div class=" p-1"></div>
            <div class="form-group">
                <label for="district" class="tex">ตำบล</label>
                <select name="district" id="district" value="<?= @$p_info['district'] ?>">
                    <option value="บางปูใหม่" selected>บางปูใหม่</option>
                </select>
            </div><div class=" p-1"></div>
            <div class="form-group">
            <textarea type="text" name="detail" id="input" placeholder="รายละเอียดเขตรับผิดชอบ"><?php echo htmlspecialchars(@$p_info['detail'] ?? ''); ?></textarea>
            </div><div class=" p-1"></div>
            <div class="form-group">
            <label for="picture" class="tex">รูป</label>
            <input type="file" name="picture" id="picture" value="<?= $p_info['picture'] ?>">
            </div><div class=" p-1"></div>
            <input type="button" class="btn btn-primary float-end w-25" id="btn-ok" value="บันทึก">
        </fieldset>
    </form>
<?php
                    }
?>
</td>
</tr>
</table>
<br><br>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
    // delete-pro
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')
        Swal.fire({
            title: 'ยืนยันอีกครั้ง ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#ff0000',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });








    //ท้ายบ้าน
    $(document).ready(function() {
        $('form #btn-ok').click(function(e) {
            let $form = $(this).closest('form');
            Swal.fire({
                title: 'ยืนยันอีกครั้ง ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#ff0000',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    $form.submit();
                }
            });
        });
    })
    //ท้ายบ้านใหม่
    $(document).ready(function() {
        $('form #btn1-ok').click(function(e) {
            let $form = $(this).closest('form');
            Swal.fire({
                title: 'ยืนยันอีกครั้ง ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#ff0000',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    $form.submit();
                }
            });
        });
    })
    //บางปู
    $(document).ready(function() {
        $('form #btn2-ok').click(function(e) {
            let $form = $(this).closest('form');
            Swal.fire({
                title: 'ยืนยันอีกครั้ง ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#ff0000',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    $form.submit();
                }
            });
        });
    })
    //บางปูใหม่
    $(document).ready(function() {
        $('form #btn3-ok').click(function(e) {
            let $form = $(this).closest('form');
            Swal.fire({
                title: 'ยืนยันอีกครั้ง ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#ff0000',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    $form.submit();
                }
            });
        });
    })
</script>
</body>

</html>