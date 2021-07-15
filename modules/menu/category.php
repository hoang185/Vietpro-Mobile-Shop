<?php
$cat_id = $_GET["cat_id"];
$cat_name = $_GET["cat_name"];
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page=1;
}
$sql_2="SELECT *FROM product WHERE cat_id='$cat_id' ";
$query_2=mysqli_query($conn,$sql_2);
$total_row=mysqli_num_rows($query_2);
$row_per_page=4;
$total_page=ceil($total_row/$row_per_page);
$per_row = $page*$row_per_page - $row_per_page;
$list_page="";
$page_prev=$page-1;
if($page_prev<1){
    $page_prev=1;
}
$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$page_prev.'">Trang trước</a></li>';
for($i=1;$i<=$total_page;$i++){
    if($page==$i){
        $active="active";
    }
    else{
        $active="";
    }
    $list_page.='<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$i.'">'.$i.'</a></li>';
}
$page_next=$page+1;
if($page_next>$total_page){
    $page_next=$total_page;
}
$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='.$cat_name.'&page='.$page_next.'">Trang sau</a></li>';
$sql="SELECT * FROM product WHERE cat_id='$cat_id' LIMIT $per_row,$row_per_page";

$query = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($query);
?>
<!--	List Product	-->
<div class="products">
    <h3><?php echo $cat_name;?> (hiện có <?php echo $rows;?> sản phẩm)</h3>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        if ($i == 0) {
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
            if ($i == 3) {
                $i = 0;
            ?>
            </div>
        <?php
            }
        }
        if ($rows % 3 != 0) {
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