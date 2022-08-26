<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$postData = $uploadedFile = $statusMsg = '';
$msgClass = 'errordiv';

include('config.php');

    $sql = "SELECT * FROM problem WHERE user_id='".$_POST['user_id']."' LIMIT 1";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    $test ="3";
    
    if($row['status']=="2"){
    $sql = "UPDATE problem SET
                status='".$test."'
            WHERE user_id='".$_POST['user_id']."' LIMIT 1";
            mysqli_query($link, $sql) or die("Update Failed! -> ".mysqli_error($link));
            }


if (isset($_POST['email'])) {
  // Get the submitted form data
  $postData = $_POST;
  $name = addslashes($_POST['name']);
  $email = addslashes($_POST['email']);
  $head = addslashes($_POST['head']);
  $msg = addslashes($_POST['details']);
  $message = addslashes($_POST['message']);

  // Check whether submitted data is not empty
  if (!empty($email)) {

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      echo "<script>
          $(document).ready(function(){
              Swal.fire({
                  icon: 'error',
                  title: 'เกิดปัญหาขึ้น',
                  text: 'อิเมล์ปลายทางไม่ถูกต้อง ไม่มีผู้รับอิเมล์!',
                  confirmButtonText:'OK'
                }).then((result) => {
                  if (result.value) {
                    window.location.href = 'backoffice.php?page=problem'
                  }
                }); 
              });
              </script>";
    } else {
      $uploadStatus = 1;
      
      // Upload attachment file
      if (!empty($_FILES["attachment"]["name"])) {

        // File path config
        $targetDir = "uploads/";
        $fileName = basename($_FILES["attachment"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          // Upload file to the server
          if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)) {
            $uploadedFile = $targetFilePath;
            
          } else {
            $uploadStatus = 0;
            echo "<script>
    $(document).ready(function(){
        Swal.fire({
            icon: 'error',
            title: 'เกิดปัญหาขึ้น',
            text: 'ใส่ไฟล์ได้เฉพาะ pdf,doc,docx,jpg,png,jpeg'
            confirmButtonText:'OK'
          }).then((result) => {
            if (result.value) {
              window.location.href = 'backoffice.php?page=problem'
            }
          }); 
        });
        </script>";
          }
        } else {
          $uploadStatus = 0;
          $statusMsg = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.';
        }
      }

      if ($uploadStatus == 1) {

        // Recipient
        $toEmail = $email;

        // Sender
        $from = 'bangputechnician@gmail.com';
        $fromName = 'กองช่าง เทศบาลบางปู';

        // Subject
        $emailSubject = "กองช่าง เทศบาลบางปู";

        // Message 
        $htmlContent = '<h4>ผู้ใช้บริการ : '.$name.'</h4>'.
          '<p>หัวเรื่อง : '.$head.'</p>'.
          '<p>รายละเอียดปัญหา : '.$msg.'</p>'.
          '<br>ข้อความจากพนักงานกองช่าง : '.$message.'</p>'.
          "
                <br>ความคิดเห็นของท่านมีส่วนสำคัญอย่างมาก 
                <br>ท่านสามารถให้คะแนนความพึงพอใจได้จากลิงก์ด้านล่าง 
                <br>เพื่อการพัฒนางานบริการให้ดียิ่งขึ้นต่อไป 
                <br>สามารถให้คะแนนความพึงพอใจที่นี่ 
                <br>https://forms.gle/o8omD629Kf3UghWp9 " .

          "<br>
                <br>หากมีปัญหาเพิ่มเติม กรุณาแจ้งปัญหาเข้ามาใหม่อีกครั้ง 
                <br>โดยสามารถทำการแจ้งปัญหาได้ที่หน้าเว็บไซต์<br> 
                https://localhost/technician/main.php ตลอด 24 ชั่วโมง";

        // Header for sender info
        $headers = "From: $fromName" . " <" . $from . ">";

        if (!empty($uploadedFile) && file_exists($uploadedFile)) {

          // Boundary 
          $semi_rand = md5(time());
          $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

          // Headers for attachment 
          $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

          // Multipart boundary 
          $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

          // Preparing attachment
          if (is_file($uploadedFile)) {
            $message .= "--{$mime_boundary}\n";
            $fp =    @fopen($uploadedFile, "rb");
            $data =  @fread($fp, filesize($uploadedFile));
            @fclose($fp);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: application/octet-stream; name=\"" . basename($uploadedFile) . "\"\n" .
              "Content-Description: " . basename($uploadedFile) . "\n" .
              "Content-Disposition: attachment;\n" . " filename=\"" . basename($uploadedFile) . "\"; size=" . filesize($uploadedFile) . ";\n" .
              "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
          }

          $message .= "--{$mime_boundary}--";
          $returnpath = "-f" . $email;

          // Send email
          $mail = mail($toEmail, $emailSubject, $message, $headers, $returnpath);
          
          // Delete attachment file from the server
          @unlink($uploadedFile);
        } else {
          // Set content-type header for sending HTML email
          $headers .= "\r\n" . "MIME-Version: 1.0";
          $headers .= "\r\n" . "Content-type:text/html;charset=UTF-8";
          // Send email
          $mail = mail($toEmail, $emailSubject, $htmlContent, $headers);
        }

        // If mail sent
        
        if ($mail) {
          echo "<script>
                  $(document).ready(function(){
                      Swal.fire({
                          icon: 'success',
                          title: 'ทำการส่งเมล์ไปยังผู้แจ้งเรื่องแล้ว',
                          text: 'สำเร็จ',
                          confirmButtonText:'OK'
                        }).then((result) => {
                          if (result.value) {
                            window.location.href = 'backoffice.php?page=problem'
                          }
                        }); 
                      });
                      </script>";
        } else {
          echo "<script>
                  $(document).ready(function(){
                      Swal.fire({
                          icon: 'error',
                          title: 'เกิดปัญหาขึ้น',
                          text: 'อิเมล์ไม่ถูกส่ง เพราะเกิดปัญหาขึ้นกับ Host',
                          confirmButtonText:'OK'
                        }).then((result) => {
                          if (result.value) {
                            window.location.href = 'backoffice.php?page=problem'
                          }
                        }); 
                      });
                      </script>";
        }
      }
    }
  } else {
    echo "<script>
                  $(document).ready(function(){
                      Swal.fire({
                          icon: 'success',
                          title: 'สำเร็จ',
                          text: 'เปลี่ยนแปลงสถานะ ไม่มีอีเมลผู้แจ้งตอบกลับ',
                          confirmButtonText:'OK'
                        }).then((result) => {
                          if (result.value) {
                            window.location.href = 'backoffice.php?page=problem'
                          }
                        }); 
                      });
                      </script>";
  }
}
?>