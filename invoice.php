<?php include 'components/header.php'; 


if(isset($_POST['submit3'])){
header('location:invoice.php');}




            
?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Forms</a> <a href="#" class="current">Invoice Form</a> </div>
  <h1>Invoice Form</h1>
</div>
<div class="container-fluid">
  <hr>
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Form Elements</h5>
        </div>
           
          <div class="widget-content nopadding">
          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           
            <div class="control-group">
              <label class="control-label">Invoice No :</label>
              <div class="controls">
                <input type="text" name="invoice_no" value="<?php echo "" . date("Ym") . ""; ?><?= batch_no()?>" class="datepicker span6">
              </div>

              <label class="control-label">Invoice Date :</label>
              <div class="controls">
                <input type="text" value="<?php echo "" . date("Y-m-d") . ""; ?>" class="datepicker span6">
              </div>
            </div>

            
              <div class="controls">
              <select name="c_code"  class="control-group">
               <option value="" selected disabled>-- select customer code</option>
               <?php
         $select_product = $conn->prepare("SELECT * FROM `customerEntry` WHERE status = ?");
         $select_product->execute(['active']);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){              
      ?>         
                  
                <option value="<?= $fetch_product['c_code']; ?>"> 
                  <?= $fetch_product['c_code']; ?>
                </option>
              
                
                <?php
      } 
   }?>   
              </select><br><br><br>

            </div> 



            <div class="controls">
              <select name="payment" class="control-group">
               <option value="" selected disabled>-- select payment method</option>
               <option value="cash">Cash</option>
               <option value="credit">Credit</option>
            
              </select><br><br><br>

            </div>   

            <div class="control-group">
              <label class="control-label">Delivery Date :</label>
              <div class="controls">
                <input name="rcv_date" type="date" class="datepicker span6">
              </div>
            </div>

        </div> <br>

        <div class="widget-box">

        <div class="form-actions">
              
            </div>

                      <select name="optn">
               <option value="" selected disabled>-- select product code</option>
               <?php
         $select_product = $conn->prepare("SELECT * FROM `productRecv`");
         $select_product->execute([]);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){              
      ?>         
                  
                <option value="<?= $fetch_product['p_code']; ?>"> 
                  <?= $fetch_product['p_code']; ?>
                </option>
              
                
                <?php
      } 
   }?>   
              </select>

              <select name="optn1" >
               <option value="" selected disabled>-- select batch no</option>
               <?php
         $select_product = $conn->prepare("SELECT * FROM `productRecv` ");
         $select_product->execute([]);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){              
      ?>         
                  
                <option value="<?= $fetch_product['batch_no']; ?>"> 
                  <?= $fetch_product['batch_no']; ?>
                </option>
              
                
                <?php
      } 
   }?>   
  </select><input type="text" name="quan" placeholder="Quantity" >
  <input type="text" name="discount" placeholder="Discount" >
  <button type="submit" name="submit2" class="btn btn-primary">Add Prouct(+)</button>

  <table>
  <tr>
    <th>Product Code</th>
    <th>Product Name</th>
    <th>Batch No</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Discount(%)</th>
    <th>Total Amount</th>
  </tr>



  <?php include 'components/calc.php'; ?>
 
  
</table>
</form>
        </div>

        
  </div>
</div>
</div>




<?php include 'components/footer.php'; ?>
