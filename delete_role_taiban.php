<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
//connect database
include('config.php');

if ($_GET['page']=='taiban') { //delete category
    $sql = "DELETE FROM taiban
                WHERE pro_id='".$_GET['pro_id']."' LIMIT 1";
    if (mysqli_query($link,$sql)) {
        echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อย!',
                                text: 'สำเร็จ',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'role.php?page=taiban'
                                }
                              }); 
                            });
                            </script>";
    }
    else {
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
                              window.location.href = 'role.php?page=taiban'
                            }
                          }); 
                        });
                        </script>";
    }
    }
?>

