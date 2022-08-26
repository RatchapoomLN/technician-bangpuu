<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    if(isset($_POST['email'])){
    $name = addslashes($_POST['name']);
    $email = addslashes($_POST['email']);
    $head = addslashes($_POST['head']);
    $msg = addslashes($_POST['detail']);
    $message = addslashes($_POST['message']);
    
// *** ผู้ส่ง(input) Email ***
$to = $email;
//
// *** หัวเรื่อง Email ***
$subject = "กองช่าง เทศบาลบางปู";
//
// *** ข้อความ Email ***
$content = "ผู้ใช้บริการ : ".$name.
"\r\nหัวเรื่อง : ".$head.
"\r\nรายละเอียดปัญหา : ".$msg.
"\r\nข้อความจากพนักงานกองช่าง : ".$message.
"\r\n
      ความคิดเห็นของท่านมีส่วนสำคัญอย่างมาก 
      ท่านสามารถให้คะแนนความพึงพอใจได้จากลิงก์ด้านล่าง 
      เพื่อการพัฒนางานบริการให้ดียิ่งขึ้นต่อไป 
      สามารถให้คะแนนความพึงพอใจที่นี่ 
      https://forms.gle/o8omD629Kf3UghWp9 " .

"\r\n
      หากมีปัญหาเพิ่มเติม กรุณาแจ้งปัญหาเข้ามาใหม่อีกครั้ง 
      โดยสามารถทำการแจ้งปัญหาได้ที่หน้าเว็บไซต์ 
      https://localhost/technician/main.php ตลอด 24 ชั่วโมง";
//*** Head Email ***
$headers = "From: Your-Email\r\n";
//
//*** Show the result... ***

include('config.php');

    $sql = "SELECT * FROM model WHERE user_id='".$_POST['user_id']."' LIMIT 1";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    $test ="3";
    
    if($row['status']=="2"){
    $sql = "UPDATE model SET
                status='".$test."'
            WHERE user_id='".$_POST['user_id']."' LIMIT 1";
            mysqli_query($link, $sql) or die("Update Failed! -> ".mysqli_error($link));
            }
            if($row['email'] != ''){
if (mail($to, $subject, $content, $headers))
{
	echo "<script>
    $(document).ready(function(){
        Swal.fire({
            icon: 'success',
            title: 'ทำการส่งเมล์ไปยังผู้แจ้งเรื่องแล้ว',
            text: 'สำเร็จ',
            confirmButtonText:'OK'
          }).then((result) => {
            if (result.value) {
              window.location.href = 'role.php?page=model'
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
              window.location.href = 'role.php?page=model'
            }
          }); 
        });
        </script>";
}
}}else{
  echo "<script>
  $(document).ready(function(){
      Swal.fire({
          icon: 'success',
          title: 'รับเรื่องแล้ว!',
          text: 'สถานะเปลี่ยนแปลง ไม่มีอีเมล ผู้แจ้ง',
          confirmButtonText:'OK'
        }).then((result) => {
          if (result.value) {
            window.location.href = 'role.php?page=model'
          }
        }); 
      });
      </script>";
}
?>
