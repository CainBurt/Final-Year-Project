$(document).ready(function() {
    // SidebarCollapse();

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
        var start = button.data("start");
        var end = button.data("end");
        var modal = $(this);
        modal.find(".modal-title").text("Edit Task");
        modal.find(".modal-body input.task-id").val(taskId);
        modal.find(".modal-body input.task-title").val(title);
        modal.find(".modal-body input.project-start").val(start);
        modal.find(".modal-body input.project-end").val(end);
    });

    //shows the data in the delete project modal
    $("#deleteModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var projectId = button.data("project");
        console.log(projectId);
        var modal = $(this);
        modal.find(".modal-body input.project").val(projectId);

    });

    //shows the data in the leave project
    $("#leaveProjectModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var projectId = button.data("id");
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

    // shows add user modal on click
    $("#addUserModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var email = button.data("useremail");
        var modal = $(this);
        modal.find(".modal-title").text("Add User");
    });

    //shows the data in the remove user modal
    $("#removeUserModal").on("show.bs.modal", function(event) {
        console.log("CLICK");
        var button = $(event.relatedTarget);
        var userId = button.data("user");
        var modal = $(this);
        modal.find(".modal-body input.userId").val(userId);
    });

    //shows the add sub task modal and puts data into the inputs
    $("#addSubtaskModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var taskId = button.data("task");
        var modal = $(this);
        modal.find(".modal-body input.task-id").val(taskId);
    });

    //shows the edit subtask modal and puts data into the inputs
    $("#editSubtask").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var taskId = button.data("task");
        var title = button.data("title");
        var modal = $(this);
        modal.find(".modal-title").text("Edit Subtask");
        modal.find(".modal-body input.task-id").val(taskId);
        modal.find(".modal-body input.task-title").val(title);
    });

    //shows the edit task modal on the tasks page and puts data into the inputs
    $("#editTaskModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var taskId = button.data("task");
        var title = button.data("title");
        var start = button.data("start");
        var end = button.data("end");
        var modal = $(this);
        modal.find(".modal-title").text("Edit Task");
        modal.find(".modal-body input.task-id").val(taskId);
        modal.find(".modal-body input.task-title").val(title);
        modal.find(".modal-body input.project-start").val(start);
        modal.find(".modal-body input.project-end").val(end);
    });

    // put task id in change user modal
    $("#changeUser").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var taskId = button.data("task");
        var modal = $(this);
        modal.find(".modal-title").text("Change User on Task");
        modal.find(".modal-body input.task-id").val(taskId);
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

//Dynamically changes status of subtask on click
$(document).on('click', '#subtask_status', function() {
    var url = "../fyp/scripts/editTaskStatus.php";

    console.log("CHECKBOX CLICKED");
    console.log($(this).data("subtask-id"));
    console.log($(this).is(":checked") ? 1 : 0);
    var status = $(this).is(":checked") ? 1 : 0;
    var subtask = $(this).data("subtask-id");

    $.ajax({
        url: url + "?status=" + status + "&subtask_id=" + subtask,
        success: function() {
            // alert("changed subtask statys");
        }
    });
});
//gets the id of task on click
$(document).on('click', '#showEdit', function() {
    var taskid = $('#showEdit').parent().parent().attr("data-task-id");
    var task = $('#showEdit').parent().text();
})

// Sidebar Collapse click
$(document).on('click', '[data-toggle=collapse]', function() {
    SidebarCollapse();
})

function SidebarCollapse() {
    $('.menu-collapsed').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    $('#projectName').toggleClass('acronym acronym-collapsed');
}

// Task Expand and collapse toggle on click
$(document).on('click', '[data-toggle=taskExpand]', function(e) {
    var taskid = $(this).data("task-id");
    var subtaskTaskId = $(this).next().data('subtask-task-id')
    if ($(e.target).is('div>ul>li>a')) {
        e.preventDefault();
        return;
    }
    TaskExpand(taskid, subtaskTaskId);
})

function TaskExpand(taskid, subtaskTaskId) {
    if (taskid == subtaskTaskId) {
        $('[id="subtaskid' + String(subtaskTaskId) + '"]').toggleClass('d-none');
        $('[id="arrowid' + String(taskid) + '"]').toggleClass('fa-chevron-down fa-chevron-up');
    }

}


//login and register forms
$(function() {

    $('#login').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login').removeClass('active');
        $(this).addClass('active');
        $("#register-form").addClass('show');
        e.preventDefault();
    });

});

$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})