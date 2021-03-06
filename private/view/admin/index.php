<?php

$this->import("/admin/layout/header");

?>

<div class="container">
		
	<?php
	/** 
	 * LEFT SIDEBAR 
	 */
	?>
	<div id="sidebar">
		<ul>
			<?=$params['menulist'];?>
		</ul>
	</div>

	<div class="main-content">
		<!-- <div class="swipe-area"></div> -->
		<a href="" data-toggle=".container" id="sidebar-toggle">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</a>
		<?php
		use Main\DB\Medoo\MedooFactory;
		$db = MedooFactory::getInstance();
		$item = array();

		if( $_SESSION["login"]["username"] == 'somporn' )
		{
			$sql = "SELECT COUNT(p.id) AS cnt FROM property p WHERE p.property_status_id = 10 AND p.property_pending_date > '0000-00-00' AND p.property_pending_date <= now() ORDER BY p.property_pending_date ";  
		}
		else
		{
			$sql = "SELECT COUNT(p.id) AS cnt FROM property p WHERE p.property_status_id = 10 AND p.property_pending_date > '0000-00-00' AND p.property_pending_date <= now() AND p.id IN (SELECT property_id FROM property_comment WHERE comment_by = '".$_SESSION['login']['id']."' GROUP BY property_id) ORDER BY p.property_pending_date ";   
		}
	   
		$r = $db->query($sql);
		$istatus = $r->fetch(\PDO::FETCH_ASSOC);

		$sql = "SELECT COUNT(id) AS cnt FROM enquiry_comment WHERE user_remind = '".$_SESSION['login']['id']."' AND read_status = 'noread'  ";   
		$r = $db->query($sql);
		$iremind = $r->fetch(\PDO::FETCH_ASSOC);


		/** 
		 * TOP NAVBAR
		 */
		?>
		<div class="navbar">
			<ul class="nav navbar-nav navbar-right">
				<?php
				if( $_SESSION['login']['level_id'] == 2 || /* Admin */
					$_SESSION['login']['level_id'] == 4 || /* Sale */
					$_SESSION['login']['level_id'] == 5 || /* Marketing */
					$_SESSION['login']['level_id'] == 6 || /* HR */
					$_SESSION['login']['level_id'] == 7 || /* Admin Manager */
					$_SESSION['login']['level_id'] == 8 || /* Sale Manager */
					$_SESSION['login']['level_id'] == 9    /* Marketing Manager */
				  )
				{
					$date_expire_mx = 15;
					$sql_sale = '';

					if( $_SESSION['login']["level"]["id"] == 4 )
					{
						$date_expire_mx = 5;
						$sql_sale = " WHERE comment_by = " . $_SESSION['login']["id"];
					}
					
					$sql = "SELECT 
							  count(e.id) as total
							FROM
							  enquiry e, enquiry_type et, enquiry_status es, size_unit su, requirement rq, account a1, account a2, project pj,
							  ( SELECT enquiry_id, MAX(updated_at) AS mx  FROM enquiry_comment  ".$sql_sale." GROUP BY enquiry_id ORDER BY  mx DESC ) em 
							WHERE e.id = em.enquiry_id 
							  AND e.enquiry_type_id = et.id
							  AND e.enquiry_status_id = es.id
							  AND e.size_unit_id = su.id
							  AND e.requirement_id = rq.id
							  AND e.assign_sale_id = a1.id
							  AND e.assign_manager_id = a2.id
							  AND e.project_id = pj.id
							  AND DATEDIFF(NOW(), em.mx) > ".$date_expire_mx." 
							  AND e.enquiry_status_id IN (1, 2, 3, 5, 14) "; 

					$r = $db->query($sql);
					$cnt = $r->fetch(\PDO::FETCH_ASSOC);
					?>
					<li>
						<a class="bell-alert" id="open-warning" data-toggle="modal" data-target="#warning-model" style="cursor:pointer; font-size:20px;"><span class="glyphicon glyphicon-calendar"></span><span>[<?=$cnt['total'];?>]</span></a>
					</li>
					<?php
				}
				
				/**
				 * user reminder
				 */
				$dsp_iremind = 'hide';
				if( $iremind["cnt"] > 0 )
				{
					$dsp_iremind = 'show';
					?>
					<li>
						<a class="bell-alert" id="open-userremind" data-toggle="modal" data-target="#userremind-model" style="cursor:pointer; font-size:20px;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span>[<?=$iremind["cnt"];?>]</span></a>
					</li>
					<?php
				}

				if( $_SESSION['login']['level_id'] == 1 || /* System Admin */
					$_SESSION['login']['level_id'] == 2 || /* Admin */
					$_SESSION['login']['level_id'] == 5 || /* Marketing */
					$_SESSION['login']['level_id'] == 6 || /* HR */
					$_SESSION['login']['level_id'] == 7 || /* Admin Manager */
					$_SESSION['login']['level_id'] == 8 || /* Sale Manager */
					$_SESSION['login']['level_id'] == 9    /* Marketing Manager */
				  )
				{
					?>
					<li>
						<a class="bell-alert" id="open-pending" data-toggle="modal" data-target="#pending-model" style="cursor:pointer; background: red;color:#fff; font-size:20px;"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> <span>[<?=$istatus["cnt"];?>]</span></a>
					</li>
					<?php
				}
				
				$sess_login_name = $_SESSION['login']['level']['name'];
				
				// for speacial user : Nitcha_mg
				if( isset($_SESSION['login']['id']) && $_SESSION['login']['id'] == 71 )
				{
					$sess_login_name = 'Manager';
				}
				?>
				<li>
					<a href="/admin/profile#/<?=$_SESSION['login']['id'];?>"><?php echo $_SESSION['login']['email'];?> [<?php echo $sess_login_name;?>]</a>
				</li>

				<!-- <li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Separated link</a></li>
				  </ul>
				</li> -->

		  </ul>
		</div>

		
		<?php
		/** 
		 * CONTENT BODY
		 */
		?>
		<div class="content">
			<?php

				// default page
				if ( empty($params['view']) ) 
				{
					$this->import("/admin/enquiries");
				} 
				else 
				{
					$this->import("/admin/" . $params['view']);
				}

			?>
		</div>


	</div>

