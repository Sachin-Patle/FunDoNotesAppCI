<?php require_once "includes/header.php"; ?>

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-heading">
        <h1 class="page-title">Trash </h1>

    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-danger" data-toggle="modal" data-target="#trashModal"><i class="ti-trash"></i> Empty Trash</button>
                <hr>
                <!-- trashModal -->
                <div class="modal fade" id="trashModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to empty trash ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="empty_trash">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="closeSubmit"><i class="fa fa-times"></i> No</button>
                                    <button type="submit" name="submitDetail" class="btn btn-danger"><i class="fa fa-check-circle"></i> Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
            </div>
        </div>
        <div class="row" id="notes_result">




        </div>
    </div>
    <!-- END PAGE CONTENT-->

    <?php require_once "includes/footer.php"; ?>

    <!-- PAGE LEVEL SCRIPTS-->
    <script>
        $(document).ready(function() {
            /**
             * Loading list of label and notes using timeout
             */
            setTimeout(function() {
                get_notes();
                get_labels();
                labels_list_on_form();
            }, 10);

            /**
             * Method when submitting form to save note details
             */
            $("#empty_trash").submit(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                empty_trash();

            });
            /**
             * Method when submitting form to save label details
             */
            $("#form_label").submit(function(event) {
                // Prevent the form from submitting via the browser.
                event.preventDefault();
                submit_label();

            });

            /**
             * @method - get_notes
             * @description
             * Method to get and display all note details
             */
            function get_notes() {
                $.ajax({
                    type: "GET",
                    url: "<?= site_url('/trash-list') ?>",
                    success: function(result) {
                        $('#notes_result').empty();
                        $('#notes_result').html(result);
                    },
                    error: function(e) {
                        $('#notes_result').html("<h3>No data found</h3>");
                    }
                });
            }

            /**
             * @method - get_labels
             * @description
             * Method to get and display all label details
             */
            function get_labels() {
                $.ajax({
                    type: "GET",
                    url: "<?= site_url('/labels-list') ?>",
                    success: function(result) {
                        $('#label_list').empty();
                        $('#label_list').html(result);
                    },
                    error: function(e) {
                        $('#label_list').html("<h3>No data found</h3>");
                    }
                });
            }
            /**
             * @method - get_label_list
             * @description
             * Method to get and display all label details
             */
            function labels_list_on_form() {
                $.ajax({
                    type: "GET",
                    url: "<?= site_url('/labels-list-on-form') ?>",
                    success: function(result) {
                        $('#label_result').empty();
                        $('#label_result').html(result);
                    },
                    error: function(e) {
                        $('#label_result').html("<h3>No data found</h3>");
                    }
                });
            }

            /**
             * @method - empty_trash
             * @description
             * Method to save note
             * Getting form data by form id and saving details through ajax
             */
            function empty_trash() {
                $.ajax({
                    url: "<?= site_url('/empty-trash') ?>",
                    method: "POST",
                    success: function(result) {
                        get_notes();
                        $("#empty_trash")[0].reset();
                        $('#trashModal').modal('toggle');
                    },
                    error: function() {
                        // some error handling part
                        alert("Failed to add note");
                    }
                });
            }

            /**
             * @method - submit_label
             * @description
             * Method to save label
             * Getting form data by form id and saving details through ajax
             */
            function submit_label() {
                var form_data = $('#form_label').serialize();

                $.ajax({
                    url: "<?= site_url('/save-label') ?>",
                    method: "POST",
                    data: form_data,
                    success: function(result) {
                        get_labels();
                        labels_list_on_form();
                        $("#form_label")[0].reset();
                        $('#labelModal').modal('toggle');
                    },
                    error: function() {
                        // some error handling part
                        alert("Failed to add label");
                    }
                });
            }
        })
    </script>

    </body>

    </html>