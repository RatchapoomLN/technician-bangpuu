<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styleshhet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">

    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Log-in พนักงานกองช่าง</title>
</head>

<body>
    <!-- หัว -->  
    <header>
        <nav class="navbar">
            <div class="header">

                <img src="img/272998080_300627335426032_906579638360875634_n.png" width="70px" class="imgtop">
                <h2 class=" pt-3 fw-bold">&nbsp;ยินดีต้อนรับ สู่เว็บไชต์ร้องเรียน ร้องทุกข์ และสอบถาม เทศบาลตำบลบางปู (กองช่าง)</h2>
                <a href="main.php">กลับไปหน้าเว็บไซต์</a>
            </div>
        </nav>
    </header><div class="p-3"></div>
    <p class="p">เข้าสู่ระบบ เฉพาะเจ้าหน้าที่</p>
    <div class="login">
        <form action="do_login.php" method="post" autocomplete="off">
            <div class="txt-field">
                <label for="user">ชื่อ User</label><br>
                <input type="text" name="user" id="user" required>
            </div>

            <div class="txt-field">
                <label for="password">รหัสผ่าน</label><br>
                <input type="password" name="password" id="myInput" required>
            </div>
            <div class="p-3"></div>
            <button type="submit " class="but btn btn-outline-info p-2 fs-5">เข้าสู่ระบบ</button>
        </form>
    </div>


    <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer class="p-2 p-lg-3">
        <div class="foot">
            <h4>สำนักงานเทศบาลตำบลบางปู (กองช่าง)</h4>
            <p></p>&nbsp;&nbsp;<i class='fas fa-coffee' style='font-size:18px;color:brown'></i> เลขที่ 789 หมู่ 1 ต.บางปูใหม่ อ.เมืองฯ จ.สมุทรปราการ 10280
            <br>&nbsp;&nbsp;<i class='fas fa-mobile-alt' style='font-size:18px;color:cornflowerblue'></i> โทรศัพท์ : 0-2174-3399 <i class="fa fa-phone" style="font-size:18px;color:red"></i> โทรสาร : 02-323-9473
            <br>&nbsp;&nbsp;<span class="iconify" data-icon="logos:google-gmail"></span> email : bangpoocity@hotmail.com

        </div>
    </footer>
    <!-- js -->
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="js/see.js"></script>
</body>

</html>