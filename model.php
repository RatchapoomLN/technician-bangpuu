<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="styleshhet" href="plugin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap-grid.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>สอบถามแบบก่อสร้าง</title>
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
                        <a href="model.php?page=model" class=" text-succes fw-bold">สอบถามแบบก่อสร้าง</a>
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
                    <button class="dropbtn" onclick="location.href='search.php';">ค้นหาข้อมูลที่แจ้ง <i class='bx bx-search' style='font-size:24px'></i></button>
                </div>
            </div>
        </nav>
    </header>

    <?php
    include('config.php');

    if (!isset($_GET['page']))
        $_GET['page'] = 'model';
    if ($_GET['page'] == 'model') {
        $sql = "SELECT * FROM model ";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>

        <h3 class="p-3 ">สอบถามแบบก่อสร้าง</h3>
        <form action="do_model.php" method="post" enctype="multipart/form-data">
        <div class=" container-fluid">
            <div class="row">
                <div class="col-3">
                    <h4>ข้อมูล</h4>
                    <div class="form-group">
                        <label for="code">เลขที่แบบ*</label><br>
                        <input type="text" name="code" id="code" required>
                    </div>
                    <div class="form-group">
                        <label for="detail">รายละเอียด*</label><br>
                        <textarea type="text" name="detail" id="detail" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">ที่อยู่*</label><br>
                        <textarea type="text" name="address" id="address" required></textarea>
                    </div>
                </div>
                <div class="col-3">
                    <div class="p-3"></div>
                    <div class="form-group">
                        <label for="pre">คำนำหน้า</label><br>
                        <select name="pre" id="pre">
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fullname">ชื่อ-นามสกุล*</label><br>
                        <input type="text" name="fullname" id="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">เบอร์ที่ติดต่อได้*</label><br>
                        <input type="text" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">อีเมลที่ติดต่อได้ || ติดต่อกลับอัตโนมัติ</label><br>
                        <input type="email" required id="email" name="email">
                    </div><br><br>
                    <div class="butt">
                        <input type="button" class="but" id="btn-ok" value="ส่งข้อมูล">
                    </div>
                </div>
                <div class="col">
                    <div class="p-3"></div>
                    <h5>เบื้องต้น</h5>
                    <p class="hed">
                        - หากได้รับหมายเลข จากการยื่นแบบเอกสารกับ เทศบาลบางปูกองช่างแล้ว ให้นำใส่ในช่อง "เลขที่แบบ"<br>
                        - ที่อยู่ ให้ใส่เป็นที่อยู่ตามแบบ<br>
                        - แนะนำใส่อีเมล ที่มีเพื่อการ ตอบกลับอย่างรวดเร็ว ( อาจจะล่าช้าในส่วนอื่นนอกเหนือจากส่วนนี้ )</p>
                </div>
            </div></div>
        <?php
    }
        ?>
        </form>
        <br><br><br><br>
        <footer class="p-2 p-lg-3">
            <div class="foot">
                <h4>สำนักงานเทศบาลตำบลบางปู (กองช่าง)</h4>
                <p></p>&nbsp;&nbsp;<i class='fas fa-coffee' style='font-size:18px;color:brown'></i> เลขที่ 789 หมู่ 1 ต.บางปูใหม่ อ.เมืองฯ จ.สมุทรปราการ 10280
                <br>&nbsp;&nbsp;<i class='fas fa-mobile-alt' style='font-size:18px;color:cornflowerblue'></i> โทรศัพท์ : 0-2174-3399 <i class="fa fa-phone" style="font-size:18px;color:red"></i> โทรสาร : 02-323-9473
                <br>&nbsp;&nbsp;<span class="iconify" data-icon="logos:google-gmail"></span> email : bangpoocity@hotmail.com

            </div>
        </footer>
        <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
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
                            const address = document.querySelector('#address').value
                            const code = document.querySelector('#code').value
                            const detail = document.querySelector('#detail').value
                            const email = document.querySelector('#email').value
                            if (!address || !fullname || !detail || !email || !code) {
                                Swal.showValidationMessage(`กรอกข้อมูลไม่ครบ กรุณาลองอีกครั้ง`)
                            }
                            return {
                                fullname: fullname,
                                address: address,
                                detail: detail,
                                email: email,
                                code: code
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