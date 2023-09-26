document.querySelector('#tbAdmin').addEventListener('click', (e) => {
    if (e.target.matches('.delete-item')) {
        console.log(e.target.dataset.admin_id);
        var AdminId = e.target.dataset.admin_id;
        axios.post($url + '/admin/inspect/delete', {
            admin: AdminId,
          }).then(function (response) {
            Swal.fire({
              title: 'คุณแน่ใจน่ะว่าจะลบจริงๆ',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'ใช่ฉันต้องการลบ',
              cancelButtonText: 'ยกเลิก'
            }).then((result) => {
              if (result.isConfirmed) {
                axios.delete($url + '/admin/users/admin/delete/' + e.target.dataset.admin_id)
                  .then((response) => {
                    console.log(response);
                    if (response.data == 'true') {
                      Swal.fire(
                        'ลบแล้ว!',
                        'ข้อมูลของคุณถูกลบไปแล้ว',
                        'success'
                      );
                      window.location.href = $url + '/admin/users/admin';
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด',
                        text: 'ไม่สามารถลบIDที่กำลังใช้งานอยู่ได้'
                    })
                    window.location.href = $url + '/admin/users/admin';
                    }
                  });
              }
            });
          })
          .catch(function (error) {
            console.log(error);
          });
    }
});