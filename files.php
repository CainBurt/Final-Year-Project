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
    <h1 class="h2">Files</h1>
    <button class="btn rounded-pill red new-project-btn" data-toggle="modal" data-target="#uploadFileModal"><span class="bi bi-plus white">Upload File</span></button>
</div>

<!-- Upload File Modal-->
<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="uploadFileModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Select File to Upload:</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/files.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" id="file" name="file">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="uploadFile">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- File table -->
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Uploader Name</th>
                <th scope="col">File Name</th>
                <th scope="col">File Size (MB)</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $files = getAllFiles();
            if (isset($files)) {

                foreach ($files as $file) { ?>
                    <tr>
                        <?php $users = getAllUsersInProject();
                        foreach ($users as $user) {
                            if ($file["uploader_id"] == $user["id"]) {

                        ?>
                                <td> <?php echo $user["user_name"] . " " . $user["user_surname"]; ?></td>
                        <?php }
                        } ?>
                        <td> <?php echo $file["filename"]; ?></td>
                        <td> <?php echo $file["filesize"] . " MB"; ?></td>
                        <td class="d-flex justify-content-around">
                            <a href="files.php?file_id=<?php echo $file["id"]; ?>" data-toggle="tooltip" title="Download File"><i class="fa-solid fa-file-arrow-down"></i></a>
                            <a href="files.php?del_file_id=<?php echo $file["id"] ?>" data-toggle="tooltip" title="Delete File"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>

            <?php }
            } ?>
        </tbody>
    </table>
</div>


<?php include_once 'footer.php' ?>