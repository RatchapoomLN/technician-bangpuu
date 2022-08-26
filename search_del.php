<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
//connect database
include('config.php');
$user = $_GET['user_id'];
$address = $_GET['address'];
$phone = $_GET['phone'];
$searchsql = "SELECT * FROM problem WHERE phone LIKE '%$phone%' AND user_id LIKE '%$user%' AND address LIKE '%$address%' ORDER BY time DESC";
$searchsql1 = "SELECT * FROM construct WHERE phone LIKE '%$phone%' AND user_id LIKE '%$user%' AND address LIKE '%$address%' ORDER BY time DESC";
$searchsql2 = "SELECT * FROM model WHERE phone LIKE '%$phone%' AND user_id LIKE '%$user%' AND address LIKE '%$address%' ORDER BY time DESC";
$res = mysqli_query($link, $searchsql);
$res1 = mysqli_query($link, $searchsql1);
$res2 = mysqli_query($link, $searchsql2);
$count = mysqli_num_rows($res)+mysqli_num_rows($res1)+mysqli_num_rows($res2);

$problem = mysqli_num_rows($res);
$construct = mysqli_num_rows($res1);
$model = mysqli_num_rows($res2);
if($count = 1){
    if($problem != 0){
        $del = "problem";
    }
    else if( $construct != 0){
        $del = "construct";
    }
    else if ($model != 0){
        $del = "model";
    }
}else{
    echo "<script>
    $(document).ready(function(){
        Swal.fire({
            icon: 'error',
            title: 'เกิดปัญหาขึ้น',
            text: 'ข้อมูลซ้ำกัน กรุณาแจ้งเจ้าหน้าที่เพื่อยกเลิก หรือ รอเจ้าหน้าที่ตอบกลับ',
            confirmButtonText:'OK'
          }).then((result) => {
            if (result.value) {
              window.location.href = 'search.php'
            }
          }); 
        });
        </script>";
    exit();
}
$searchsql3 = "SELECT * FROM $del WHERE phone LIKE '%$phone%' AND user_id LIKE '%$user%' ORDER BY time DESC";
$res3 = mysqli_query($link, $searchsql3);
$row = mysqli_fetch_array($res3);
print_r($row);
if($row['status'] == "0" ){
    $sql = "DELETE FROM $del WHERE user_id='".$_GET['user_id']."' LIMIT 1";
    if (mysqli_query($link,$sql)) {
        echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'ยกเลิกข้อมูลเรียบร้อย!',
                                text: 'สำเร็จ',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'search.php'
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
                              window.location.href = 'search.php'
                            }
                          }); 
                        });
                        </script>";
    }
}else{
    echo "<script>
                    $(document).ready(function(){
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สามารถยกเลิกได้!',
                            text: 'เจ้าหน้าที่ได้ทำการรับเรื่องร้องขอไปแล้ว',
                            confirmButtonText:'OK'
                          }).then((result) => {
                            if (result.value) {
                              window.location.href = 'search.php'
                            }
                          }); 
                        });
                        </script>";
}



?>