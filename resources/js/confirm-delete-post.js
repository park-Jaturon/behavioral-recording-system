document.addEventListener('click', (e) => {
    if (e.target.matches('.delete-item')) {
        console.log(e.target.dataset.posts_id);
        Swal.fire({
            title: 'Are you sure delete?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete($url + '/teacher/post/delete/' + e.target.dataset.posts_id).then((response) => {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    setTimeout(() => {
                        window.location.href = $url + '/teacher/post/index';
                    }, 2000);
                });
            }
        });
    }
});