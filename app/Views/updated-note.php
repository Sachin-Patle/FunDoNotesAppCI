<?php
if ($updated_note) {
    $image = base_url() . "/temp/" . $updated_note['image'];
?>
    <div id="note_card<?php echo $updated_note['id']; ?>" class="card ibox" style="background-color:<?php echo $updated_note['color']; ?>;">
        <?php
        if (!empty($updated_note['image'])) {
        ?>
            <img id="card_image<?php echo $updated_note['id']; ?>" class="card-img-top" src="<?php echo $image; ?>" />
        <?php
        }
        ?>
        <div class="ibox-head">
            <div class="ibox-title"><?php echo $updated_note['title']; ?></div>
            <div class="ibox-tools">
                <?php
                if ($updated_note['pin'] == 0) {
                ?>
                    <a id="pin_note<?php echo $updated_note['id']; ?>" class="ibox-collapse" title="Pin"><i class="ti-pin2"></i></a>
                <?php
                } else {
                ?>
                    <a id="unpin_note<?php echo $updated_note['id']; ?>" title="Unpin" class="ibox-collapse"><i class="fa fa-thumb-tack"></i></a>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="card-body ibox-body">

            <p><?php echo $updated_note['note']; ?></p>

        </div>
        <div class="modal-footer">
            <div class="float-right">
                <?php
                if ($updated_note['status'] == 1) {
                ?>
                    <button data-toggle="modal" title="Change Color" data-target="#colorModal<?php echo $updated_note['id']; ?>" class="btn btn-default btn-rounded"><i class="ti-paint-bucket"></i></button>
                    <button data-toggle="modal" title="Add image" data-target="#imageModal<?php echo $updated_note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-image"></i></button>
                    <?php
                    if ($updated_note['archive'] == 0) {
                    ?>
                        <button title="Archive" id="archive_note<?php echo $updated_note['id']; ?>" value="<?php echo $updated_note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-archive"></i></button>
                    <?php
                    } else {
                    ?>
                        <button title="Unarchive" id="unarchive_note<?php echo $updated_note['id']; ?>" value="<?php echo $updated_note['id']; ?>" class="btn btn-default btn-rounded"><i class="ti-archive"></i></button>
                    <?php
                    }
                    ?>
                    <button data-toggle="modal" title="Edit" data-target="#editModal<?php echo $updated_note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-pencil"></i></button>
                    <button title="Move to trash" id="trash_note<?php echo $updated_note['id']; ?>" value="<?php echo $updated_note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-trash"></i></button>
                <?php
                } else {
                ?>
                    <button title="Restore" id="restore_note<?php echo $updated_note['id']; ?>" value="<?php echo $updated_note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-recycle"></i></button>
                    <button data-toggle="modal" title="Delete" data-target="#deleteModal<?php echo $updated_note['id']; ?>" class="btn btn-default btn-rounded"><i class="fa fa-trash"></i></button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- editModal -->
    <div class="modal fade" id="editModal<?php echo $updated_note['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit<?php echo $updated_note['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="hidden" name="note_id" value="<?php echo $updated_note['id']; ?>">
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $updated_note['title']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" name="note" cols="35" placeholder="Enter note message here" required><?php echo $updated_note['note']; ?></textarea>
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

    <!-- imageModal -->
    <div class="modal fade" id="imageModal<?php echo $updated_note['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_image<?php echo $updated_note['id']; ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Select Image</label>
                            <input type="hidden" name="note_id" value="<?php echo $updated_note['id']; ?>">
                            <input type="file" name="file" id="note_image<?php echo $updated_note['id']; ?>" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeSubmit"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" name="updateTmage" class="btn btn-info"><i class="fa fa-upload"></i> Upload</button>
                        <button type="button" name="removeTmage" class="btn btn-danger" id="remove_image<?php echo $updated_note['id']; ?>"><i class="fa fa-trash"></i> Remove Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- colorModal -->
    <div class="modal fade" id="colorModal<?php echo $updated_note['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Color</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="change_color<?php echo $updated_note['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="note_id" value="<?php echo $updated_note['id']; ?>">

                            <div>
                                <?php
                                if (empty($updated_note['color'])) {
                                    $default = "checked";
                                    // $check="";
                                } else {
                                    $default = "";
                                    // $check="checked";
                                }
                                ?>
                                <label class="ui-radio ui-radio-inline" title="Default">
                                    <input type="radio" name="color" name="color" value="#fff" checked="<?php echo $default; ?>">
                                    <span class="input-span" style="background-color: white"></span></label>
                                <?php
                                if ($colors) {
                                    foreach ($colors as $color) {

                                        if ($color['color'] == $updated_note['color']) {
                                            $check = "";
                                        } else {
                                            $check = "checked";
                                        }
                                ?>
                                        <label class="ui-radio ui-radio-inline" title="<?php echo $color['color_name']; ?>">
                                            <input type="radio" name="color" name="color" value="<?php echo $color['color']; ?>" checked="<?php echo $check; ?>">
                                            <span class="input-span" style="background-color: <?php echo $color['color']; ?>;"></span></label>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeSubmit"><i class="fa fa-times"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- deleteModal -->
    <div class="modal fade" id="deleteModal<?php echo $updated_note['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure want to permanently delete this ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_delete<?php echo $updated_note['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="note_id" value="<?php echo $updated_note['id']; ?>">
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
            $("#form_edit<?php echo $updated_note['id']; ?>").submit(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                update_note();
            });
            /**
             * Method when submitting form to update note image
             */
            $("#form_image<?php echo $updated_note['id']; ?>").submit(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                update_image(<?php echo $updated_note['id']; ?>);
            });
            /**
             * Method when click on remove image button
             */
            $("#remove_image<?php echo $updated_note['id']; ?>").click(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                remove_image(<?php echo $updated_note['id']; ?>);
            });
            /**
             * Method when submitting form to delete note details
             */
            $("#form_delete<?php echo $updated_note['id']; ?>").submit(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                delete_note();
            });
            /**
             * Method when click on archive button
             */
            $("#archive_note<?php echo $updated_note['id']; ?>").click(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                set_archive(this.value);
            });
            /**
             * Method when click on unarchive button
             */
            $("#unarchive_note<?php echo $updated_note['id']; ?>").click(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                unset_archive(this.value);
            });

            /**
             * Method when click on pin button
             */
            $("#pin_note<?php echo $updated_note['id']; ?>").click(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                set_pin(<?php echo $updated_note['id']; ?>);
            });
            /**
             * Method when click on unpin button
             */
            $("#unpin_note<?php echo $updated_note['id']; ?>").click(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                unset_pin(<?php echo $updated_note['id']; ?>);
            });

            /**
             * Method when click on trash button
             */
            $("#trash_note<?php echo $updated_note['id']; ?>").click(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                trash_note(this.value);
            });
            /**
             * Method when click on restore button
             */
            $("#restore_note<?php echo $updated_note['id']; ?>").click(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                restore_note(this.value);
            });
            /**
             * Method when select color from color picker
             */
            $("#change_color<?php echo $updated_note['id']; ?>").change(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                change_color(this.value, <?php echo $updated_note['id']; ?>);
            });
            /**
             * @method - update_note
             * @description
             * Method to update note details
             * Getting form data by form id and updating changes according to id by using ajax
             */
            function update_note() {
                var form_data = $('#form_edit<?php echo $updated_note['id']; ?>').serialize();

                $.ajax({
                    url: "<?= site_url('/update-note') ?>",
                    method: "POST",
                    data: form_data,
                    success: function(result) {
                        $("#form_edit<?php echo $updated_note['id']; ?>")[0].reset();
                        $("#editModal<?php echo $updated_note['id']; ?>").modal('toggle');
                        $("#note<?php echo $updated_note['id']; ?>").html(result);
                    },
                    error: function() {
                        // some error handling part
                        alert("Failed to update note");
                    }
                });
            }

            /**
             * @method - update_image
             * @description
             * Method to update note details
             * Updating note image changes according to id by using ajax
             */
            function update_image(val) {
                var file_data = $("#note_image<?php echo $updated_note['id']; ?>").prop("files")[0];
                var form_data = new FormData();
                form_data.append("file", file_data);
                form_data.append("note_id", val);
                $.ajax({
                    url: "<?= site_url('/change-image') ?>",
                    contentType: false,
                    processData: false,
                    data: form_data,
                    method: 'POST',
                    success: function(result) {
                        $("#form_image<?php echo $updated_note['id']; ?>")[0].reset();
                        $("#imageModal<?php echo $updated_note['id']; ?>").modal('toggle');
                        $("#note<?php echo $updated_note['id']; ?>").html(result);
                    },
                    error: function() {
                        alert("Failed to update Image");
                    }
                });
            }
            /**
             * @method - remove_image
             * @param - id
             * @description
             * Method to set note as archive note
             * Getting id by param and setting note as archive by using ajax
             */
            function remove_image(id) {

                $.ajax({
                    url: "<?= site_url('/remove-image') ?>",
                    method: "POST",
                    data: {
                        note_id: id
                    },
                    success: function(result) {
                        $("#form_image<?php echo $updated_note['id']; ?>")[0].reset();
                        $("#imageModal<?php echo $updated_note['id']; ?>").modal('toggle');
                        $("#note<?php echo $updated_note['id']; ?>").html(result);
                    },
                    error: function() {
                        alert("Failed to remove image");
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
                var form_data = $('#form_delete<?php echo $updated_note['id']; ?>').serialize();

                $.ajax({
                    url: "<?= site_url('/delete-note') ?>",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        $("#note<?php echo $updated_note['id']; ?>").remove();
                        $("#form_delete<?php echo $updated_note['id']; ?>")[0].reset();
                        $("#deleteModal<?php echo $updated_note['id']; ?>").modal('toggle');
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
                        $("#note<?php echo $updated_note['id']; ?>").remove();
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
                        $("#note<?php echo $updated_note['id']; ?>").remove();
                    },
                    error: function() {
                        // some error handling part
                        alert("Failed to delete note");
                    }
                });
            }

            /**
             * @method - set_pin
             * @param - id
             * @description
             * Method to pin note
             * Getting id by param and setting note as pinned note by using ajax
             */
            function set_pin(id) {

                $.ajax({
                    url: "<?= site_url('/set-pin') ?>",
                    method: "POST",
                    data: {
                        note_id: id
                    },
                    success: function(result) {
                        $("#notes_result").find("#note<?php echo $updated_note['id']; ?>").remove();
                        $('#pinned_header').show();
                        $('#other_header').show();
                        $('#pin_result').append(result);
                    },
                    error: function() {
                        alert("Failed to pin note");
                    }
                });
            }

            /**
             * @method - unset_pin
             * @param - id
             * @description
             * Method to unpin note
             * Getting id by param and remove from pin by using ajax
             */
            function unset_pin(id) {

                $.ajax({
                    url: "<?= site_url('/unset-pin') ?>",
                    method: "POST",
                    data: {
                        note_id: id
                    },
                    success: function(result) {
                        $("#pin_result").find("#note<?php echo $updated_note['id']; ?>").remove();
                        $('#notes_result').append(result);
                        if ($('#pin_result').is(':empty')) {
                            $('#pinned_header').hide();
                            $('#other_header').hide();
                        }
                    },
                    error: function() {
                        alert("Failed to unpin note");
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
                        $("#note<?php echo $updated_note['id']; ?>").remove();
                    },
                    error: function() {
                        // some error handling part
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
                        $("#note<?php echo $updated_note['id']; ?>").remove();
                    },
                    error: function() {
                        alert("Failed to restore note");
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
                        $("#note_card<?php echo $updated_note['id']; ?>").css("background-color", color);
                        // $("#change_color<?php echo $updated_note['id']; ?>").css("background-color", color);
                    },
                    error: function() {
                        alert("Failed to change color");
                    }
                });
            }
        });
    </script>
<?php }; ?>