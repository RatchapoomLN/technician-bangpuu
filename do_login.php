<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    session_start();

    include('config.php'); 

    $sql = "SELECT * FROM account
                WHERE username='".$_POST['user']."'
                    AND password='".$_POST['password']."'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    if (mysqli_num_rows($result) == 0) {
        //not found
        echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                text: 'กรุณาตรวจสอบรหัสและ Userใหม่อีกครั้ง',
                                confirmButtonText: 'OK',
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'login.php'
                                }
                              });
                            });
                            </script>";
    }
    else {
        //found
        $row = mysqli_fetch_assoc($result);
        $_SESSION['authen'] = true;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['pre'] = $row['pre'];
        $_SESSION['work'] = $row['work'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['profile_img'] = $row['profile'];
        if ($row['role']=='admin')
        header("location:firstoffice.php");
        elseif ($row['role']=='employee')
        header("location:office_role.php");
    }
?>