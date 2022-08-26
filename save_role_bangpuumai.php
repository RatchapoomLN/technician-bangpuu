<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    include('config.php');
        if ($_POST['page'] == 'bangpuumai') { 
        if ($_POST['pro_id']=='') {
            
            $sql ="INSERT INTO bangpuumai SET
            pre='".$_POST['pre']."',
            fullname='".$_POST['fullname']."',
            role='".$_POST['role']."',
            moo='".$_POST['moo']."',
            district='".$_POST['district']."',
            detail='".$_POST['detail']."' ";
        if (mysqli_query($link, $sql)) {
            
            $pro_id = mysqli_insert_id($link);
            if (move_uploaded_file($_FILES["picture"]["tmp_name"],
                "img/bangpuumai/".$_FILES["picture"]["name"])) {
            $sql = "UPDATE bangpuumai SET
                        picture='".$_FILES["picture"]["name"]."'
                        WHERE pro_id='".$pro_id."' LIMIT 1";
                mysqli_query($link, $sql) or die("Update Failed! -> ".mysqli_error($link));
                
                // header("location:backoffice.php?page=bangpuumai");
                }else{
                    echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อย!',
                                text: 'สำเร็จ',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'role.php?page=bangpuumai'
                                }
                              }); 
                            });
                            </script>";
                            exit();
                }echo "<script>
                $(document).ready(function(){
                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูลเรียบร้อย!',
                        text: 'สำเร็จ',
                        confirmButtonText:'OK'
                      }).then((result) => {
                        if (result.value) {
                          window.location.href = 'role.php?page=bangpuumai'
                        }
                      }); 
                    });
                    </script>"; 
            }
            else {
                echo "<script>
                $(document).ready(function(){
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดปัญหาขึ้น',
                        text: 'เกิดปัญหาขึ้นกับ Host',
                        confirmButtonText:'OK'
                      }).then((result) => {
                        if (result.value) {
                          window.location.href = 'role.php?page=bangpuumai'
                        }
                      }); 
                    });
                    </script>";
            }          
        }
        else {

            //edit
            $sql = "UPDATE bangpuumai SET
            pre='".$_POST['pre']."',
            fullname='".$_POST['fullname']."',
            role='".$_POST['role']."',
            moo='".$_POST['moo']."',
            district='".$_POST['district']."',
            detail='".$_POST['detail']."' 
            WHERE pro_id='".$_POST['pro_id']."' LIMIT 1";
        if (mysqli_query($link, $sql)) {
                        

        if (isset($_FILES)) {
         // Update Picture
        $sql = "SELECT picture FROM bangpuumai
                    WHERE pro_id='".$_POST['pro_id']."' LIMIT 1 ";
        $result = mysqli_query($link, $sql);
        $product_img = mysqli_fetch_assoc($result);
        if(empty($profile_img)){
                    @unlink("img/bangpuumai/".$profile_img['profile']);}
        if (move_uploaded_file($_FILES["picture"]["tmp_name"],
                "img/bangpuumai/".$_FILES["picture"]["name"])) {
                $sql = "UPDATE bangpuumai SET
                            picture='".$_FILES["picture"]["name"]."'
                            WHERE pro_id='".$_POST['pro_id']."' LIMIT 1";
                    mysqli_query($link, $sql) 
                    or die("Update Failed! -> ".mysqli_error($link));
            }else{
                echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อย!',
                                text: 'สำเร็จ',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'role.php?page=bangpuumai'
                                }
                              }); 
                            });
                            </script>";
            exit();
            }
            echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อย!',
                                text: 'สำเร็จ',
                                confirmButtonText:'OK'
                              }).then((result) => {
                                if (result.value) {
                                  window.location.href = 'role.php?page=bangpuumai'
                                }
                              }); 
                            });
                            </script>";
            // exit();
            // header("location:backoffice.php?page=taiban");
        } 
    }
    else {
        // print mysqli_error($link); 
        echo "<script>
        $(document).ready(function(){
            Swal.fire({
                icon: 'error',
                title: 'เกิดปัญหาขึ้น',
                text: 'เกิดปัญหาขึ้นกับ Host',
                confirmButtonText:'OK'
              }).then((result) => {
                if (result.value) {
                  window.location.href = 'role.php?page=bangpuumai'
                }
              }); 
            });
            </script>";
        }
    }
    }
?>