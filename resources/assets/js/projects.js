$('#delete-btn').click( function() {
  var projectId = $(this).attr('data-id')

  swal({
    title: 'Attention!',
    text: 'Delete selected project?',
    type: 'warning',
    confirmButtonText: 'Delete',
    confirmButtonClass: 'btn-danger',
    showLoaderOnConfirm: true,
    closeOnConfirm: false,
    showCancelButton: true,
    cancelButtonText: 'Cancel'
  }, function (isConfirm) {
    if (isConfirm) deleteProject(projectId)
  })
})

var deleteProject = function (projectId) {
  $.ajax({
    url: 'projects/' + projectId,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'DELETE',
    data: {
      project_id: projectId
    }
  })
  .done(function (data) {
    location.reload()
  })
  .fail(function (err) {
    swal('Error!', err.responseText, 'error')
  })
}

$('#create-project-btn').click(function () {
    $('#data-form').ajaxSubmit({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      type: 'POST',
      complete: function () {
      },
      success: function (data) {
        if (data.status === 'success') {
          location.reload()
        }
      },
      error: function (err) {
        swal('Error!', err.statusText, 'error')
      }
    })
})
