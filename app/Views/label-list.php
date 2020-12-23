<?php if($labels){ ?>
                    <?php
                    $i=1;
                    foreach($labels as $label){ ?>
                    <a id="label_list<?php echo $label['id']; ?>" href="<?= site_url("/notes?label_id=".$label['id']."&label=".$label['label_name']) ?>"><i class="sidebar-item-icon fa fa-tag"></i>
                            <span class="nav-label label_list<?php echo $label['id']; ?>"><?php echo $label['label_name']; ?></span>
                    </a>
                        <?php
                    $i++;
                    }; ?>
                    <?php }; ?>