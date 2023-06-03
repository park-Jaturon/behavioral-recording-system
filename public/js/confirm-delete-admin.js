document.querySelector('#tbAdmin').addEventListener('click', (e) => {
    if (e.target.matches('.delete-item')) {
        console.log(e.target.dataset.admin_id);
        var AdminId = e.target.dataset.admin_id;
        axios.post($url + '/admin/inspect/delete', {
            admin: AdminId,
      
          }).then(function (response) {
            if (response.data == 1) {
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
                      Swal.fire(
                        'ลบแล้ว!',
                        'ข้อมูลของคุณถูกลบไปแล้ว',
                        'success'
                      );
                      setTimeout(() => {
                        window.location.href = $url + '/admin/users/admin';
                      }, 2000);
                    });
                }
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'ผิดพลาด',
                text: 'ไม่สามารถลบได้',
                // footer: '<a href="">Why do I have this issue?</a>'
              })
            }
          })
          .catch(function (error) {
            console.log(error);
          });
    }
});