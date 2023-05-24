
document.querySelector('#tbStudent').addEventListener('click', (e) => {
        if (e.target.matches('.delete-item')) {
            console.log(e.target.dataset.student_id);
            Swal.fire({
                title: 'คุณแน่ใจน่ะว่าจะลบจริงๆ',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ฉันต้องการลบ',
                cancelButtonText:'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete($url + '/admin/student/delete/' + e.target.dataset.student_id).then((response) => {
                        Swal.fire(
                            'ลบแล้ว!',
                            'ข้อมูลของคุณถูกลบไปแล้ว',
                            'success'
                        );
                        setTimeout(() => {
                            window.location.href = $url + '/admin/manage/student';
                        }, 2000);
                    });
                }
            });
        }
    });