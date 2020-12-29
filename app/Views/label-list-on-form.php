<?php if ($labels) { ?>
    <table>
        <?php
        $i = 1;
        foreach ($labels as $label) { ?>
            <!-- <div class="form-group">
            <input type="text" class="form-control" value="<?php echo $label['label_name']; ?>">
        </div> -->
        <div class="form-group" id="label<?php echo $label['id']; ?>">
            <div class="input-group">
            <div class="input-group-btn">
                    <button class="btn btn-danger" id="delete_label<?php echo $label['id'];?>" type="button"><i class="fa fa-trash"></i></button>
                </div>
                <input class="form-control" type="text" name="label_name" id="label_name<?php echo $label['id']; ?>" placeholder="Label Title" value="<?php echo $label['label_name']; ?>" readonly>
                <input type="hidden" name="label_id" value="<?php echo $label['id']; ?>" id="label_id<?php echo $label['id']; ?>">
                <div class="input-group-btn">
                    <button class="btn btn-success" id="change_label<?php echo $label['id'];?>" value="<?php echo $label['id'];?>" type="button"><i class="fa fa-pencil"></i></button>
                </div>
            </div>
        </div>

        <script>
                        $(document).ready(function() {
                            /**
                             * Method when click update button to change label
                             */
                            $("#change_label<?php echo $label['id']; ?>").click(function(event) {
                                // Prevent the form from submitting via the browser.
                                event.preventDefault();
                                $("#label_name<?php echo $label['id']; ?>").attr("readonly", false); 
                                $("#label_name<?php echo $label['id']; ?>").attr("required", true); 
                            });
                            /**
                             * Method when change label details from input
                             */
                            $("#label_name<?php echo $label['id']; ?>").change(function(event) {
                                // Prevent the form from submitting via the browser.
                                event.preventDefault();
                                update_label(this.value, <?php echo $label['id']; ?>);
                            });
                            /**
                             * Method when submitting form to delete label details
                             */
                            $("#delete_label<?php echo $label['id']; ?>").click(function(event) {
                                // Prevent the form from submitting via the browser.
                                event.preventDefault();
                                var result = confirm("Are you sure want to delete this label ? "); 
                                if(result == true)
                                {
                                    delete_label();
                                }
                                // get_labels();
                            });
                            /**
                            * @method - update_label
                            * @description
                            * Method to update label details
                            * Getting form data by form id and updating changes according to ObjectId by using ajax
                            */
                            function update_label(val, id) {
                                // var label_name=$("#label_name<?php echo $label['id']; ?>").val();
                                // var label_id=$("#label_id<?php echo $label['id']; ?>").val();
                                $.ajax({
                                    url: "<?= site_url('/update-label') ?>",
                                    method: "POST",
                                    data: {label_id:id, label_name:val},
                                    success: function(result) {
                                        $(".label_list<?php echo $label['id']; ?>").html(val);
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
                                // var form_data = $('#form_delete<?php echo $label['id']; ?>').serialize();
                                var label_id=$("#label_id<?php echo $label['id']; ?>").val();
                                $.ajax({
                                    url: "<?= site_url('/delete-label') ?>",
                                    method: "POST",
                                    data: {label_id:label_id},
                                    success: function(data) {
                                        $("#label<?php echo $label['id']; ?>").remove(); 
                                        $("#label_list<?php echo $label['id']; ?>").remove(); 
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
    </table>
<?php }; ?>