<?php include 'components/header.php'; 

if(isset($_POST['submit'])){

  $id = unique_id();
  $c_code = $_POST['c_code'];
  $c_code = filter_var($c_code, FILTER_SANITIZE_STRING);
  $c_name = $_POST['c_name'];
  $c_name = filter_var($c_name , FILTER_SANITIZE_STRING);
  $adress = $_POST['adress'];
  $adress = filter_var($adress, FILTER_SANITIZE_STRING);
  $phone_no = $_POST['phone_no'];
  $phone_no = filter_var($phone_no, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $status = $_POST['status'];
  $status = filter_var($status, FILTER_SANITIZE_STRING);

  $add_customer = $conn->prepare("INSERT INTO customerentry(id, c_code, c_name, adress, phone_no, email, status) VALUES(?,?,?,?,?,?,?)");
  $add_customer->execute([$id, $c_code, $c_name, $adress, $phone_no, $email,  $status]);

  $message[] = 'new customer added!';  

}

?>




<!--close-left-menu-stats-sidebar-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Forms</a> <a href="#" class="current">Customer Information Form</a> </div>
  <h1>Customer Information Form</h1>
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
              <label class="control-label">Customer Code :</label>
              <div class="controls">
                <input name="c_code" type="text" class="span11"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Customer Name :</label>
              <div class="controls">
                <input name="c_name" type="text" class="span11"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Address :</label>
              <div class="controls">
                <input name="adress" type="text" class="span11"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Phone No :</label>
              <div class="controls">
                <input name="phone_no" type="text" class="span11" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input name="email" type="text" class="span11" />
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
