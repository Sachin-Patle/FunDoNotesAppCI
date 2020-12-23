<?php if($notes){ ?>
                    <?php
                    $i=1;
                    foreach($notes as $note){ ?>
                    <div class="col-md-4" id="note<?php echo $note['id']; ?>">
                        <div class="card ibox">
                            <div class="ibox-head">
                                <div class="ibox-title"><?php echo $note['title']; ?></div>
                                <div class="ibox-tools">
                                    <!-- <a class="ibox-collapse"><i class="fa fa-thumb-tack"></i></a> -->
                                    <a class="ibox-collapse"><i class="ti-pin2"></i></a>
                                </div>
                            </div>
                            <div class="card-body ibox-body">
                                
                                <p><?php echo $note['note']; ?></p>
                                
                            </div>
                            <div class="ibox-footer">
                                <div class="float-right">
                                <button id="archive_note<?php echo $note['id']; ?>" value="<?php echo $note['id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-archive"></i></button>
                                <button data-toggle="modal" data-target="#editModal<?php echo $note['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                <button data-toggle="modal" data-target="#deleteModal<?php echo $note['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
                                    <form id="form_edit<?php echo $note['id']; ?>" >
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
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form_delete<?php echo $note['id']; ?>" >
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
                            * @method - update_note
                            * @description
                            * Method to update note details
                            * Getting form data by form id and updating changes according to ObjectId by using ajax
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
                                        // some error handling part
                                        alert("Failed to update note");
                                    }
                                });
                            }
                            /**
                            * @method - delete_note
                            * @description
                            * Method to update note details
                            * Getting form data by form id and updating changes according to ObjectId by using ajax
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
                                        // $("#note<?php echo $note['id']; ?>").remove(); 
                                    },
                                    error: function() {
                                        // some error handling part
                                        alert("Failed to delete note");
                                    }
                                });
                            }
                        });
                    </script>
                        <?php
                    $i++;
                    }; ?>
                    <?php }; ?>