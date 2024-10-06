<?php include 'components/header.php'; 

if(isset($_POST['submit3'])){
header('location:productReceive.php');}
?>


<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Reports</a> <a href="#" class="current">Invoice Report</a> </div>
  <h1>Invoice Report</h1>
</div>
<div class="container-fluid">
  <hr>
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Form Elements</h5>
        </div>
           
          <div class="widget-content nopadding">
          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="form-actions">
              <h4>Master Information:</h4>
              <button type="submit" name="submit2" class="btn btn-primary">Search</button>
              <button type="submit" nname="submit3" class="btn btn-info">Clear</button>
            </div>
           
              <div class="controls">
              <select name="optn" class="control-group">
               <option value="" selected disabled>-- select invoice no</option>
               <?php
         $select_product = $conn->prepare("SELECT * FROM `invoiceMaster` ");
         $select_product->execute([]);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){              
      ?>         
                  
                <option value="<?= $fetch_product['invoice_no']; ?>"> 
                  <?= $fetch_product['invoice_no']; ?>
                </option>
              
                
                <?php
      } 
   }?>   
              </select><br><br><br>

            </div> 

            <?php
            if(isset($_POST['submit2'])){ 
              $invoice_no=$_POST['optn'];
              $invoice_no = filter_var($invoice_no, FILTER_SANITIZE_STRING);
              $select_product = $conn->prepare("SELECT * FROM `invoiceMaster` WHERE invoice_no = ?");
         $select_product->execute([$invoice_no]);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){              
      ?>         
                  
            <div class="control-group">
              <label class="control-label">invoice date :</label>
              <div class="controls">
                <input type="text" name="p_code" value="<?= $fetch_product['date']; ?>"  class="span11">
              </div>
            </div>
              
              <div class="control-group">
              <label class="control-label">Customer Code :</label>
              <div class="controls">
                <input type="text" name="p_name" value="<?= $fetch_product['c_code']; ?>"  class="span11">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Paid in :</label>
              <div class="controls">
                <input type="text" name="pack_size" value="<?= $fetch_product['payment']; ?>" class="span11"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Delivery Date:</label>
              <div class="controls">
                <input type="text" name="batch_no" value="<?= $fetch_product['rcv_date']; ?>" class="span11"/>
              </div>
            </div>
            
            <?php 
          }}
            }
            ?>

        
        </div> <br>

        <div class="form-actions">
              <h4>Product Information:</h4>
        </div>
          <table>
  <tr>
    <th>Product Code</th>
    <th>Batch No</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Discount(%)</th>
    <th>Total Amount</th>
  </tr>


<?php 
$select_product = $conn->prepare("SELECT * FROM `invoiceMaster` join `invoiceDtail` WHERE `invoiceMaster`.invoice_no =`invoiceDtail`.sl ");
$select_product->execute([]);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){ ?>

<tr>
            <td type="text" name="p_code"> <?= $fetch_product['p_code']; ?></td>
            
            
            <td type="text" name="batch_no"> <?= $fetch_product['batch_no']; ?> </td>

            <td type="text" name="price" > <?= $fetch_product['price']; ?></td>

          <?php }}
              $select = $conn->prepare("SELECT * FROM `invoiceDtail` WHERE sl = ?");
                $select->execute([$invoice_no]);

         if($select->rowCount() >0){
            while($fetch = $select->fetch(PDO::FETCH_ASSOC)){  ?>

              <td type="text" name="quantity"> <?= $fetch['quan'] ?></td>

            <td  type="text" name="discount"> <?= $fetch['discount'] ?></td>

            <td type="text" name="display"> <?= $fetch['total'] ?> </td> 
</tr>
<?php
            }
          }
  ?>
   
</table>


  </form>
  </div>
</div>
</div>




<?php include 'components/footer.php'; ?>

