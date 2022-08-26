<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
include('config.php'); 
    $sql ="SELECT profile FROM account WHERE user_id='".$_GET['user_id']."' LIMIT 1";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $profile_img = mysqli_fetch_assoc($result);
    @unlink("img/account/".$profile_img['profile']);

    $sql = "DELETE FROM account WHERE user_id='".$_GET['user_id']."'LIMIT 1";
    if (mysqli_query($link,$sql)) {
        echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบผู้ใช้เรียบร้อย',
                                text: 'ข้อมูลถูกลบแล้ว!',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'backoffice.php?page=user'
                                }
                              }); 
                            });
                            </script>";       
    }
    else {
        print "ลบผู้ใช้งานไม่สำเร็จ --> ".mysqli_error($link);
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
