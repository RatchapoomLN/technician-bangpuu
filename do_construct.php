<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include('config.php');
$sql = "INSERT INTO construct SET
    inform='" . $_POST['inform'] . "',
    pre='" . $_POST['pre'] . "',
    fullname='" . $_POST['fullname'] . "',
    address='" . $_POST['address'] . "',
    details='" . $_POST['details'] . "',
    phone='" . $_POST['phone'] . "',
    head='" . $_POST['head'] . "',
    email='" . $_POST['email'] . "'";
if (mysqli_query($link, $sql)) {
    $user_id = mysqli_insert_id($link);
    if (move_uploaded_file(
        $_FILES["picture1"]["tmp_name"],
        "img/construct/" . $_FILES["picture1"]["name"]
    )) {
        $sql = "UPDATE construct SET
                    picture1='" . $_FILES["picture1"]["name"] . "'
                    WHERE user_id='" . $user_id . "' LIMIT 1";
        mysqli_query($link, $sql) or die("Update Failed! -> " . mysqli_error($link));
    }
    if (move_uploaded_file(
        $_FILES["picture2"]["tmp_name"],
        "img/construct/" . $_FILES["picture2"]["name"]
    )) {
        $sql = "UPDATE construct SET
                    picture2='" . $_FILES["picture2"]["name"] . "'
                    WHERE user_id='" . $user_id . "' LIMIT 1";
        mysqli_query($link, $sql) or die("Update Failed! -> " . mysqli_error($link));
    }
    if (move_uploaded_file(
        $_FILES["video"]["tmp_name"],
        "img/construct/video/" . $_FILES["video"]["name"]
    )) {
        $sql = "UPDATE construct SET
                    video='" . $_FILES["video"]["name"] . "'
                    WHERE user_id='" . $user_id . "' LIMIT 1";
        mysqli_query($link, $sql) or die("Update Failed! -> " . mysqli_error($link));
    }
    echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อย!',
                                text: 'รอการตอบกลับจากเจ้าหน้าที่ผ่าน E-mail',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'construct.php'
                                }
                              }); 
                            });
                            </script>";
} else {
    echo "<script>
                    $(document).ready(function(){
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดปัญหาขึ้น',
                            text: 'เกิดปัญหาขึ้นกับ Host โปรดลองใหม่อีกครั้ง',
                            confirmButtonText:'OK'
                          }).then((result) => {
                            if (result.value) {
                              window.location.href = 'construct.php'
                            }
                          }); 
                        });
                        </script>";
}
?>