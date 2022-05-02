<?php
include_once 'scripts/files.php';
// redirects if project variable isnt set
if (!isset($_SESSION['projectid'])) {
    header('location: ../fyp/projects.php');
    exit();
}
?>
<?php
include_once 'navbar.php';

?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Disucssion</h1>
    <button class="btn rounded-pill red new-project-btn" data-toggle="modal" data-target="#postDiscussionModal"><span class="bi bi-plus white">New Post</span></button>
</div>

<!-- Discussion Modal-->
<div class="modal fade" id="postDiscussionModal" tabindex="-1" role="dialog" aria-labelledby="postDiscussionModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">New Post:</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/discussion.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Post Content:</label>
                        <textarea type="textarea" class="form-control postcontent" id="postcontent" name="postcontent" placeholder="Post Content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="postDiscussion">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reply Modal-->
<div class="modal fade" id="postReplyModal" tabindex="-1" role="dialog" aria-labelledby="postReplyModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Reply:</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/discussion.php" method="post">
                <div class="modal-body">
                    <input type="text" class="form-control discussionid" id="discussionid" name="discussionid" readonly hidden>
                    <div class="form-group">
                        <label>Reply Content:</label>
                        <textarea type="textarea" class="form-control postcontent" id="postcontent" name="postcontent" placeholder="Post Content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="postReply">Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$posts = getAllDiscussions();
foreach ($posts as $post) {
    if (userCreatedCurrentProject() == TRUE || $_SESSION["user_id"] == $post["creator_id"]) {
        echo "<style>.hide{display:block}</style>";
    }
?>

    <div class="row-6 d-flex mt-2">
        <div>
            <div class="circle-around" data-toggle="tooltip" data-placement="bottom" title="<?php echo $post["user_name"]  . " " . $post["user_surname"] ?>"><?php echo $post["user_name"][0] . $post["user_surname"][0] ?></div>
        </div>
        <div class="card flex-grow-1 ">
            <div class="card-body d-flex ">
                <div class="flex-grow-1">
                    <?php echo $post['dis_content'] ?>
                </div>
                <a href="scripts/discussion.php?del_post_id=<?php echo $post['id'] ?>" class="hide" data-toggle="tooltip" title="Delete Post"><i class="bi bi-trash"></i></a>
            </div>
            <div class="mx-5">
                <div class="card-body ">
                    <?php
                    $replys = getAllReply($post["id"]);
                    if (isset($replys)) {
                        foreach ($replys as $reply) {

                    ?>
                            <div class="d-flex card-body border-top">
                                <div>
                                    <div class="circle-around" data-toggle="tooltip" data-placement="bottom" title="<?php echo $reply["user_name"]  . " " . $reply["user_surname"] ?>"><?php echo $reply["user_name"][0] . $reply["user_surname"][0] ?></div>
                                </div>
                                <div class="flex-grow-1">
                                    <?php echo $reply["reply_content"] ?>
                                </div>
                                <?php
                                if (userCreatedCurrentProject() == TRUE || $_SESSION["user_id"] == $reply["creator_id"]) {
                                    echo "<a href='scripts/discussion.php?del_reply_id=" . $reply['id'] . " data-toggle='tooltip' title='Delete Reply'><i class='bi bi-trash'></i></a>";
                                }

                                ?>

                            </div>
                    <?php
                        }
                    } ?>
                    <div class="pt-2">
                        <button class="btn rounded-pill red new-project-btn" data-toggle="modal" data-target="#postReplyModal" data-post="<?php echo $post["id"]; ?>"><span class="bi bi-plus white">Reply</span></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
}
?>

<?php include_once 'footer.php' ?>