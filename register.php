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
    <title>หน้าสมัครสมาชิก</title>
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-nav-scroll">
            <div class="header">
                <h3>เพิ่มพนักงาน</h3>
            </div>
        </nav>
    </header>

    <form action="do_register.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>ข้อมูลส่วนบุคคล</legend>
            <div class="form-group">
                <label for="pre">คำนำหน้า</label>
                <select name="pre" id="pre">
                    <option value="นาย">นาย</option>
                    <option value="นาง">นาง</option>
                    <option value="นางสาว">นางสาว</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fullname">ชื่อ-นามสกุล*</label>
                <input type="text" name="fullname" id="fullname" required>
            </div>
            <div class="form-group">
                <label for="work">ตำแหน่งงาน</label>
                <input type="text" name="work" id="work" required>
            </div>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role">
                    <option value="admin">admin</option>
                    <option value="employee">employee</option>
                </select>
            </div>
            </div>
            <div class="form-group">
                <label for="profile">อัพโหลด รูปโปรไฟล์</label>
                <input type="file" name="profile" id="profile">
            </div>
        </fieldset>
        <br>
        <fieldset>
            <legend>ข้อมูลบัญชี</legend>
            <div class="form-group">
                <label for="username">Username*</label> || รหัสผ่าน ไม่ต่ำกว่า 6 ตัว<br>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password1">รหัสผ่าน*</label><br>
                <input type="password" name="password1" id="password1">
            </div>
            <div class="form-group">
                <label for="password2">พิมพ์รหัสผ่านใหม่อีกครั้ง*</label><br>
                <input type="password" name="password2" id="password2">
            </div>
        </fieldset>
        <div class="a"><a href="backoffice.php?page=user">ย้อนกลับ</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="but" id="btn-ok" value="บันทึกข้อมูล">
        </div>

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
                        const fullname = document.querySelector('#fullname').value
                        const user = document.querySelector('#username').value
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
                        if (pass != pass2) {
                            Swal.showValidationMessage(`รหัสไม่ตรงกันกับ ยืนยันรหัสผ่าน โปรดลองใหม่`)
                        } else {
                            if (passcount < 6) {
                                Swal.showValidationMessage(`รหัสสั้นเกินไป กรุณาลองอีกครั้ง`)
                            } else {
                                if (!user || !fullname || !pass || !pass2) {
                                    Swal.showValidationMessage(`กรอกข้อมูลไม่ครบ กรุณาลองอีกครั้ง`)
                                }
                            }
                        }


                        return {
                            fullname: fullname,
                            username: username,
                            password1: password1,
                            password2: password2
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