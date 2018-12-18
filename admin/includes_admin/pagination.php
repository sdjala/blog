<?php
include '../utils/dbh.php';

$results_per_page=2;

$sql="SELECT count(*) AS records_count FROM articles";
$result=mysqli_query($connect, $sql);
$number_of_results = mysqli_fetch_array($result);

$number_of_results = $number_of_results['records_count'];


$number_of_pages = ceil($number_of_results/$results_per_page);

if (!isset($_GET['page'])){
    $page=1;
}else{
    $page=$_GET['page'];
}

$this_page_first_result = ($page-1)*$results_per_page;

$previous_page=$page-1;
$next_page=$page+1;

?>