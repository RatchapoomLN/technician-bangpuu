<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    <?php
    include('config.php');



    $sql = "SELECT * FROM model WHERE user_id='".$_GET['user_id']."' LIMIT 1";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);

    ?><input type="hidden" name="user_id" value="<?=$_GET['user_id']?>"><?php

    echo $row['status'];?></br><?php
    echo $row['user_id'];
    $test ="2";
    
    if($row['status']=="1"){
    $sql = "UPDATE model SET
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
$content = 
'เรียนผู้ใช้บริการ หมายเลข '.$row['user_id'].'
รหัสแบบ : '.$row['code'].'

ขณะนี้พนักงานกองช่างกำลังดำเนินการตรวจสอบเลขแบบอาคารของท่านจะทำการตอบกลับโดยเร็วที่สุด
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
                                title: 'ยืนยันการตรวจสอบแบบ',
                                text: 'ส่งเมล์ยืนยันไปยัง ผู้แจ้งแล้ว!',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'backoffice.php?page=model'
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
            window.location.href = 'backoffice.php?page=model'
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
            window.location.href = 'backoffice.php?page=model'
          }
        }); 
      });
      </script>";
}
    ?>