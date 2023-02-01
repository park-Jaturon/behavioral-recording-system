document.querySelector('#tbParent').addEventListener('click', (e) => {
    if (e.target.matches('.delete-item')) {
        console.log(e.target.dataset.parents_id);
        Swal.fire({
            title: 'Are you sure delete?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete($url + '/admin/parent/delete/' + e.target.dataset.parents_id).then((response) => {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    setTimeout(() => {
                        window.location.href = $url + '/admin/manage/parents';
                    }, 2000);
                });
            }
        });
    }
});