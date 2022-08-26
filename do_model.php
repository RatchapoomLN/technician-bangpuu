<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include('config.php');
$sql = "INSERT INTO model SET
    pre='" . $_POST['pre'] . "',
    fullname='" . $_POST['fullname'] . "',
    address='" . $_POST['address'] . "',
    code='" . $_POST['code'] . "',
    detail='" . $_POST['detail'] . "',
    phone='" . $_POST['phone'] . "',
    email='" . $_POST['email'] . "'";
if (mysqli_query($link, $sql)) {
    echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อย!',
                                text: 'รอการตอบกลับจากเจ้าหน้าที่ผ่าน E-mail',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'model.php'
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
                              window.location.href = 'model.php'
                            }
                          }); 
                        });
                        </script>";
}
?>