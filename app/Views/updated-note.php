<?php if($updated_note){ ?>
                        <div class="card ibox">
                            <div class="ibox-head">
                                <div class="ibox-title"><?php echo $updated_note['title']; ?></div>
                                <!-- <div class="ibox-tools">
                                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                </div> -->
                            </div>
                            <div class="card-body ibox-body">
                                
                                <p><?php echo $updated_note['note']; ?></p>
                                
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                <button data-toggle="modal" data-target="#editModal<?php echo $updated_note['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                <button data-toggle="modal" data-target="#deleteModal<?php echo $updated_note['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                <!-- <a onclick="return confirm('Are you sure want to delete ?')" href="<?php echo base_url('delete/'.$updated_note['id']);?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
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
                                    <form id="form_edit<?php echo $updated_note['id']; ?>" >
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

                        <!-- deleteModal -->
                        <div class="modal fade" id="deleteModal<?php echo $updated_note['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form_delete<?php echo $updated_note['id']; ?>" >
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
                                get_notes();
                            });
                            /**
                             * Method when submitting form to delete note details
                             */
                            $("#form_delete<?php echo $updated_note['id']; ?>").submit(function(event) {
                                // Prevent the form from submitting via the browser.
                                event.preventDefault();
                                delete_note();
                                get_notes();
                            });
                            /**
                            * @method - update_note
                            * @description
                            * Method to update note details
                            * Getting form data by form id and updating changes according to ObjectId by using ajax
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
                            * @method - delete_note
                            * @description
                            * Method to update note details
                            * Getting form data by form id and updating changes according to ObjectId by using ajax
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
                                        // some error handling part
                                        alert("Failed to delete note");
                                    }
                                });
                            }
                        });
                    </script>
                    <?php }; ?>