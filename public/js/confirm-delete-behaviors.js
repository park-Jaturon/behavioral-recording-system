document.addEventListener('click', (e) => {
    if (e.target.matches('.delete-behavior')) {
        console.log(e.target.dataset.behavior_id);
        Swal.fire({
            title: 'คุณแน่ใจน่ะว่าจะลบจริงๆ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช้ฉันต้องการลบ',
            cancelButtonText:'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete($url + '/teacher/behavior/delete/' + e.target.dataset.behavior_id).then((response) => {
                    Swal.fire(
                        'ลบแล้ว!',
                        'ข้อมูลของคุณถูกลบไปแล้ว',
                        'success'
                    );
                    setTimeout(() => {
                        window.location.href = $url + '/teacher/behavior';
                    }, 2000);
                });
            }
        });
    }
});