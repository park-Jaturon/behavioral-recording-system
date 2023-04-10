document.querySelector('#tbRoom').addEventListener('click', (e) => {
    if (e.target.matches('.delete-item')) {
        console.log(e.target.dataset.rooms_id);
        Swal.fire({
            title: 'คุณแน่ใจน่ะว่าจะลบจริงๆ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช้ฉันต้องการลบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete($url + '/admin/room/delete/' + e.target.dataset.rooms_id)
                .then((response) => {
                    Swal.fire(
                        'ลบแล้ว!',
                        'ข้อมูลของคุณถูกลบไปแล้ว',
                        'success'
                    );
                    setTimeout(() => {
                        window.location.href = $url + '/admin/room';
                    }, 2000);
                })
                    .catch(error => {

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: '<a href="">Why do I have this issue?</a>'
                        })
                    });
            }
        });
    }
});