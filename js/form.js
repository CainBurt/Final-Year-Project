$(document).ready(function() {
    SidebarCollapse();
    //shows the create task modal and puts data into the inputs
    $("#taskModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var list = button.data("list"); // Extract info from data-* attributes
        var listName = button.data("name")
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find(".modal-title").text("Add a Task to " + listName + " list?");
        modal.find(".modal-body input.list-name").val(list);
    });

    //shows the edit task modal and puts data into the inputs
    $("#editModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var taskId = button.data("task");
        var title = button.data("title");
        var modal = $(this);
        modal.find(".modal-title").text("Edit Task");
        modal.find(".modal-body input.task-id").val(taskId);
        modal.find(".modal-body input.task-title").val(title);
    });

    //shows the data in the delete project modal
    $("#deleteModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var projectId = button.data("project");
        console.log(projectId);
        var modal = $(this);
        modal.find(".modal-body input.project").val(projectId);

    });

    //shows the edit project modal and puts data into the inputs
    $("#editProjectModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data("id");
        var title = button.data("title");
        var desc = button.data("desc");
        var start = button.data("start");
        var end = button.data("end");
        var modal = $(this);
        modal.find(".modal-body input.project-id").val(id);
        modal.find(".modal-body input.project-name").val(title);
        modal.find(".modal-body textarea.project-desc").val(desc);
        modal.find(".modal-body input.project-start").val(start);
        modal.find(".modal-body input.project-end").val(end);
    });




});

//allows tasks to be moved between labels
$(function() {
    var url = "../fyp/scripts/editLabel.php";
    $('ul[id^="sort"]')
        .sortable({
            connectWith: ".sortable",
            receive: function(e, ui) {
                var label_id = $(ui.item).parent(".sortable").data("label-id");
                var task_id = $(ui.item).data("task-id");
                $.ajax({
                    url: url + "?label_id=" + label_id + "&task_id=" + task_id,
                    success: function(response) {},
                });
            },
        })
        .disableSelection();
});

//gets the id of task on click
$(document).on('click', '#showEdit', function() {
    var taskid = $('#showEdit').parent().parent().attr("data-task-id");
    var task = $('#showEdit').parent().text();
    console.log(taskid, task);
})

// Collapse click
$(document).on('click', '[data-toggle=collapse]', function() {
    SidebarCollapse();
})

function SidebarCollapse() {
    $('.menu-collapsed').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    $('#projectName').toggleClass('acronym acronym-collapsed');

}