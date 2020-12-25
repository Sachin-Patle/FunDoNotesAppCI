<?php if ($notes) { ?>
    <?php
    $i = 1;
    foreach ($notes as $note) { ?>
        <div class="col-md-4" id="note<?php echo $note['id']; ?>">
            <div id="note_card<?php echo $note['id']; ?>" class="card ibox" style="background-color:<?php echo $note['color']; ?>;">
                <div class="ibox-head">
                    <div class="ibox-title"><?php echo $note['title']; ?></div>
                    <div class="ibox-tools">
                        <!-- <a class="ibox-collapse"><i class="fa fa-thumb-tack"></i></a> -->
                        <a class="ibox-collapse" title="Pin"><i class="ti-pin2"></i></a>
                    </div>
                </div>
                <div class="card-body ibox-body">

                    <p><?php echo $note['note']; ?></p>

                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <?php
                        if ($note['status'] == 1) {
                        ?>
                            <input style="height:35px;" type="color" title="Change color" id="change_color<?php echo $note['id']; ?>" value="<?php echo $note['color']; ?>" class="btn btn-default btn-rounded">
                            <button data-toggle="modal" title="Add image" data-target="#imageModal<?php echo $note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-image"></i></button>
                            <?php
                            if ($note['archive'] == 0) {
                            ?>
                                <button title="Archive" id="archive_note<?php echo $note['id']; ?>" value="<?php echo $note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-archive"></i></button>
                            <?php
                            } else {
                            ?>
                                <button title="Unarchive" id="unarchive_note<?php echo $note['id']; ?>" value="<?php echo $note['id']; ?>" class="btn btn-default btn-rounded"><i class="ti-archive"></i></button>
                            <?php
                            }
                            ?>
                            <button data-toggle="modal" title="Edit" data-target="#editModal<?php echo $note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-pencil"></i></button>
                            <button title="Move to trash" id="trash_note<?php echo $note['id']; ?>" value="<?php echo $note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-trash"></i></button>
                        <?php
                        } else {
                        ?>
                            <button title="Restore" id="restore_note<?php echo $note['id']; ?>" value="<?php echo $note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-recycle"></i></button>
                            <button data-toggle="modal" title="Delete" data-target="#deleteModal<?php echo $note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-trash"></i></button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- editModal -->
        <div class="modal fade" id="editModal<?php echo $note['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form_edit<?php echo $note['id']; ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                                <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $note['title']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" name="note" cols="35" placeholder="Enter note message here" required><?php echo $note['note']; ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeSubmit"><i class="fa fa-times"></i> Close</button>
                            <button type="submit" name="editDetail" class="btn btn-success"><i class="fa fa-edit"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- deleteModal -->
        <div class="modal fade" id="deleteModal<?php echo $note['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure want to permanently delete this ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form_delete<?php echo $note['id']; ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                            <button type="submit" name="deleteDetail" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <script>
            $(document).ready(function() {
                /**
                 * Method when submitting form to update note details
                 */
                $("#form_edit<?php echo $note['id']; ?>").submit(function(event) {
                    // Prevent the form from submitting via the browser.
                    event.preventDefault();
                    update_note();
                    get_notes();
                });
                /**
                 * Method when submitting form to delete note details
                 */
                $("#form_delete<?php echo $note['id']; ?>").submit(function(event) {
                    // Prevent the form from submitting via the browser.
                    event.preventDefault();
                    delete_note();
                    get_notes();
                });
                /**
                 * Method when click on archive button
                 */
                $("#archive_note<?php echo $note['id']; ?>").click(function(event) {
                    // Prevent the form from submitting via the browser.
                    event.preventDefault();
                    set_archive(this.value);
                });
                /**
                 * Method when click on unarchive button
                 */
                $("#unarchive_note<?php echo $note['id']; ?>").click(function(event) {
                    // Prevent the form from submitting via the browser.
                    event.preventDefault();
                    unset_archive(this.value);
                });

                /**
                 * Method when click on trash button
                 */
                $("#trash_note<?php echo $note['id']; ?>").click(function(event) {
                    // Prevent the form from submitting via the browser.
                    event.preventDefault();
                    trash_note(this.value);
                });
                /**
                 * Method when click on restore button
                 */
                $("#restore_note<?php echo $note['id']; ?>").click(function(event) {
                    // Prevent the form from submitting via the browser.
                    event.preventDefault();
                    restore_note(this.value);
                });
                /**
                 * Method when select color from color picker
                 */
                $("#change_color<?php echo $note['id']; ?>").change(function(event) {
                    // Prevent the form from submitting via the browser.
                    event.preventDefault();
                    change_color(this.value, <?php echo $note['id']; ?>);
                });
                /**
                 * @method - update_note
                 * @description
                 * Method to update note details
                 * Getting form data by form id and updating changes according to id by using ajax
                 */
                function update_note() {
                    var form_data = $('#form_edit<?php echo $note['id']; ?>').serialize();

                    $.ajax({
                        url: "<?= site_url('/update-note') ?>",
                        method: "POST",
                        data: form_data,
                        success: function(result) {
                            $("#form_edit<?php echo $note['id']; ?>")[0].reset();
                            $("#editModal<?php echo $note['id']; ?>").modal('toggle');
                            $("#note<?php echo $note['id']; ?>").html(result);
                        },
                        error: function() {
                            alert("Failed to update note");
                        }
                    });
                }
                /**
                 * @method - delete_note
                 * @description
                 * Method to delete note details
                 * Getting form data by form id and updating changes according to id by using ajax
                 */
                function delete_note() {
                    var form_data = $('#form_delete<?php echo $note['id']; ?>').serialize();

                    $.ajax({
                        url: "<?= site_url('/delete-note') ?>",
                        method: "POST",
                        data: form_data,
                        success: function(data) {
                            $("#note<?php echo $note['id']; ?>").remove();
                            $("#form_delete<?php echo $note['id']; ?>")[0].reset();
                            $("#deleteModal<?php echo $note['id']; ?>").modal('toggle');
                        },
                        error: function() {
                            alert("Failed to delete note");
                        }
                    });
                }

                /**
                 * @method - set_archive
                 * @param - id
                 * @description
                 * Method to set note as archive note
                 * Getting id by param and setting note as archive by using ajax
                 */
                function set_archive(id) {

                    $.ajax({
                        url: "<?= site_url('/set-archive') ?>",
                        method: "POST",
                        data: {
                            note_id: id
                        },
                        success: function(data) {
                            $("#note<?php echo $note['id']; ?>").remove();
                        },
                        error: function() {
                            alert("Failed to archive note");
                        }
                    });
                }

                /**
                 * @method - unset_archive
                 * @description
                 * @param - id
                 * Method to unarchive note
                 * Getting id from params and removing notes from archive according to ObjectId by using ajax
                 */
                function unset_archive(id) {

                    $.ajax({
                        url: "<?= site_url('/unset-archive') ?>",
                        method: "POST",
                        data: {
                            note_id: id
                        },
                        success: function(data) {
                            $("#note<?php echo $note['id']; ?>").remove();
                        },
                        error: function() {
                            alert("Failed to unarchive note");
                        }
                    });
                }

                /**
                 * @method - trash_note
                 * @description
                 * @param - id
                 * Method to move note to trash
                 * Getting id and moving note to trash according to id by using ajax
                 */
                function trash_note(id) {

                    $.ajax({
                        url: "<?= site_url('/trash-note') ?>",
                        method: "POST",
                        data: {
                            note_id: id
                        },
                        success: function(data) {
                            $("#note<?php echo $note['id']; ?>").remove();
                        },
                        error: function() {
                            alert("Failed to trash note");
                        }
                    });
                }

                /**
                 * @method - restore_note
                 * @description
                 * @param - id
                 * Method to restore note from trash
                 * Getting id and restoring note from trash according to id by using ajax
                 */
                function restore_note(id) {

                    $.ajax({
                        url: "<?= site_url('/restore-note') ?>",
                        method: "POST",
                        data: {
                            note_id: id
                        },
                        success: function(data) {
                            $("#note<?php echo $note['id']; ?>").remove();
                        },
                        error: function() {
                            // some error handling part
                            alert("Failed to delete note");
                        }
                    });
                }

                /**
                 * @method - change_color
                 * @description
                 * @param - id, color
                 * Method to change note background color
                 * Getting color from color picker and updating changes according to id by using ajax
                 */
                function change_color(color, id) {

                    $.ajax({
                        url: "<?= site_url('/change-color') ?>",
                        method: "POST",
                        data: {
                            note_id: id,
                            color: color
                        },
                        success: function(data) {
                            $("#note_card<?php echo $note['id']; ?>").css("background-color", color);
                            // $("#change_color<?php echo $note['id']; ?>").css("background-color", color);
                        },
                        error: function() {
                            alert("Failed to change color");
                        }
                    });
                }
            });
        </script>
    <?php
        $i++;
    }; ?>
<?php }; ?>