</div>


<script type="text/javascript">
<!--

var closeModel = function ()
{
	$("#pending-model").removeClass('show').addClass('hide');
	$("#userremind-model").removeClass('show').addClass('hide');
	$("#warning-model").removeClass('show').addClass('hide');
};

var openModel = function ()
{
	$("#pending-model").removeClass('hide').addClass('show');
};

(function( $ ) {

	$(function() {

		$("[data-toggle]").click(function (e) {
			e.preventDefault();
			var toggle_el = $(this).data("toggle");
			$(toggle_el).toggleClass("open-sidebar");
			return false;
		});

		$("#open-pending").click(function() {
			$("#pending-model").toggleClass('show');
		});

		$("#open-userremind").click(function() {
			$("#userremind-model").toggleClass('show');
		});

		$("#open-warning").click(function() {
			$("#warning-model").toggleClass('show');
		});

		$("button[name=model-dismiss]").click(function() {
			closeModel();
		});

		$("button[name=model-dismiss-plan]").click(function() {
			$("#plan_model").removeClass('show').addClass('hide');
		});

	});

})(jQuery);

//-->
</script>


<!-- Modal -->
<div class="modal hide" id="pending-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: scroll;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" name="model-dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Properties Pending</h4>
      </div>
      <div class="modal-body">
        
        <?php
        if( $_SESSION["login"]["username"] == 'somporn' )
        {
            $sql = "SELECT p.*  FROM property p WHERE p.property_status_id = 10 AND p.property_pending_date > '0000-00-00' AND p.property_pending_date <= now()  ORDER BY p.property_pending_date ";  
        }
        else
        {
            $sql = "SELECT 
                  p.*
                FROM
                  property p 
                WHERE p.property_status_id = 10 
                  AND p.property_pending_date > '0000-00-00'
                  AND p.property_pending_date <= now()
                  AND p.id IN 
                  (SELECT 
                    property_id 
                  FROM
                    property_comment 
                  WHERE comment_by = '".$_SESSION['login']['id']."'
                  GROUP BY property_id)
                  ORDER BY p.property_pending_date ";   
        }

        $r = $db->query($sql);
        $items = $r->fetchAll(\PDO::FETCH_ASSOC);
        ?>
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Create Date</th>
                <th>Update Date</th>
                <th>Pending Date</th>
                <th>Admin</th>
                <th>LINK</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach( $items as $item )
            {
				?>
				<tr>
					<td><?=$item["reference_id"];?></td>
					<td><?=$item["created_at"];?></td>
					<td><?=$item["updated_at"];?></td>
					<td><?=$item["property_pending_date"];?></td>
					<td><?=getuseradmin($item["id"], $db);?></td>
					<td><a class="btn btn-info" href="properties#/edit/<?=$item["id"];?>" target="_blank">View</a></td>
				</tr>
				<?php
            }

            function getuseradmin($id, $db)
            {   
                $sql = " SELECT a.name FROM property p , property_comment c, account a WHERE p.id = '".$id."'  AND p.id = c.property_id AND c.comment_by = a.id ORDER BY c.updated_at DESC LIMIT 1";  

                $r = $db->query($sql);
                $items = $r->fetch(\PDO::FETCH_ASSOC);

                return $items['name'];
            }

            ?>
            </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" name="model-dismiss" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal <?=$dsp_iremind;?>" id="userremind-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: scroll;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" name="model-dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">User #</h4>
      </div>
      <div class="modal-body">
        
        <?php
        $sql = "SELECT 
              *
            FROM
              enquiry_comment
            WHERE user_remind = '".$_SESSION['login']['id']."' AND read_status = 'noread'  ";   
           
        $r = $db->query($sql);
        $items = $r->fetchAll(\PDO::FETCH_ASSOC);
        ?>
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Enquiry Id</th>
                <th>Uploaded</th>
                <th>LINK</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach( $items as $item )
            {
				?>
				<tr>
					<td><?=$item["enquiry_id"];?></td>
					<td><?=$item["updated_at"];?></td>
					<td><a class="btn btn-info" href="enquiries#/edit/<?=$item["enquiry_id"];?>" target="_blank">View</a></td>
				</tr>
				<?php
            }

            ?>
            </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" name="model-dismiss" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php
