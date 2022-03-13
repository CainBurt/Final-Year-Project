$(document).ready(function(){
  $('#taskModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var list = button.data('list') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Add a Task to ' + list + ' list?')
    modal.find('.modal-body input.list-name').val(list)
  })
});
