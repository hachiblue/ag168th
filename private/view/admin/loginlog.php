<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.css");?>">
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/css/bootstrap-datepicker3.min.css");?>">

<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-route/angular-route.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>

<div>
  <div>
    <form class="form">
      <div class="row">
        <div class="col-md-4">
          <label>Date</label>
          <div class="row">
            <div class="col-md-5"><input type="text" class="form-control"></div>
            <div class="col-md-6"><input type="text" class="form-control"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <button type="submit" class="btn btn-success">Filter</button>
      </div>
    </form>
  </div>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>DateTime</th>
          <th>Account</th>
          <th>level</th>
        </tr>
      </thead>
      <tbody>
        <?php for($i = 0; $i < 10; $i++){?>
        <tr>
          <td>01/01/2015 05:10</td>
          <td>test@test.com</td>
          <td>Sale</td>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
</div>
