<?php require_once "elements/header.php"; ?>

<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Notes </h1>
                
            </div>
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#submitModal"><i class="fa fa-edit"></i> Take a note</button>
                        <hr>
                        <!-- submitModal -->
                <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Note</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="form_submit">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control" name="note" cols="35" placeholder="Enter Greeting message here" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeSubmit"><i class="fa fa-times"></i> Close</button>
                                    <button type="submit" name="submitDetail" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                    </div>
                </div>
                <div class="row" id="notes_result">
                <?php if($notes){ ?>
                    <?php
                    $i=1;
                    foreach($notes as $note){ ?>
                    <div class="col-md-4">
                        <div class="card ibox">
                            <div class="ibox-head">
                                <div class="ibox-title"><?php echo $note['title']; ?></div>
                                <div class="ibox-tools">
                                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                </div>
                            </div>
                            <div class="card-body ibox-body">
                                
                                <p><?php echo $note['note']; ?></p>
                                
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                <button data-toggle="modal" data-target="#editModal<?php echo $note['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                                <a onclick="return confirm('Are you sure want to delete ?')" href="<?php echo base_url('delete/'.$note['id']);?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                                                <textarea class="form-control" name="note" cols="35" placeholder="Enter Greeting message here" required><?php echo $note['note']; ?></textarea>
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

                        <script>
                        $(document).ready(function() {
                            /**
                             * Method when submitting form to update greeting details
                             */
                            $("#form_edit<?php echo $note['id']; ?>").submit(function(event) {
                                // Prevent the form from submitting via the browser.
                                event.preventDefault();
                                update_greeting();
                                get_notes();
                            });
                            /**
                            * @method - update_greeting
                            * @description
                            * Method to update greeting details
                            * Getting form data by form id and updating changes according to ObjectId by using ajax
                            */
                            function update_greeting() {
                                var form_data = $('#form_edit<?php echo $note['id']; ?>').serialize();

                                $.ajax({
                                    url: "<?= site_url('/update-note') ?>",
                                    method: "POST",
                                    data: form_data,
                                    success: function(data) {
                                        $("#form_edit<?php echo $note['id']; ?>")[0].reset();
                                        $("#editModal<?php echo $note['id']; ?>").modal('toggle');
                                    },
                                    error: function() {
                                        // some error handling part
                                        alert("Failed to update greeting");
                                    }
                                });
                            }
                        });
                    </script>
                        <?php
                    $i++;
                    }; ?>
                    <?php }; ?>

                    
                    
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            
    <?php require_once "elements/footer.php"; ?>

<!-- PAGE LEVEL SCRIPTS-->
<script>
    $(document).ready(function() {
        setTimeout(function() {
            // get_notes();
        }, 30);

        /**
         * Method when submitting form to save greeting details
         */
        $("#form_submit").submit(function(event) {
            // Prevent the form from submitting via the browser.
            event.preventDefault();
            submit_note();

        });

        /**
         * Method when submitting form to update greeting details
         */
        $("#form_edit").submit(function(event) {
            // Prevent the form from submitting via the browser.
            event.preventDefault();
            update_greeting();
            get_notes();
        });

        /**
         * Method when submitting form to delete greeting details
         */
        $("#form_delete").submit(function(event) {
            // Prevent the form from submitting via the browser.
            event.preventDefault();
            delete_greeting();
            get_notes();
        });

        /**
         * @method - get_notes
         * @description
         * Method to get and display all greeting details
         */
        function get_notes() {
            $.ajax({
                type: "GET",
                url: "<?= site_url('/notes-list') ?>",
                success: function(result) {
                    // alert(result);
                    $('#example-table').empty();
                    $.each(result, function(i, list) {
                        $('#example-table').append("<div class='col-sm-4'><div class='card'><div class='card-body'><p>ID : " + list._id + "<span class='float-right'><button class='btn btn-info btn-xs'><i class='fa fa-edit'></i></button></span></p><h5 class='card-subtitle mb-2 text-muted'>" + list.message + "</h5><p class='card-text text-right'>- " + list.name + "<p><hr><p class='card-text text-right'>- " + list.date + "<p></div></div></div>")
                    });
                },
                error: function(e) {
                    $("#getResultDiv").html("<strong>Error</strong>");
                    console.log("ERROR: ", e);
                }
            });
        }

        /**
         * @method - submit_greeting
         * @description
         * Method to save greeting
         * Getting form data by form id and saving details through ajax
         */
        function submit_note()
        {
            var form_data = $('#form_submit').serialize();
            
            $.ajax({
                url:"<?= site_url('/save-note') ?>",
                method: "POST",
                data : form_data,
                success : function (result) {
                    // alert(result);
                        // $('#notes_result').append("<div class='col-md-4'><div class='card ibox'><div class='ibox-head'><div class='ibox-title'>"+result+"</div><div class='ibox-tools'><a class='ibox-collapse'><i class='fa fa-minus'></i></a><a class='fullscreen-link'><i class='fa fa-expand'></i></a></div></div><div class='card-body ibox-body'><p>Note</p></div><div class='card-footer'><div class='float-right'><button data-toggle='modal' data-target='#editModal' class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i></button></div></div></div></div>")
                    $("#form_submit")[0].reset();
                    $('#submitModal').modal('toggle');
                },
                error : function () {
                    // some error handling part
                    alert("Failed to add greeting");
                }
            });
        }
        /**
         * @method - update_greeting
         * @description
         * Method to update greeting details
         * Getting form data by form id and updating changes according to ObjectId by using ajax
         */
        function update_greeting() {
            var form_data = jQuery('#form_edit').serialize();

            $.ajax({
                url: "/update_greeting",
                method: "PUT",
                data: form_data,
                success: function(data) {
                    $("#form_edit")[0].reset();
                    $('#editModel').modal('toggle');
                },
                error: function() {
                    // some error handling part
                    alert("Failed to update greeting");
                }
            });
        }

        /**
         * @method - update_greeting
         * @description
         * Method to update greeting details
         * Deleting greeting details according to ObjectId by using ajax
         */
        function delete_greeting() {
            var form_data = $('#form_delete').serialize();

            $.ajax({
                url: "/remove_greeting",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $("#form_delete")[0].reset();
                    $('#deleteModel').modal('toggle');
                },
                error: function() {
                    // some error handling part
                    alert("Failed to delete greeting");
                }
            });
        }

    })
</script>

</body>

</html>