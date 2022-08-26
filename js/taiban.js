<script>
        //ท้ายบ้าน
        $(".delete-btn1").click(function(e) {
            var userId = $(this).data('id');
            e.preventDefault();
            deleteConfirm(userId);
        })

        function deleteConfirm(userId) {
            Swal.fire({
                title: 'ลบผู้รับผิดชอบนี้ ?',
                text: 'จะถูกลบออกจากระบบ',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'backoffice.php?page=taiban',
                                type: 'GET',
                                data: 'delete1=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'ลบบัญชี้สำเร็จ',
                                    text: 'ข้อมูลถูกลบแล้ว!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'backoffice.php?page=taiban';
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'มันมีปัญหาบางอย่างเกิดขึ้น โปรดลองอีกครั้ง', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script>