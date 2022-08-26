<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styleshhet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>Search ข้อมูลที่แจ้ง</title>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="header">

                <img src="img/272998080_300627335426032_906579638360875634_n.png" width="70px" class="imgtop">
                <h2 class=" pt-3 fw-bold">&nbsp;ร้องเรียน ร้องทุกข์ และสอบถาม เทศบาลตำบลบางปู (กองช่าง)</h2>
                <a href="main.php"class="dropdow">กลับหน้าหลัก</a>
                <div class="dropdown">
                    <button class="dropbtn">แจ้ง ร้องทุกข์ - สอบถาม <i class='fas fa-angle-down' style='font-size:24px'></i></button>
                    <div class="dropdown-content">
                        <a href="index.php?page=problem">แจ้งปัญหาร้องทุกข์ทั่วไป</a>
                        <a href="construct.php?page=construct">แจ้งก่อสร้าง และรื้อถอนอาคาร</a>
                        <a href="model.php?page=model">สอบถามแบบก่อสร้าง</a>
                    </div>
                </div>
                <div class="dropdownt">
                    <button class="dropbtn">เขตรับผิดชอบเจ้าหน้าที่ <i class='fas fa-angle-down' style='font-size:24px'></i></button>
                    <div class="dropdown-content">
                        <a href="taiban.php?page=taiban">เขตตำบลท้ายบ้าน</a>
                        <a href="taibanmai.php?page=taibanmai">เขตตำบลท้ายบ้านใหม่</a>
                        <a href="bangpuu.php?page=bangpuu">เขตตำบลบางปู</a>
                        <a href="bangpuumai.php?page=bangpuumai">เขตตำบลบางปูใหม่</a>
                    </div>
                </div>
                <div class="dropdownt">
                    <button class="dropbtn fw-bold" id="search" onclick="location.href='search.php';">ค้นหาข้อมูลที่แจ้ง <i class='bx bx-search' style='font-size:24px'></i></button>
                </div>
            </div>
        </nav>
    </header>

    <div class="home">
        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td>
                    <br>
                    <form method="get" id="form" class="border border-success" enctype="multipart/form-data" action="">
                        <fieldset class="fi ps-4">
                            <h5>ค้นหาข้อมูล</h5>
                            <input type="text" name="search" id="pro" size="40" value="<?= (isset($_GET['search']) ? $_GET['search'] : ''); ?>">
                             <input type="submit" class="btn btn-outline-primary" id="pro" value="ค้นหาข้อมูล">
                            <br>ใส่เบอร์โทรศัพท์ ที่ส่งแจ้งเรื่อง
                        </fieldset>
                    </form>

                    
                    <?php
                    $q = (isset($_GET['search']) ? $_GET['search'] : ''); //ช่องค้นหา
                    if($q !=''){
                    include('config.php');
                    $num = strlen($q);
                    if($q != ''){
                    if($num = 10){
                    $searchsql = "SELECT * FROM problem WHERE phone LIKE '%$q%'ORDER BY time DESC, user_id DESC";
                    $searchsql1 = "SELECT * FROM construct WHERE phone LIKE '%$q%'ORDER BY time DESC, user_id DESC";
                    $searchsql2 = "SELECT * FROM model WHERE phone LIKE '%$q%'ORDER BY time DESC, user_id DESC";
                    }}


                    //error_reporting(0); //ปิด ERROR//
                    $res = mysqli_query($link, $searchsql);
                    $res1 = mysqli_query($link, $searchsql1);
                    $res2 = mysqli_query($link, $searchsql2);
                    $count = mysqli_num_rows($res)+mysqli_num_rows($res1)+mysqli_num_rows($res2);
                    {
                    ?>
                        <br><p class="search border border-info">ผลลัพธ์การค้นหา<?php if ($count == 0) {
                                                                print "<font color='red'>ไม่พบข้อมูลที่ค้นหา!! </font>";
                                                            } else {
                                                                print " พบข้อมูลที่ค้นหา " . $count . " รายการ";
                                                            } ?></p>
                        <?php
                        if($count == 0){}
                        else{
                        ?>
                            <p class="header">รายการ</p>
                            <table class="table table-striped table-bordered table-primary" id="table1" border="1" cellpadding="0" cellspacing="0">
                                <thead class="table-danger">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>หมวด/เลขแบบ</th>
                                        <th>ชื่อผู้แจ้ง</th>
                                        <th>บริเวณ</th>
                                        <th>รายละเอียด</th>
                                        <th>วันแจ้งเรื่อง</th>
                                        <th>สถานะ</th>
                                        <th>แก้ไข</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <tr>
                                            <td><?= $row['user_id'] ?></td>
                                            <td><?= $row['inform'] ?></td>
                                            <td><?= $row['pre'] . $row['fullname'] ?></td>
                                            <td class="address"><?= $row['address'] ?></td>
                                            <td class="datails"><?= $row['details'] ?></td>
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
                                            if($row['status'] == "0"){
                                            ?>
                                            <a href="search_del.php?&user_id=<?= $row['user_id'] ?>&phone=<?= $row['phone'] ?>" class="btn-del btn btn-outline-warning">ยกเลิก</a>
                                            <?php
                                            }
                                            ?>
                                    </td>
                                        </tr>
                                    <?php
                                    }while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <tr>
                                            <td><?= $row['user_id'] ?></td>
                                            <td><?= $row['inform'] ?></td>
                                            <td><?= $row['pre'] . $row['fullname'] ?></td>
                                            <td class="address"><?= $row['address'] ?></td>
                                            <td class="datails"><?= $row['details'] ?></td>
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
                                            if($row['status'] == "0"){
                                            ?>
                                            <a href="search_del.php?&user_id=<?= $row['user_id'] ?>&phone=<?= $row['phone'] ?>&address=<?= $row['address'] ?>" class="btn-del btn btn-outline-warning">ยกเลิก</a>
                                            <?php
                                            }
                                            ?>
                                    </td>
                                        </tr>
                                    <?php
                                    }while ($row = mysqli_fetch_array($res1)) {
                                        ?>
                                            <tr><td><?= $row['user_id'] ?></td>
                                                <td><?= $row['inform'] ?></td>
                                                <td><?= $row['pre'] . $row['fullname'] ?></td>
                                                <td><?= $row['address'] ?></td>
                                                <td><?= $row['details'] ?></td>
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
                                            if($row['status'] == "0"){
                                            ?>
                                            <a href="search_del.php?&user_id=<?= $row['user_id'] ?>&phone=<?= $row['phone'] ?>&address=<?= $row['address'] ?>" class="btn-del btn btn-outline-warning">ยกเลิก</a>
                                            <?php
                                            }
                                            ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }while ($row = mysqli_fetch_array($res2)) {
                                            ?>
                                                <tr>
                                                    <td><?= $row['user_id'] ?></td>
                                                    <td><?= $row['code'] ?></td>
                                                    <td><?= $row['pre'] . $row['fullname'] ?></td>
                                                    <td><?= $row['address'] ?></td>
                                                    <td><?= $row['detail'] ?></td>
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
                                                    <td class="bg">
                                                        <?php
                                                        if ($row['status'] == "0") {
                                                            echo "<font color='red'>รอรับเรื่อง</font>";
                                                        } elseif ($row['status'] == "1") {
                                                            echo "<font color='yellow'>รับเรื่องแล้ว</font>";
                                                        } elseif ($row['status'] == "2") {
                                                            echo "<font color='blue'>กำลังตรวจสอบ</font>";
                                                        } elseif ($row['status'] == "3") {
                                                            echo "<font color='green'>เสร็จสิ้นดำเนินการ</font>";
                                                        } else {
                                                            echo "ผลลัพธ์ไม่ถูกต้อง";
                                                        }
                                                        ?>
                                                    </td>
            
                                                    <td>
                                                <?php
                                            if($row['status'] == "0"){
                                            ?>
                                            <a href="search_del.php?&user_id=<?= $row['user_id'] ?>&phone=<?= $row['phone'] ?>&address=<?= $row['address'] ?>" class="btn-del btn btn-outline-warning">ยกเลิก</a>
                                            <?php
                                            }
                                            ?>
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

    <footer class="foot1 p-2 p-lg-3">
        <div class="foot">
            <h4>สำนักงานเทศบาลตำบลบางปู (กองช่าง)</h4>
            <p></p>&nbsp;&nbsp;<i class='fas fa-coffee' style='font-size:18px;color:brown'></i> เลขที่ 789 หมู่ 1 ต.บางปูใหม่ อ.เมืองฯ จ.สมุทรปราการ 10280
            <br>&nbsp;&nbsp;<i class='fas fa-mobile-alt' style='font-size:18px;color:cornflowerblue'></i> โทรศัพท์ : 0-2174-3399 <i class="fa fa-phone" style="font-size:18px;color:red"></i> โทรสาร : 02-323-9473
            <br>&nbsp;&nbsp;<span class="iconify" data-icon="logos:google-gmail"></span> email : bangpoocity@hotmail.com

        </div>
    </footer>


    <script src="js/main.js"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script>
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
    });</script>
</body>

</html>