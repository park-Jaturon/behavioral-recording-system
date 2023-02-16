ClassicEditor
    .create(document.querySelector('#editor'), {
        ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            // uploadUrl: $url + '/teacher/post/ckeditor/upload'+ '?_token'+"{{csrf_token()}}"
            uploadUrl: "{{route('ckedditor.upload').'?_token='.csrf_token}}"
        }

        // cloudServices: {
        //     tokenUrl: $('meta[name="csrf-token"]').attr('content'),
        //     uploadUrl: $url + '/teacher/post/ckeditor/upload'
        // }
    })
    .catch(error => {
        console.error(error);
    });