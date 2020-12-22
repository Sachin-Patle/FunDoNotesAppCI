<?php require_once "includes/header.php"; ?>

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
                                        <textarea class="form-control" name="note" cols="35" placeholder="Enter note message here" required></textarea>
                                    </div>
                                    <?php
                                    if(isset($_GET['label_id']))
                                    {
                                        ?>
                                    <div class="form-group">
                                        <input type="hidden" name="label" value="<?php echo $_GET['label'];?>">
                                        <input type="hidden" name="label_id" value="<?php echo $_GET['label_id'];?>">
                                    </div>
                                    <?php
                                    }
                                    ?>
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
                

                    
                    
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            
    <?php require_once "includes/footer.php"; ?>

<!-- PAGE LEVEL SCRIPTS-->
<script>
    $(document).ready(function() {
        setTimeout(function() {
            <?php
            if(isset($_GET['label_id']))
            {
                ?>
                get_notes_by_label(<?php echo $_GET['label_id'];?>);
                <?php
            }
            else{
                ?>
                get_notes();
                <?php
            }
            ?>
            get_labels();
            labels_list_on_form();
        }, 10);

        /**
         * Method when submitting form to save note details
         */
        $("#form_submit").submit(function(event) {
            // Prevent the form from submitting via the browser.
            event.preventDefault();
            submit_note();

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
                url: "<?= site_url('/notes-list') ?>",
                success: function(result) {
                    $('#notes_result').empty();
                    $('#notes_result').html(result);
                    // $.each(result, function(i, list) {
                    //     $('#example-table').append("<div class='col-sm-4'><div class='card'><div class='card-body'><p>ID : " + list._id + "<span class='float-right'><button class='btn btn-info btn-xs'><i class='fa fa-edit'></i></button></span></p><h5 class='card-subtitle mb-2 text-muted'>" + list.message + "</h5><p class='card-text text-right'>- " + list.name + "<p><hr><p class='card-text text-right'>- " + list.date + "<p></div></div></div>")
                    // });
                },
                error: function(e) {
                    $("#getResultDiv").html("<strong>Error</strong>");
                    console.log("ERROR: ", e);
                }
            });
        }
        /**
         * @method - get_notes_by_label
         * @description
         * Method to get and display all note details according to label
         */
        function get_notes_by_label(id) {
            // alert(id);
            $.ajax({
                type: "GET",
                data: {label_id:id},
                url: "<?= site_url('/notes-by-label') ?>",
                success: function(result) {
                    $('#notes_result').empty();
                    $('#notes_result').html(result);
                },
                error: function(e) {
                    $("#getResultDiv").html("<strong>Error</strong>");
                    console.log("ERROR: ", e);
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
                    // $.each(result, function(i, list) {
                    //     $('#example-table').append("<div class='col-sm-4'><div class='card'><div class='card-body'><p>ID : " + list._id + "<span class='float-right'><button class='btn btn-info btn-xs'><i class='fa fa-edit'></i></button></span></p><h5 class='card-subtitle mb-2 text-muted'>" + list.message + "</h5><p class='card-text text-right'>- " + list.name + "<p><hr><p class='card-text text-right'>- " + list.date + "<p></div></div></div>")
                    // });
                },
                error: function(e) {
                    $("#getResultDiv").html("<strong>Error</strong>");
                    console.log("ERROR: ", e);
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
                    // $.each(result, function(i, list) {
                    //     $('#example-table').append("<div class='col-sm-4'><div class='card'><div class='card-body'><p>ID : " + list._id + "<span class='float-right'><button class='btn btn-info btn-xs'><i class='fa fa-edit'></i></button></span></p><h5 class='card-subtitle mb-2 text-muted'>" + list.message + "</h5><p class='card-text text-right'>- " + list.name + "<p><hr><p class='card-text text-right'>- " + list.date + "<p></div></div></div>")
                    // });
                },
                error: function(e) {
                    $("#getResultDiv").html("<strong>Error</strong>");
                    console.log("ERROR: ", e);
                }
            });
        }

        /**
         * @method - get_note_by_id
         * @description
         * Method to get and display all note details
         */
        function get_note_by_id(val) {
            $.ajax({
                type: "POST",
                url: "<?= site_url('/get-note') ?>",
                data : {id:val},
                success: function(result) {
                    $('#notes_result').append(result);
                },
                error: function(e) {
                    $("#getResultDiv").html("<strong>Error</strong>");
                    console.log("ERROR: ", e);
                }
            });
        }

        /**
         * @method - submit_note
         * @description
         * Method to save note
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
                    get_note_by_id(result);
                    $("#form_submit")[0].reset();
                    $('#submitModal').modal('toggle');
                },
                error : function () {
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
        function submit_label()
        {
            var form_data = $('#form_label').serialize();
            
            $.ajax({
                url:"<?= site_url('/save-label') ?>",
                method: "POST",
                data : form_data,
                success : function (result) {
                        get_labels();
                    $("#form_label")[0].reset();
                    $('#labelModal').modal('toggle');
                },
                error : function () {
                    // some error handling part
                    alert("Failed to add label");
                }
            });
        }
    })
</script>

</body>

</html>