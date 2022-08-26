<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<?php
    include('config.php');



    $sql = "SELECT * FROM construct WHERE user_id='".$_GET['user_id']."' LIMIT 1";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);

    ?><input type="hidden" name="user_id" value="<?=$_GET['user_id']?>"><?php

    echo $row['status'];?></br><?php
    echo $row['user_id'];
    $test ="1";
    
    if($row['status']=="0"){
    $sql = "UPDATE construct SET
                status='".$test."'
            WHERE user_id='".$row['user_id']."' LIMIT 1";
            mysqli_query($link, $sql) or die("Update Failed! -> ".mysqli_error($link));
            }
            //
// *** To Email ***
$to = $row['email'];
//
// *** Subject Email ***
$subject = 'กองช่าง เทศบาลบางปู';
//
// *** Content Email ***
'เรียนผู้ใช้บริการ หมายเลข '.$row['user_id'].'
  คุณ '.$row['fullname'].'
  วันแจ้งเรื่อง : '.$row['time'].'
  หัวเรื่อง : '.$row['head'].'
  รายละเอียด : '.$row['details'].'
  จุดก่อสร้าง-รื้อถอน : '.$row['address'].'

ขณะนี้พนักงานกองช่างได้รับเรื่องของท่านแล้ว ทางพนักงานกองช่างจะดำเนินการแก้ไข-จัดการโดยเร็วที่สุด
ขอขอบคุณที่ใช้บริการ ผ่านหน้าเว็บไซต์เทศบาลบางปู กองช่าง';

//
//*** Head Email ***
$headers = "From: Your-Email\r\n";
//
//*** Show the result... ***
if($row['email'] != ''){
if (mail($to, $subject, $content, $headers))
{
	echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'รับเรื่องแล้ว!',
                                text: 'ส่งเมล์ยืนยันรับเรื่องไปยัง ผู้แจ้งแล้ว!',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'role.php?page=construct'
                                }
                              }); 
                            });
                            </script>";
} 
else 
{
    echo "<script>
    $(document).ready(function(){
        Swal.fire({
            icon: 'error',
            title: 'เกิดปัญหาขึ้น',
            text: 'อิเมล์ไม่ถูกส่ง เพราะเกิดปัญหาขึ้นกับ Host',
            confirmButtonText:'OK'
          }).then((result) => {
            if (result.value) {
              window.location.href = 'role.php?page=construct'
            }
          }); 
        });
        </script>";
}}
else{
  echo "<script>
  $(document).ready(function(){
      Swal.fire({
          icon: 'success',
          title: 'รับเรื่องแล้ว!',
          text: 'สถานะเปลี่ยนแปลง ไม่มีอีเมล ผู้แจ้ง',
          confirmButtonText:'OK'
        }).then((result) => {
          if (result.value) {
            window.location.href = 'role.php?page=construct'
          }
        }); 
      });
      </script>";
}

    ?>
