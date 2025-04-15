<?php
/**
 * Sidebar Template
 * 
 * Enthält die Widget-Bereiche für die Sidebar
 * 
 * @package MALER_THEME
 */

// Prüfen, ob die Sidebar Widgets enthält
if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php
    // Widget-Bereich anzeigen
    dynamic_sidebar('sidebar-1');
    ?>
</aside> 