$(document).ready(function () {

    /* When click show user */
    $('body').on('click', '#show-event', function () {
        var userURL = $(this).data('url');
        console.log(userURL);
        $.get(userURL, function (data) {
            $('#userShowModal').modal('show');
            $('#event-id').val(data.events_id);
            $('#user-name').text(data.title);
        })
    });

    // $('body').on('click', '#submit', function (event) {
    //     event.preventDefault()
    //     var id = $("#color_id").val();
    //     var name = $("#name").val();
       
    //     $.ajax({
    //       url: 'color/' + id,
    //       type: "POST",
    //       data: {
    //         id: id,
    //         name: name,
    //       },
    //       dataType: 'json',
    //       success: function (data) {
              
    //           $('#companydata').trigger("reset");
    //           $('#practice_modal').modal('hide');
    //           window.location.reload(true);
    //       }
    //   });
    // });
});