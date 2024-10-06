<?php include 'components/header.php'; 

if(isset($_POST['submit'])){

   $id = unique_id();
   $p_code = $_POST['p_code'];
   $p_code = filter_var($p_code, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name , FILTER_SANITIZE_STRING);
   $pack_size = $_POST['pack_size'];
   $pack_size = filter_var($pack_size, FILTER_SANITIZE_STRING);
   $brand_name = $_POST['brand_name'];
   $brand_name = filter_var($brand_name, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $add_product = $conn->prepare("INSERT INTO `productEntry`(id, p_code, p_name, pack_size, brand_name, status) VALUES(?,?,?,?,?,?)");
   $add_product->execute([$id, $p_code, $p_name, $pack_size, $brand_name, $status]);

   $message[] = 'new product added!';  

}

?>

<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Forms</a> <a href="#" class="current">Product Information Form</a> </div>
  <h1>Product Information Form</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span10">
      
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Form Elements</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="form-actions">
              <input type="submit" value="Save" name="submit" class="btn btn-success">
              <button type="submit" class="btn btn-primary">Search</button>
              <button type="submit" class="btn btn-info">Clear</button>
            </div>
            
            <!--<div class="control-group">
              <label class="control-label">Entry Date</label>
              <div class="controls">
                <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="01-02-2024" class="datepicker span11">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div> -->

            <div class="control-group">
              <label class="control-label">Product Code :</label>
              <div class="controls">
                <input name="p_code" type="text" class="span11"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Product Name :</label>
              <div class="controls">
                <input name="p_name" type="text" class="span11"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Pack Size :</label>
              <div class="controls">
                <input name="pack_size" type="text" class="span11"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Brand Name :</label>
              <div class="controls">
                <input name="brand_name" type="text" class="span11" />
              </div>
            </div>
            
             <div class="controls">
              <select name="status" class="control-group" required>
               <option value="" selected disabled>-- select status</option>
               <option value="active">Active</option>
               <option value="In active">In active</option>
            
              </select><br><br><br>

            </div>          
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>




<?php include 'components/footer.php'; ?>

