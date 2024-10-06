<?php include 'components/header.php'; ?>



<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Reports</a> <a href="#" class="current">Stock Report</a> </div>
  <h1>Stock Report</h1>
</div>
<div class="container-fluid">
  <hr>
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Table Elements</h5>
        </div>

  <table>
  <tr>
    <th>Product Code</th>
    <th>Product Name</th>
    <th>Pack Size</th>
    <th>Batch No</th>
    <th>Stock Qty</th>
  </tr>

  <tr>
    <?php
 $select_product = $conn->prepare("SELECT * FROM `productRecv`");
                $select_product->execute([]);

         if($select_product->rowCount() >0){
            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){ ?>

    <td> <?= $fetch_product['p_code']; ?></td>
    <td> <?= $fetch_product['p_name']; ?></td>
    <td> <?= $fetch_product['pack_size']; ?></td>
    <td> <?= $fetch_product['batch_no']; ?></td>
    <td> <?= $fetch_product['quan']; ?></td>
  </tr>
 
<?php }}?>
   
</table>

        
  </div>
</div>
</div>






<?php include 'components/footer.php'; ?>