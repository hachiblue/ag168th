
<?php

use Main\ThirdParty\Xcrud\Xcrud;

?>

<style>
    .nav > li.active , .nav > li:hover , .nav > li:focus {
        color: inherit;
        background-color: rgba(0,0,0,.1);
    }
</style>

<div id="content">
	
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">Admin</a></li>
		<li role="presentation"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab">Sales</a></li>
		<li role="presentation"><a href="#marketing" aria-controls="marketing" role="tab" data-toggle="tab">Marketing</a></li>
		<li role="presentation"><a href="#hr" aria-controls="hr" role="tab" data-toggle="tab">HR</a></li>
		<li role="presentation"><a href="#others" aria-controls="others" role="tab" data-toggle="tab">Others</a></li>
	</ul>

	<div class="tab-content">

		<div role="tabpanel" class="tab-pane active" id="admin">
			<?php
			$xcrud = Xcrud::get_instance();
			$xcrud->table('account');
			$xcrud->unset_title();

			$xcrud->where('level_id', array(2, 7));
			$xcrud->fields('created_at, last_login', true);

			$xcrud->order_by('created_at', 'desc');

			// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
			$xcrud->relation('account_status_id', 'account_status', 'id', 'name');
			$xcrud->relation('manager_id', 'account', 'id', 'name', array('level_id' => 7));
			$xcrud->relation('level_id', 'level', 'id', 'name', 'id in (2, 7)');

			// $xcrud->condition('level_id','<=','3','disabled','manager_id');
			// $xcrud->relation('manager_id', 'account', 'id', 'name', 'level_id = 3');

			$xcrud->before_insert("admin_beforeInsert");
			?>
			<h2>Admin</h2>
			<?php echo $xcrud->render(); ?>
		</div>

		<div role="tabpanel" class="tab-pane" id="sales">
			<?php
			$xcrud = Xcrud::get_instance();
			$xcrud->table('account');
			$xcrud->unset_title();

			$xcrud->where('level_id', array(8, 4, 3));
			$xcrud->fields('created_at, last_login', true);
			
			$xcrud->order_by('created_at', 'desc');

			// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
			$xcrud->relation('account_status_id', 'account_status', 'id', 'name');
			$xcrud->relation('manager_id', 'account', 'id', 'name', 'level_id in (8, 3)');
			$xcrud->relation('level_id', 'level', 'id', 'name', 'id in (8, 4)');
			//$xcrud->validation_required('manager_id');

			$xcrud->before_insert("created_at_beforeInsert");
			?>
			<h2>Sale</h2>
			<?php echo $xcrud->render(); ?>
		</div>

		<div role="tabpanel" class="tab-pane" id="marketing">
			<?php
			$xcrud = Xcrud::get_instance();
			$xcrud->table('account');
			$xcrud->unset_title();

			$xcrud->where('level_id', array(9, 5));
			$xcrud->fields('created_at, last_login', true);

			$xcrud->order_by('created_at', 'desc');

			// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
			$xcrud->relation('account_status_id', 'account_status', 'id', 'name');
			$xcrud->relation('manager_id', 'account', 'id', 'name', array('level_id' => 9));
			$xcrud->relation('level_id', 'level', 'id', 'name', 'id in (9, 5)');

			//$xcrud->validation_required('manager_id');

			$xcrud->before_insert("created_at_beforeInsert");
			?>
			<h2>Marketing</h2>
			<?php echo $xcrud->render(); ?>
		</div>

		<div role="tabpanel" class="tab-pane" id="hr">
			<?php
			$xcrud = Xcrud::get_instance();
			$xcrud->table('account');
			$xcrud->unset_title();

			$xcrud->where('level_id', array(6));
			$xcrud->fields('created_at,last_login,level_id', true);
			// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
			$xcrud->relation('account_status_id', 'account_status', 'id', 'name');
			//$xcrud->relation('manager_id', 'account', 'id', 'name', array('level_id' => 9));
			//$xcrud->validation_required('manager_id');

			$xcrud->before_insert("hr_beforeInsert");
			?>
			<h2>HR</h2>
			<?php echo $xcrud->render(); ?>
		</div>

		<div role="tabpanel" class="tab-pane" id="others">
			<?php
			$xcrud = Xcrud::get_instance();
			$xcrud->table('account');
			$xcrud->unset_title();

			$xcrud->where('level_id', array(10));
			$xcrud->fields('created_at, last_login, level_id', true);
			// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
			$xcrud->relation('account_status_id', 'account_status', 'id', 'name');
			//$xcrud->relation('manager_id', 'account', 'id', 'name', array('level_id' => 9));
			//$xcrud->validation_required('manager_id');

			$xcrud->before_insert("others_beforeInsert");
			?>
			<h2>Others</h2>
			<?php echo $xcrud->render(); ?>
		</div>

	</div>
</div>

<script type="text/javascript">
<!--

(function( $ ) {	

	$('.nav-tabs a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

})(jQuery);

//-->
</script>