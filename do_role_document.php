<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include('config.php');



$sql = "SELECT * FROM problem WHERE user_id='" . $_GET['user_id'] . "' LIMIT 1";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);

?><input type="hidden" name="user_id" value="<?= $_GET['user_id'] ?>"><?php

                                                                      echo $row['status']; ?></br><?php
                            echo $row['user_id'];
                            $test = "2";

                            if ($row['status'] == "1") {
                              $sql = "UPDATE problem SET
status='" . $test . "'
WHERE user_id='" . $row['user_id'] . "' LIMIT 1";
                              mysqli_query($link, $sql) or die("Update Failed! -> " . mysqli_error($link));
                            } else {
                              echo "<script>
                                        $(document).ready(function(){
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'เกิดข้อผิดพลาด',
                                                text: 'กรุณากด รับเรื่อง ก่อนกด รับยื่นเรื่อง',
                                                confirmButtonText:'OK'
                                              }).then((result) => {
                                                if (result.value) {
                                                  window.location.href = 'role.php?page=problem'
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
                    title: 'รับยื่นเรื่อง!',
                    text: 'เปลี่ยนสถานะเรียบร้อยแล้ว!',
                    confirmButtonText:'OK'
                  }).then((result) => {
                    if (result.value) {
                      window.location.href = 'role.php?page=problem'
                    }
                  }); 
                });
                </script>";

                            ?>