<?php
/**
 * Sidebar Template
 *
 * @package NiceHelp
 */

if (!is_active_sidebar('help-sidebar')) {
    return;
}
?>

<aside class="nh-sidebar" role="complementary">
    <?php dynamic_sidebar('help-sidebar'); ?>
</aside>
