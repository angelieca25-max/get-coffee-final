<?php
// Helper file to house centralized database query functions

/**
 * Fetch all menus with their category names using SQL JOIN
 * @param mysqli $connection Database connection
 * @param string $order_by Sorting order (optional, e.g. "menu.id_menu DESC")
 * @return mysqli_result|bool
 */
function get_all_menus_with_categories($connection, $order_by = "") {
    $sql = "SELECT menu.*, categories.category_name 
            FROM menu 
            INNER JOIN categories ON menu.id_category = categories.id_category";
    if (!empty($order_by)) {
        $sql .= " ORDER BY " . $order_by;
    }
    return mysqli_query($connection, $sql);
}

/**
 * Fetch all categories from the database
 * @param mysqli $connection Database connection
 * @param string $order_by Sorting order (optional)
 * @return mysqli_result|bool
 */
function get_all_categories($connection, $order_by = "") {
    $sql = "SELECT * FROM categories";
    if (!empty($order_by)) {
        $sql .= " ORDER BY " . $order_by;
    }
    return mysqli_query($connection, $sql);
}
?>
