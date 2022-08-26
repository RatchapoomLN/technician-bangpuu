<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
/*print '<pre>';
    print_r($_POST);
    print_r($_FILES);
    print '</pre>';*/

if ($_POST['password1'] != $_POST['password2']) {
  echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'error',
                                title: 'รหัสผ่านไม่ตรงกัน',
                                text: 'รหัสผ่าน และ รหัสผ่านอีกครั้งไม่เหมือนกัน',
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

  include('config.php');
  $sql = "SELECT * FROM account WHERE username='" . $_POST['username'] . "' LIMIT 1";
  $result = mysqli_query($link, $sql) or die(mysqli_error($link));
  if (mysqli_num_rows($result) != 0) {
    echo "<script>
      $(document).ready(function(){
          Swal.fire({
              icon: 'error',
              title: 'ชื่อ User นี้มีอยู่แล้ว',
              text: 'กรุณาตั้งชื่อ User ที่ไม่ซ้ำกับในระบบ',
              confirmButtonText:'OK'
            }).then((result) => {
              if (result.value) {
                window.location.href = 'backoffice.php?page=user'
              }
            }); 
          });
          </script>";
    exit;
  } else {
    include('config.php');
    $sql = "INSERT INTO account SET
                pre='" . $_POST['pre'] . "',
                work='" . $_POST['work'] . "',
                fullname='" . $_POST['fullname'] . "',
                role='" . $_POST['role'] . "',
                username='" . $_POST['username'] . "',
                password='" . $_POST['password1'] . "'";
    if (mysqli_query($link, $sql)) {
      //query success
      $user_id = mysqli_insert_id($link);
      if (move_uploaded_file(
        $_FILES["profile"]["tmp_name"],
        "img/account/" . $_FILES["profile"]["name"]
      )) {
        $sql = "UPDATE account SET
                        profile='" . $_FILES["profile"]["name"] . "'
                        WHERE user_id='" . $user_id . "' LIMIT 1";
        mysqli_query($link, $sql) or die("Update Failed! -> " . mysqli_error($link));

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
      }
    } else {
      print mysqli_error($link);
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
  }
}

?>