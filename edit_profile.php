<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styleshhet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/edit_pro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Edit Profile</title>

</head>

<body>
    <?php
    include('config.php');
    $sql = "SELECT * FROM account WHERE user_id='" . $_GET['user_id'] . "' LIMIT 1";
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
                <h3>แก้ไขข้อมูลสมาชิก</h3>
            </div>
        </nav>
    </header>
    <!-- onsubmit="return submitForm(this);" -->
    <form action="do_edit_profile.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= $_GET['user_id'] ?>">
        <fieldset>
            <legend>ข้อมูลส่วนบุคคล</legend>
            <div class="form-group">
                <label for="pre">คำนำหน้า</label>
                <select name="pre" id="pre">
                    <option value="นาย" <?php
                                        if ($info['pre'] == 'นาย')
                                            print 'selected';
                                        ?>>นาย</option>

                    <option value="นาง" <?php
                                        if ($info['pre'] == 'นาง')
                                            print 'selected';
                                        ?>>นาง</option>

                    <option value="นางสาว" <?= ($info['pre'] == 'นางสาว') ? 'selected' : ''
                                            ?>>นางสาว</option> ;
                </select>
            </div>

            <div class="form-group">
                <label for="fullname">ชื่อ-นามสกุล</label>
                <input type="text" name="fullname" id="fullname" required value="<?= $info['fullname'] ?>">
            </div>
            <div class="form-group">
                <label for="work">ตำแหน่ง</label>
                <input type="text" name="work" id="work" required value="<?= $info['work'] ?>">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="admin" <?php

                                            if ($info['role'] == 'admin')
                                                print 'selected';
                                            ?>>admin</option>

                    <option value="employee" <?= ($info['role'] == 'employee') ? 'selected' : ''
                                                ?>>employee</option> ;
                </select>

            </div>
            <div class="form-group">
                <?php
                $info['profile'] != ''
                ?>

                อัพโหลดรูปโปรไฟล์ *ใหม่*
                <input type="file" name="profile" id="profile">
            </div>
        </fieldset>
        <fieldset>
            <legend>ข้อมูลบัญชี</legend>
            <div class="form-group">
                <label for="username">Username : </label><?= $info['username'] ?> || รหัสผ่าน ไม่ต่ำกว่า 6 ตัว
            </div>
            <div class="form-group">
                <label for="password1">พิมพ์รหัสผ่านใหม่ </label><br>
                <input type="password" name="password1" id="password1">
            </div>
            <div class="form-group">
                <label for="password2">พิมพ์รหัสผ่านใหม่อีกครั้ง</label><br>
                <input type="password" name="password2" id="password2">
            </div>
        </fieldset>
        <div class="a"><a href="backoffice.php?page=user">ย้อนกลับ</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="but" id="btn-ok" value="บันทึกข้อมูล">
        </div>
    </form>
    <script>
        // function submitForm(form) {
        //     swal({
        //         title: "Are you sure?",
        //         text: "This form will be submitted",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then(function (isOkay) {
        //         if (isOkay) {
        //             form.submit();
        //         }
        //     });
        //     return false;
        // }
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
                        const pass = document.querySelector('#password1').value
                        const pass2 = document.querySelector('#password2').value
                        const passcount = pass.length;
                        const picture = document.querySelector('#profile').value
                        var extall = "jpg,jpeg,png";
                        ext = picture.split('.').pop().toLowerCase(); {
                            if (parseInt(extall.indexOf(ext)) < 0) {
                                Swal.showValidationMessage(`รูปภาพ ไฟล์นามสกุลไม่ถูกต้อง(jpg,jpeg,png)`)
                            }
                        }
                        if (pass) {
                            if (pass != pass2) {
                                Swal.showValidationMessage(`รหัสไม่ตรงกันกับ ยืนยันรหัสผ่าน โปรดลองใหม่`)
                            } else {
                                if (passcount < 6) {
                                    Swal.showValidationMessage(`รหัสสั้นเกินไป กรุณาลองอีกครั้ง`)
                                }
                            }
                            return {
                                password1: password1,
                                password2: password2
                            }
                        }
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