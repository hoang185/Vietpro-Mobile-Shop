<?php
if(!defined("SECURITY")){
	die("ban ko co quyen truy cap trang nay");
}
?>
<?php
$prd_id=$_GET['prd_id'];
$sql="SELECT * FROM product WHERE prd_id='$prd_id'";
$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($query);
if(isset($_POST['sbm'])){
    $prd_name=$_POST['prd_name'];
    $prd_price=$_POST['prd_price'];
    $prd_warranty=$_POST['prd_warranty'];
    $prd_accessories=$_POST['prd_accessories'];
    $prd_promotion=$_POST['prd_promotion'];
    $prd_new=$_POST['prd_new'];
    $cat_id=$_POST['cat_id'];
    $prd_status=$_POST['prd_status'];
    $cat_id=$_POST['cat_id'];
    $prd_details=$_POST['prd_details'];
    if(isset($_POST['prd_featured'])){
        $prd_featured=1;
    }else {$prd_featured=0;}
    if($_FILES['prd_image']['name']==""){
        $prd_image=$row['prd_image'];
    }
    else{
        $prd_image=$_FILES['prd_image']['name'];
        $prd_image_tmp=$_FILES['prd_image']['tmp_name'];
        move_uploaded_file($prd_image_tmp,'img/products/'.$prd_image);
    }
    $sql="UPDATE product SET prd_name='$prd_name',prd_price='$prd_price',prd_warranty='$prd_warranty',prd_accessories='$prd_accessories',prd_promotion='$prd_promotion',prd_new=' $prd_new',cat_id=$cat_id,prd_details='$prd_details',prd_image='$prd_image', prd_featured = $prd_featured,prd_status='$prd_status' WHERE prd_id=$prd_id ";
    mysqli_query($conn,$sql);
    header("location:index.php?page_layout=product");
}
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="">Quản lý sản phẩm</a></li>
				<li class="active"><?= $row['prd_name'] ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sản phẩm: Sản phẩm số 1</h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <form role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" name="prd_name" required class="form-control" value="<?= $row['prd_name'] ?>"  placeholder="">
                                </div>
                                                                
                                <div class="form-group">
                                    <label>Giá sản phẩm</label>
                                    <input type="number" name="prd_price" required value="<?= $row['prd_price'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Bảo hành</label>
                                    <input type="text" name="prd_warranty" required value="<?= $row['prd_warranty'] ?>" class="form-control">
                                </div>    
                                <div class="form-group">
                                    <label>Phụ kiện</label>
                                    <input type="text" name="prd_accessories" required value="<?= $row['prd_accessories'] ?>" class="form-control">
                                </div>                  
                                <div class="form-group">
                                    <label>Khuyến mãi</label>
                                    <input type="text" name="prd_promotion" required value="<?= $row['prd_promotion'] ?>" class="form-control">
                                </div>  
                                <div class="form-group">
                                    <label>Tình trạng</label>
                                    <input type="text" name="prd_new" required value="<?= $row['prd_new'] ?>" type="text" class="form-control">
                                </div>  
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh sản phẩm</label>
                                    <input type="file" name="prd_image" required>
                                    <br>
                                    <div>
                                        <img src="img/download.jpeg">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select name="cat_id" class="form-control">
                                    <?php
                                     $sql_cat="SELECT *FROM category ORDER BY cat_id ASC";
                                     $query_cat=mysqli_query($conn,$sql_cat);
                                     while($row_cat=mysqli_fetch_array($query_cat)){
                                    ?>
                                        <option <?php if($row['cat_id']==$row_cat['cat_id']){echo "selected";} ?> value=1><?= $row_cat['cat_name']  ?></option>
                                    <?php } ?>    
                                        
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="prd_status" class="form-control">
                                        <option <?php if($row['prd_status']==1){echo "selected";} ?>  value=1>Còn hàng</option>
                                        <option <?php if($row['prd_status']==0){echo "selected";} ?> value=2>Hết hàng</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Sản phẩm nổi bật</label>
                                    <div class="checkbox">
                                        <label>
                                            <input <?php if($row['prd_featured']==1){echo 'checked';} ?> name="prd_featured" type="checkbox" value="<?php echo $row['prd_featured']; ?>">Nổi bật
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label>Mô tả sản phẩm</label>
                                        <textarea name="prd_details" required class="form-control" rows="3"><?= $row['prd_details'] ?></textarea>
                                        <script>CKEDITOR.replace('$prd_details')</script>
                                    </div>
                                <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
