<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include('config.php');

    $sql = "UPDATE account SET
            WHERE user_id='".$_POST['user_id']."' LIMIT 1";
        
                     //update password
                    if($_POST['password1']!='') {
                        if ($_POST['password1'] != $_POST['password2']) {
                            echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'error',
                                title: 'รหัสไม่ตรงกัน!',
                                text: 'กรุณาตรวจสอบรหัสใหม่อีกครั้ง',
                                confirmButtonText: 'กลับหน้าหลัก',
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'role.php?page=user'
                                }
                              });
                            });
                            </script>";
                            exit();
                        }
                        else {
                            $sql = "UPDATE account SET
                                        password='".$_POST['password1']."'
                                        WHERE user_id='".$_POST['user_id']."' LIMIT 1";
                        if (mysqli_query($link,$sql)) {
                            echo "<script>
                            $(document).ready(function(){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'บันทึกข้อมูลเรียบร้อย!',
                                    text: 'สำเร็จ',
                                    confirmButtonText:'OK'
                                  }).then((result) => {
                                    if (result.value) {
                                      window.location.href = 'role.php?page=user'
                                    }
                                  }); 
                                });
                                </script>";
                                exit();
                        }
                        else {
                            echo "<script>
                      $(document).ready(function(){
                          Swal.fire({
                              icon: 'error',
                              title: 'Update รหัสผ่านไม่ได้!',
                              text: 'กรุณาลองใหม่อีกครั้ง',
                              confirmButtonText: 'กลับหน้าหลัก',
                            }).then((result) => {
                              if (result.value) {
                                window.location.href = 'role.php?page=user'
                              }
                            });
                          });
                          </script>";
                        exit();
                        }
                    }                                  
                    }
                    
                    else {
                        // header("location:backoffice.php?page=user");
                        echo "<script>
                      $(document).ready(function(){
                          Swal.fire({
                              icon: 'error',
                              title: 'Update รหัสผ่านไม่ได้!',
                              text: 'กรุณาลองใหม่อีกครั้ง',
                              confirmButtonText: 'กลับหน้าหลัก',
                            }).then((result) => {
                              if (result.value) {
                                window.location.href = 'role.php?page=user'
                              }
                            });
                          });
                          </script>";
                        // header("location:backoffice.php?page=user");

                    }
 
    ?>
