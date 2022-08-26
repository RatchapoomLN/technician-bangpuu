<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
include('config.php');

$sql = "UPDATE account SET
                pre='" . $_POST['pre'] . "',
                work='" . $_POST['work'] . "',
                fullname='" . $_POST['fullname'] . "',
                role='" . $_POST['role'] . "'
                
            WHERE user_id='" . $_POST['user_id'] . "' LIMIT 1";
if (mysqli_query($link, $sql)) {
    // Update Success
    // Update Profile
    if (isset($_FILES)) {
        $sql = "SELECT profile FROM account
                WHERE user_id='" . $_POST['user_id'] . "' LIMIT 1 ";
        $result = mysqli_query($link, $sql);
        $profile_img = mysqli_fetch_assoc($result);
        if (empty($profile_img)) {
            @unlink("img/account/" . $profile_img['profile']);
        }
        if (move_uploaded_file(
            $_FILES["profile"]["tmp_name"],
            "img/account/" . $_FILES["profile"]["name"]
        )) {
            $sql = "UPDATE account SET
                            profile='" . $_FILES["profile"]["name"] . "'
                            WHERE user_id='" . $_POST['user_id'] . "' LIMIT 1";
            mysqli_query($link, $sql) or die("Update Failed! -> " . mysqli_error($link));
            //update password
            
        }
        if ($_POST['password1'] != '') {
                if ($_POST['password1'] != $_POST['password2']) {
                    // print "<h2>ผิดพลาด! รหัสผ่านไม่ตรงกัน ไม่สามารถแก้ไขรหัสผ่านได้</h2>";
                    echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'error',
                                title: 'รหัสไม่ตรงกัน!',
                                text: 'กรุณาตรวจสอบรหัสใหม่อีกครั้ง',
                                confirmButtonText: 'กลับหน้าหลัก',
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'backoffice.php?page=user'
                                }
                              });
                            });
                            </script>";
                            exit();
                } else {
                    $sql = "UPDATE account SET
                                        password='" . $_POST['password1'] . "'
                                        WHERE user_id='" . $_POST['user_id'] . "' LIMIT 1";
                    if (mysqli_query($link, $sql)) {
                      echo "<script>
                                    $(document).ready(function(){
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'บันทึกข้อมูลเรียบร้อย!',
                                            text: 'สำเร็จ',
                                            confirmButtonText:'OK'
                                          }).then((result) => {
                                            if (result.value) {
                                              window.location.href = 'backoffice.php?page=user'
                                            }
                                          }); 
                                        });
                                        </script>";
                                        exit();
                    } else {
                      echo "<script>
                      $(document).ready(function(){
                          Swal.fire({
                              icon: 'error',
                              title: 'Update รหัสผ่านไม่ได้!',
                              text: 'กรุณาลองใหม่อีกครั้ง',
                              confirmButtonText: 'กลับหน้าหลัก',
                            }).then((result) => {
                              if (result.value) {
                                window.location.href = 'backoffice.php?page=user'
                              }
                            });
                          });
                          </script>";
                        exit();
                    }
                }
            }
    }echo "<script>
    $(document).ready(function(){
        Swal.fire({
            icon: 'success',
            title: 'บันทึกข้อมูลเรียบร้อย!',
            text: 'สำเร็จ',
            confirmButtonText:'OK'
          }).then((result) => {
            if (result.value) {
              window.location.href = 'backoffice.php?page=user'
            }
          }); 
        });
        </script>";
    // header("location:backoffice.php?page=user");
} else {
    print "UPDATE Failed!!! --> " . mysqli_error($link);
    echo "<script>
                    $(document).ready(function(){
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดปัญหาขึ้น',
                            text: 'เกิดปัญหาขึ้นกับ Host โปรดลองใหม่อีกครั้ง',
                            confirmButtonText:'OK'
                          }).then((result) => {
                            if (result.value) {
                              window.location.href = 'backoffice.php?page=user'
                            }
                          }); 
                        });
                        </script>";
}
?>