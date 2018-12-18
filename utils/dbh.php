<?php 

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $connect = mysqli_connect("localhost", "root", "", "blog_db");

} catch (mysqli_sql_exception $ex) {
    die("Can't connect to the database! \n" . $ex);
}

?>
