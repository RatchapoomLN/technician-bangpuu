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
    <link rel="styleshhet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/firstoffice.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>เทศบาลบางปู กองช่าง</title>
</head>

<body>
    <div class="sidebar">
    <i class='bx bx-menu' id="btn"></i>
        <div class="image">
            <img src="img/272998080_300627335426032_906579638360875634_n.png" width="180px">
        </div>
        <div class="info">
            <h4>เทศบาลตำบลบางปู </br>แผนกกองช่าง</h4>
        </div>
        <ul class="nav_list">

                <li><a href="role.php?page=user"><i class='bx bxs-id-card'></i><span class="link_name">ข้อมูลพนักงาน</span></a></li>
                <li><a href="role.php?page=problem"><i class='bx bxs-bell-ring'></i><span class="link_name">รายการแจ้งปัญหา</span></a></li>
                <li><a href="role.php?page=construct"><i class='bx bx-hard-hat' ></i><span class="link_name">รายการก่อสร้าง-รื้อถอน</span></a></li>
                <li><a href="role.php?page=model"><i class='bx bx-paper-plane' ></i><span class="link_name">รายการแบบก่อสร้าง</span></a></li>
                <li><a href="role.php?page=taiban"><i class='bx bx-buildings'></i><span class="link_name">เขตท้ายบ้าน</span></a></li>
                <li><a href="role.php?page=taibanmai"><i class='bx bx-buildings'></i><span class="link_name">เขตท้ายบ้านใหม่</span></a></li>
                <li><a href="role.php?page=bangpuu"><i class='bx bx-buildings'></i><span class="link_name">เขตบางปู</span></a></li>
                <li><a href="role.php?page=bangpuumai"><i class='bx bx-buildings'></i><span class="link_name">เขตบางปูใหม่</span></a></li>
                <li><a href="role_backoffice_search.php" class="a"><i class='bx bx-search' ></i><span class="link_name">ค้นหา</span></a></li>
            <br>
            <li><a href="logout.php" id="log_out"><i class='bx bx-log-out' ></i><span class="link_name">ออกจากระบบ</span></a></li>
        </ul>
    </div>

    <div class="home text-center">
                <div class="container">
                    <h4 class="head">ยินดีต้อนรับ หลังบ้านร้องเรียน ร้องทุกข์ และสอบถาม เทศบาลตำบลบางปู(กองช่าง)</h4>
                    <p>กดเมนูด้านซ้าย เพื่อแก้ไขส่วนต่างๆ และ ระบบรับเรื่องหลังบ้าน</p>
                    <div class="imagehome"><img src="img/template/IMG20220511163824.jpg" height="700px"></div>
                    <h4 class=" fs-5">สำนักงานเทศบาลตำบลบางปู เลขที่ 789 หมู่ 1 ต.บางปูใหม่ อ.เมืองฯ จ.สมุทรปราการ 10280
                        <br>โทรศัพท์ : 0-2174-3399 โทรสาร : 02-323-9473 email : bangpoocity@hotmail.com
                    </h4>
                </div>
    </div>
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        btn.onclick = function(){
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>