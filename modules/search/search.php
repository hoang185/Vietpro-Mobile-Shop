<?php
// $keyword=null;
if(isset($_POST["keyword"])){
    $keyword = $_POST["keyword"];
    // $_SESSION['keyword']=$_POST["keyword"];
    // echo $_SESSION['keyword'];
}
// else{
// $keyword=$_SESSION['keyword'];
// }
else{
    header("location:index.php");
}

$arr_keyword = explode(" ", $keyword);
$str_keyword = "%".implode("%", $arr_keyword)."%";

$sql = "SELECT * FROM product
        WHERE prd_name LIKE '$str_keyword'";
$query = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($query);
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page=1;
}
$total_row=mysqli_num_rows($query);
$row_per_page=2;
$total_page=ceil($total_row/$row_per_page);
$per_row = $page*$row_per_page - $row_per_page;
$list_page="";
$page_prev=$page-1;
if($page_prev<1){
    $page_prev=1;
}
$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=search&prd_name='.$keyword.'&page='.$page_prev.'">Trang trước</a></li>';
for($i=1;$i<=$total_page;$i++){
    if($page==$i){
        $active="active";
    }
    else{
        $active="";
    }
    $list_page.='<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=search&prd_name='.$keyword.'&page='.$i.'">'.$i.'</a></li>';
}
$page_next=$page+1;
if($page_next>$total_page){
    $page_next=$total_page;
}
$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=search&prd_name='.$keyword.'&page='.$page_next.'">Trang sau</a></li>';
$sql_2 = "SELECT * FROM product
        WHERE prd_name LIKE '$str_keyword' LIMIT $per_row,$row_per_page";
$query_2 = mysqli_query($conn, $sql_2);      
?>
<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $total_row.' '.$keyword;?></span></div>
    <?php
    $i=0;
    while($row=mysqli_fetch_array($query_2)){
        if($i==0){
    ?>
    <div class="product-list card-deck">
    <?php
        }
    ?>
        <div class="product-item card text-center">
            <a href="index.php?page_layout=product&prd_id=<?php echo $row["prd_id"];?>"><img src="admin/img/products/<?php echo $row["prd_image"];?>"></a>
            <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row["prd_id"];?>"><?php echo $row["prd_name"];?></a></h4>
            <p>Giá Bán: <span><?php echo $row["prd_price"];?>đ</span></p>
        </div>
    <?php
    $i++;
    if($i==3){
        $i=0;
    ?>
        </div>
    <?php
    }
    }
    if($rows%3!=0){
    ?>
        </div>
    <?php
    }
    ?>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
       <?= $list_page ?>
    </ul>
</div>