if( $_SESSION['login']['level_id'] == 2 || /* System Admin */ 
	$_SESSION['login']['level_id'] == 4 || /* Sale */
	$_SESSION['login']['level_id'] == 5 || /* Marketing */
	$_SESSION['login']['level_id'] == 6 || /* HR */
	$_SESSION['login']['level_id'] == 7 || /* Admin Manager */
	$_SESSION['login']['level_id'] == 8 || /* Sale Manager */
	$_SESSION['login']['level_id'] == 9    /* Marketing Manager */
  )
{
    ?>
	<div class="modal hide" id="warning-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: scroll;">
	  <div class="modal-dialog modal-lg" role="document" style="width: 90%;">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" name="model-dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Last update over <?=$date_expire_mx;?> days #</h4>
		  </div>
		  <div class="modal-body">
			
			<?php

			$sql = "SELECT 
					  e.*, a1.name as sale_name, a2.name as manager_name, pj.name as project_name, et.name as enquiry_type_name, es.name as enquiry_status_name, rq.name_for_enquiry
					FROM
					  enquiry e, enquiry_type et, enquiry_status es, size_unit su, requirement rq, account a1, account a2, project pj,
					  ( SELECT enquiry_id, MAX(updated_at) AS mx  FROM enquiry_comment ".$sql_sale."   GROUP BY enquiry_id ORDER BY  mx DESC ) em 
					WHERE e.id = em.enquiry_id 
					  AND e.enquiry_type_id = et.id
					  AND e.enquiry_status_id = es.id
					  AND e.size_unit_id = su.id
					  AND e.requirement_id = rq.id
					  AND e.assign_sale_id = a1.id
					  AND e.assign_manager_id = a2.id
					  AND e.project_id = pj.id
					  AND DATEDIFF(NOW(), em.mx) > ".$date_expire_mx." 
					  AND e.enquiry_status_id IN (1, 2, 3, 5, 14)
					ORDER BY em.mx ASC LIMIT 500 ";   
			   
			$r = $db->query($sql);
			$items = $r->fetchAll(\PDO::FETCH_ASSOC);

			//print_r($items);

			?>
			<table class="table table-striped table-hover ">
				<thead>
				<tr>
					<th>Enquiry no</th>
					<th>Created</th>
					<th>Assign to</th>
					<th>Customer</th>
					<th>Project</th>
					<th>Requirement</th>
					<th>Enquiry Type</th>
					<th>Buying Budget</th>
					<th>Rental Budget</th>
					<th>Status</th>
					<th>Updated</th>
					<th>LINK</th>
				</tr>
				</thead>
				<tbody>
				<?php
				foreach( $items as $item )
				{
				?>
				<tr>
					<td><?=$item["id"];?></td>
					<td><?=$item["created_at"];?></td>
					<td><?php if(@$_SESSION['login']['level_id'] <= 2){ ?>
					<strong>Manager</strong>: <?=$item["manager_name"];?>
					<?php } ?>
					<strong>Sale</strong>: <?=$item["sale_name"];?></td>
					<td><?=$item["customer"];?></td>
					<td><?=$item["project_name"];?></td>
					<td><?=$item["name_for_enquiry"];?></td>
					<td><?=$item["enquiry_type_name"];?></td>
					<td>฿<?=$item["buy_budget_start"];?> - <?=$item["buy_budget_end"];?></td>
					<td>฿<?=$item["rent_budget_start"];?> - <?=$item["rent_budget_end"];?></td>
					<td><?=$item["enquiry_status_name"];?></td>
					<td><?=$item["updated_at"];?></td>
					<td><a class="btn btn-info" href="enquiries#/edit/<?=$item["id"];?>" target="_blank">View</a></td>
				</tr>
				<?php
				}

				?>
				</tbody>
			</table>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" name="model-dismiss" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
    <?php
}


