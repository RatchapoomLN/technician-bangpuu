<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/table.css">
    <link rel="styleshhet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>ข้อมูลพนักงานกองช่าง</title>
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
                        <a href="index.php?page=problem" >แจ้งปัญหาร้องทุกข์ทั่วไป</a>
                        <a href="construct.php?page=construct">แจ้งก่อสร้าง และรื้อถอนอาคาร</a>
                        <a href="model.php?page=model">สอบถามแบบก่อสร้าง</a>
                    </div>
                </div>
                <div class="dropdownt">
                    <button class="dropbtn">เขตรับผิดชอบเจ้าหน้าที่ <i class='fas fa-angle-down' style='font-size:24px'></i></button>
                    <div class="dropdown-content">
                        <a href="taiban.php?page=taiban">เขตตำบลท้ายบ้าน</a>
                        <a href="taibanmai.php?page=taibanmai">เขตตำบลท้ายบ้านใหม่</a>
                        <a href="bangpuu.php?page=bangpuu"class=" text-succes fw-bold">เขตตำบลบางปู</a>
                        <a href="bangpuumai.php?page=bangpuumai">เขตตำบลบางปูใหม่</a>
                    </div>
                </div>
                <div class="dropdownt">
                <button class="dropbtn" onclick="location.href='search.php';">ค้นหาข้อมูลที่แจ้ง <i class='bx bx-search'style='font-size:24px'></i></button>
                </div>
            </div>
        </nav>
    </header>

            <?php
            include('config.php');
            if (!isset($_GET['page']))
            $_GET['page'] = 'bangpuu';
            if ($_GET['page'] =='bangpuu') { //manage user
                $sql = "SELECT * FROM bangpuu
                ORDER BY CONVERT (moo USING tis620)";
            $result = mysqli_query($link,$sql) or die(mysqli_error($link));
            ?><div class="p-3"></div>
            <p class="p">ผู้รับผิดชอบ เขตตำบลบางปู</p><div class="p-1"></div>
            <div class="table fs-6">
            <table class="table table-striped w-75 table-bordered " width="1000" border="1" cellpadding="0" cellspacing="0">
                <thead class="table-success">
                    <tr>
                        <th>รูป</th>
                        <th>ชื่อนายช่าง</th>
                        <th>ตำแหน่งงาน</th>
                        <th>หมู่</th>
                        <th>ตำบล</th>
                        <th>รายละเอียดเขตรับผิดชอบ</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row=mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                        <td>
                                        <?php
                                        if ($row['picture'] != "") {
                                        ?>
                                            <img src="img/bangpuu/<?= $row['picture'] ?>" width="130">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="img/none.png" width="130">
                                        <?php
                                        }
                                        ?>
                                    </td>
                            <td><?=$row['pre'].$row['fullname']?></td>
                            <td><?=$row['role']?></td>
                            <td><?=$row['moo']?></td>
                            <td><?=$row['district']?></td>
                            <td class="bh">                                    <?php
                                    $city = str_replace( ' ', '<br>', $row['detail'] );
                                    ?>
                                        <?= print_r($city, true) ?></td>
                            
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            </div>
            <br>
                <?php
            }
            ?>
        <br><br><br><br><br>
        <footer class="p-2 p-lg-3">
        <div class="foot">
            <h4>สำนักงานเทศบาลตำบลบางปู (กองช่าง)</h4>
            <p></p>&nbsp;&nbsp;<i class='fas fa-coffee' style='font-size:18px;color:brown'></i> เลขที่ 789 หมู่ 1 ต.บางปูใหม่ อ.เมืองฯ จ.สมุทรปราการ 10280
            <br>&nbsp;&nbsp;<i class='fas fa-mobile-alt' style='font-size:18px;color:cornflowerblue'></i> โทรศัพท์ : 0-2174-3399 <i class="fa fa-phone" style="font-size:18px;color:red"></i> โทรสาร : 02-323-9473
            <br>&nbsp;&nbsp;<span class="iconify" data-icon="logos:google-gmail"></span> email : bangpoocity@hotmail.com

        </div>
    </footer>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
</body>
</html>