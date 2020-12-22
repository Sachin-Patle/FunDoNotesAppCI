<?php if($labels){ ?>
                    <?php
                    $i=1;
                    foreach($labels as $label){ ?>
                    <div class="col-md-4" id="label<?php echo $label['id']; ?>">
                        <div class="card ibox">
                            <div class="ibox-head">
                                <div class="ibox-title"><?php echo $label['label_name']; ?></div>
                                <div class="ibox-tools">
                                    <!-- <a class="ibox-collapse"><i class="fa fa-thumb-tack"></i></a> -->
                                    <a class="ibox-collapse"><i class="ti-pin2"></i></a>
                                </div>
                            </div>
                            <div class="card-body ibox-body">
                                
                                <p><?php echo $label['label']; ?></p>
                                
                            </div>
                            <div class="ibox-footer">
                                <div class="float-right">
                                <button data-toggle="modal" data-target="#editModal<?php echo $label['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                <button data-toggle="modal" data-target="#deleteModal<?php echo $label['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- editModal -->
                    <div class="modal fade" id="editModal<?php echo $label['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit label</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form_edit<?php echo $label['id']; ?>" >
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="hidden" name="label_id" value="<?php echo $label['id']; ?>">
                                                <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $label['title']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>label</label> 
                                                <textarea class="form-control" name="label" cols="35" placeholder="Enter label message here" required><?php echo $label['label']; ?></textarea>
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
                        <div class="modal fade" id="deleteModal<?php echo $label['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form_delete<?php echo $label['id']; ?>" >
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="label_id" value="<?php echo $label['id']; ?>">
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
                             * Method when submitting form to update label details
                             */
                            $("#form_edit<?php echo $label['id']; ?>").submit(function(event) {
                                // Prevent the form from submitting via the browser.
                                event.preventDefault();
                                update_label();
                                get_labels();
                            });
                            /**
                             * Method when submitting form to delete label details
                             */
                            $("#form_delete<?php echo $label['id']; ?>").submit(function(event) {
                                // Prevent the form from submitting via the browser.
                                event.preventDefault();
                                delete_label();
                                get_labels();
                            });
                            /**
                            * @method - update_label
                            * @description
                            * Method to update label details
                            * Getting form data by form id and updating changes according to ObjectId by using ajax
                            */
                            function update_label() {
                                var form_data = $('#form_edit<?php echo $label['id']; ?>').serialize();

                                $.ajax({
                                    url: "<?= site_url('/update-label') ?>",
                                    method: "POST",
                                    data: form_data,
                                    success: function(result) {
                                        $("#form_edit<?php echo $label['id']; ?>")[0].reset();
                                        $("#editModal<?php echo $label['id']; ?>").modal('toggle');
                                        $("#label<?php echo $label['id']; ?>").html(result);
                                    },
                                    error: function() {
                                        // some error handling part
                                        alert("Failed to update label");
                                    }
                                });
                            }
                            /**
                            * @method - delete_label
                            * @description
                            * Method to update label details
                            * Getting form data by form id and updating changes according to ObjectId by using ajax
                            */
                            function delete_label() {
                                var form_data = $('#form_delete<?php echo $label['id']; ?>').serialize();

                                $.ajax({
                                    url: "<?= site_url('/delete-label') ?>",
                                    method: "POST",
                                    data: form_data,
                                    success: function(data) {
                                        $("#label<?php echo $label['id']; ?>").remove(); 
                                        $("#form_delete<?php echo $label['id']; ?>")[0].reset();
                                        $("#deleteModal<?php echo $label['id']; ?>").modal('toggle');
                                        // $("#label<?php echo $label['id']; ?>").remove(); 
                                    },
                                    error: function() {
                                        // some error handling part
                                        alert("Failed to delete label");
                                    }
                                });
                            }
                        });
                    </script>
                        <?php
                    $i++;
                    }; ?>
                    <?php }; ?>