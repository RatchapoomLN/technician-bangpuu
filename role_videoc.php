<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styleshhet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/video.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">
    <title>Vdieo กองช่าง</title>
</head>
<body>
    <?php
    include('config.php');
    $sql = "SELECT * FROM construct WHERE user_id='".$_GET['user_id']."' LIMIT 1";
    $result = mysqli_query($link,$sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    ?>
    
    <header>
        <nav class="navbar fixed-top navbar-nav-scroll">
            <div class="header">
                <h1>Video ประกอบ</h1>
            </div>
        </nav>
    </header>
    <div class="text">
        ข้อมูลผู้ใช้ : <?= $row['pre'] . $row['fullname'] ?>&nbsp;||&nbsp;
        แจ้งเรื่อง : <?= $row['details'] ?>&nbsp;||&nbsp;<a href="role.php?page=construct">ย้อนกลับ</a>&nbsp;||&nbsp;<a href="img/construct/video/<?=$row['video']?>" class="b" download>โหลดคลิป</a>

    <div class="video"><video  height="800" controls src="img/construct/video/<?=$row['video']?>"></div>
    



</video>
</body>
</html>