if( $_SESSION['login']['level_id'] == 4 || $_SESSION['login']['level_id'] == 8 )
{
	?>
	<!-- Modal -->
	<div class="modal hide" id="plan_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: scroll;">
		<div class="modal-dialog modal-lg" role="document" style="width: 90%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" name="model-dismiss-plan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Plan Alert</h4>
				</div>
				<div class="modal-body">

					<div style="overflow-x: auto;">
						<table class="table table-striped table-hover ">
							<thead>
								<tr>
									<th>no.</th>
									<th>Enquiry no.</th>
									<th>Name</th>
									<th>Plan</th>
									<th>Status</th>
									<th>Updated At</th>
								</tr>
							</thead>
							<tbody>
							<?php

							$sql = "SELECT ec.*, e.enquiry_no, e.enquiry_status_id, es.name as status_name, e.customer as customer FROM enquiry e, enquiry_comment ec, enquiry_status es WHERE e.id = ec.enquiry_id AND e.enquiry_status_id = es.id AND e.enquiry_status_id NOT IN('6','4', '10', '9') AND ec.comment_by = '".$_SESSION["login"]["id"]."' AND ec.plan != '' AND ec.updated_at >= DATE_ADD(CURDATE(), INTERVAL -5 DAY) limit 100";
							$r = $db->query($sql);

							$row = $r->fetchAll(\PDO::FETCH_ASSOC);

							foreach( $row as $i => $rw )
							{
								?>
								<tr>
									<td><?=($i+1);?></td>
									<td><?=$rw['enquiry_no'];?></td>
									<td><?=$rw['customer'];?></td>
									<td><?=$rw['plan'];?></td>
									<td><?=$rw['status_name'];?></td>
									<td><?=$rw['updated_at'];?></td>
								</tr>
								<?php
							}
							?>
							</tbody>
						</table>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" name="model-dismiss-plan" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<?php 
}


$this->import("/admin/layout/footer");

?>