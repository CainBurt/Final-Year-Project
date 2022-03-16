

$(document).ready(function () {

  //shows the create task modal and puts data into the inputs
  $("#taskModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var list = button.data("list"); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find(".modal-title").text("Add a Task to " + list + " list?");
    modal.find(".modal-body input.list-name").val(list);
  });

  //shows the edit task modal and puts data into the inputs
  $("#editModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var taskId = button.data("task")
    var title = button.data("title")
    var modal = $(this);
    modal.find(".modal-title").text("Edit Task");
    modal.find(".modal-body input.task-id").val(taskId);
    modal.find(".modal-body input.task-title").val(title);
  });
});

//allows tasks to be moved between labels
$(function () {
  var url = "../fyp/scripts/editLabel.php";
  $('ul[id^="sort"]')
    .sortable({
      connectWith: ".sortable",
      receive: function (e, ui) {
        var label_id = $(ui.item).parent(".sortable").data("label-id");
        var task_id = $(ui.item).data("task-id");
        $.ajax({
          url: url + "?label_id=" + label_id + "&task_id=" + task_id,
          success: function (response) {},
        });
      },
    })
    .disableSelection();
});

//gets the id of task on click
$(document).on('click', '#showEdit', function(){
  var taskid = $('#showEdit').parent().parent().attr("data-task-id");
  var task = $('#showEdit').parent().text();
  console.log(taskid, task);
})