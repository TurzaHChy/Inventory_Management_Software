<?php include 'components/header.php'; 
  
   if(isset($_POST['submit1'])){
   $p_code = $_POST['p_code'];
   $p_code = filter_var($p_code, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name , FILTER_SANITIZE_STRING);
   $pack_size = $_POST['pack_size'];
   $pack_size = filter_var($pack_size, FILTER_SANITIZE_STRING);
   $batch_no = $_POST['batch_no'];
   $batch_no = filter_var($batch_no, FILTER_SANITIZE_STRING);
   $quan = $_POST['quan'];
   $quan = filter_var($quan, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);

   $add_product = $conn->prepare("INSERT INTO `productRecv`(p_code, p_name, pack_size, batch_no,quan, price ) VALUES(?,?,?,?,?,?)");
   $add_product->execute([$p_code, $p_name, $pack_size, $batch_no, $quan, $price]);

   $message[] = 'new product added!';  

}


?>



<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Forms</a> <a href="#" class="current">Product Receive Form</a> </div>
  <h1>Product Receive Form</h1>
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
              <button type="submit" name="submit1" class="btn btn-success">Save</button>
              <button type="submit" name="submit2" class="btn btn-primary">Search</button>
              <button type="submit" class="btn btn-info">Clear</button>
            </div>
            
            <!--<div class="control-group">
              <label class="control-label">Receive Date</label>
              <div class="controls">
                <input type="text" data-date="01-02-2013" data-date-format="dd-mm-yyyy" value="01-02-2024" class="datepicker span11">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>-->

              <div class="controls">
              <select name="optn"  class="control-group">
               <option value="" selected disabled>-- select product code</option>
               <?php
         $select_product = $conn->prepare("SELECT * FROM `productEntry` WHERE status = ?");
         $select_product->execute(['active']);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){              
      ?>         
                  
                <option value="<?= $fetch_product['p_code']; ?>"> 
                  <?= $fetch_product['p_code']; ?>
                </option>
              
                
                <?php
      } 
   }?>   
              </select><br><br><br>

            </div> 

            <?php
            if(isset($_POST['submit2'])){ 
              $p_code=$_POST['optn'];
              $p_code = filter_var($p_code, FILTER_SANITIZE_STRING);
                 $select_product = $conn->prepare("SELECT * FROM `productEntry` WHERE p_code = ?");
         $select_product->execute([$p_code]);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){              
      ?>         
                  
            <div class="control-group">
              <label class="control-label">Product Code :</label>
              <div class="controls">
                <input type="text" name="p_code" value="<?= $fetch_product['p_code']; ?>"  class="span11">
              </div>
            </div>
              
              <div class="control-group">
              <label class="control-label">Product Name :</label>
              <div class="controls">
                <input type="text" name="p_name" value="<?= $fetch_product['p_name']; ?>"  class="span11">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Pack Size :</label>
              <div class="controls">
                <input type="text" name="pack_size" value="<?= $fetch_product['pack_size']; ?>" class="span11"/>
              </div>
            </div>
            
            <?php 
          }}
            }
            ?>

            <div class="control-group">
              <label class="control-label">Batch No :</label>
              <div class="controls">
                <input type="text" name="batch_no" value="<?= batch_no() ?>" class="span11"/>
              </div>
            </div>



            <div class="control-group">
              <label class="control-label">Quantity :</label>
              <div class="controls">
                <input type="text" name="quan" class="span11"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Price :</label>
              <div class="controls">
                <input type="text" name="price" class="span11" />
              </div>
            </div>
            
            
            
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



<?php include 'components/footer.php'; ?>
