<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styleshhet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/mail.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Email</title>
</head>

<body>
    <?php
    include('config.php');
    $sql = "SELECT * FROM construct WHERE user_id ='" . $_GET['user_id'] . "' LIMIT 1";

    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    if (mysqli_num_rows($result) == 0) {
        print "Error! ไม่พบ User ที่เลือก.";
        exit();
    }
    $info = mysqli_fetch_assoc($result);
    ?>
    <header>
        <nav class="navbar fixed-top navbar-nav-scroll">
            <div class="header">
                <h1>ตอบกลับ Email ประชาชน</h1>
            </div>
        </nav>
    </header>

    <form id="contact-form" action="construct_send.php" method="POST" class="form-contact"enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= $_GET['user_id'] ?>">

        <fieldset>
            <legend>ข้อมูลผู้ใช้บริการ</legend>
            <div class="title page">
                <label for="fullname">ชื่อผู้ใช้บริการ</label><br>
                <input type="text" class="form-control" id="name" name="name" value="<?= $info['pre'] . $info['fullname'] ?>">
            </div>
            <div class="title page">
                <label for="fullname">E-mail ผู้แจ้ง</label><br>
                <input type="email" class="form-control" id="email" name="email" value="<?= $info['email'] ?>">
            </div>
            <label for="fullname">หัวข้อปัญหา</label><br>
            <input id="head" class="form-control" name="head" value="<?= $info['inform'] ?>">
            <br><label for="fullname">รายละเอียดปัญหา</label><br>
            <input id="details" class="form-control" name="details" value="<?= $info['details'] ?>">
            <br>
        </fieldset>
        <br>
        <fieldset>
            <legend>ตอบกลับจาก กองช่าง</legend>
            <div class="col-sm-6 py-2">
                <label for="poto" class="fg-grey">รูปภาพ</label><br>
                <input type="file" name="attachment" class="form-control"id="picture1">
            </div>
            <div class="col-sm-6 py-2">
                <label for="message" class="fg-grey">ข้อความจากพนักงานกองช่าง*</label><br>
                <textarea id="message" rows="6" cols="50" required class="form-control" name="message" laceholder="กรอกข้อความ"></textarea>
            </div>
        </fieldset><br>
        <div class="a"><a href="backoffice.php?page=construct">ย้อนกลับ</a>&nbsp;
        <input type="button" class="bott" id="btn-ok" value="ส่ง E-mail" ></div>
    </form>
    <script>
        
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
                preConfirm: () => {
        const text = document.querySelector('#message').value
        const picture = document.querySelector('#picture1').value
                        var extall = "jpg,jpeg,png,pdf,doc,docx";
                        ext = picture.split('.').pop().toLowerCase();{
                            if (parseInt(extall.indexOf(ext)) < 0) {
                                Swal.showValidationMessage(`รูปภาพ ไฟล์นามสกุลไม่ถูกต้อง`)
                            }
                        }
        if (!text) {
          Swal.showValidationMessage(`กรอกข้อมูลไม่ครบ กรุณาลองอีกครั้ง`)
        }
        return { message: message}
      }
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