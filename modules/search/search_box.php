<?php 
// $sql = "SELECT * FROM product
//    WHERE prd_name LIKE '$str_keyword'";
// $query = mysqli_query($conn, $sql);
// $row=mysqli_fetch_array($query);
?>
<div id="search" class="col-lg-6 col-md-6 col-sm-12">
    <form class="form-inline" method="POST" action="index.php?page_layout=search">
        <input name="keyword" class="form-control mt-3" type="search" placeholder="Tìm kiếm" aria-label="Search" required>
        <button class="btn btn-danger mt-3"  type="submit">Tìm kiếm</button>
    </form>
</div>