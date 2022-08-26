<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title class="top">แบบเอกสาร</title>
</head>

<body>
    <?php
    include('config.php');
    $sql = "SELECT * FROM problem WHERE user_id ='" . $_GET['user_id'] . "' LIMIT 1";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    if (mysqli_num_rows($result) == 0) {
        print "Error! ไม่พบ User ที่เลือก.";
        exit();
    }
    $info = mysqli_fetch_assoc($result);
    ?>
    <h2 class="fs-3 fw-bold">เรื่องร้องเรียน / สอบถาม จากประชาชน<br>ทาง เว็บไซต์กองช่าง
    </h2>
    <p class="p">เรียน นายกเทศมนตรีตำบลบางปู</p>
    <div class="all">
        <div class="title page">

            <label for="fullname">- กองช่างได้รับเรื่องร้องเรียน กรณีนี้จากเว็บไซต์ ของกองช่าง เมือวันที่</label>
            <?php
            $tim = explode("-", $info['time']);
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
            <?= $day ?> <?= $month[$monthh] ?> พ.ศ. <?= $year ?>
        </div>
        <div class="title page">
            <label for="fullname">-</label>
            <?= $info['pre'] . $info['fullname'] ?>
            <label for="fullname">เบอร์โทร</label>
            <?= $info['phone'] ?>
        </div>
        <div class="title page">
            <label for="fullname">- แจ้งเรื่อง</label>
            <?= $info['details'] ?><br>
            <label for="fullname">- บริเวณ</label>
            <?= $info['address'] ?>
        </div>
        <br>
        <?php
        if ($info['picture1'] != "") {
        ?>
            <img src="img/problem/<?= $info['picture1'] ?>" width="300">&nbsp;&nbsp;
        <?php
        }
        ?>

        <?php
        if ($info['picture2'] != "") {
        ?>
            <img src="img/problem/<?= $info['picture2'] ?>" width="300">
        <?php
        }
        ?>
        <br>
        <?php
        if (($info['status'] != "2") && ($info['status'] != "3")) {
        ?>
            <br><a id="hid" href="do_document.php?user_id=<?= $info['user_id'] ?>" class="btn btn-outline-info" >รับยื่นเรื่อง</a>&nbsp;&nbsp;
        <?php
        }
        ?>
        <input type="button" name="button" id="hid" value="Print" class="btn btn-outline-warning" onclick="print();">
    </div>
    <script src="js/java1.js"></script>
</body>

</html>