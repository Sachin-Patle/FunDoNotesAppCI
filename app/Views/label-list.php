<?php if($labels){ ?>
                    <?php
                    $i=1;
                    foreach($labels as $label){ ?>
                    <a href="<?= site_url("/notes?label_id=".$label['id']."&label=".$label['label_name']) ?>"><i class="sidebar-item-icon fa fa-tag"></i>
                            <span class="nav-label"><?php echo $label['label_name']; ?></span>
                    </a>
                        <?php
                    $i++;
                    }; ?>
                    <?php }; ?>