
<style type="text/css">

.input-group .form-control {
	padding: 10px;
	height: 35px !important;
}

.inp-topic {
	width: 100%;
}

.mgtb7 {
	margin: 7px 0px;
}

.no-gutter {
	padding-right:0;
	padding-left:0;
}

.no-gutter a {
	width: 100%;
}

.tb-header {
	border-bottom: 2px solid #009688;
}

.wm-bd-row, .vi-bd-row {
	padding: 15px 0;
	border-bottom: 2px solid #c3c3c3;
}

.wm-bx-prop {
	float: left !important;
    margin-right: 10px;
    margin-left: 10px;
	margin-bottom: 5px;
}

.btn-deltopic {
	color: #df314d;
    font-size: 20px;
	cursor:pointer;
}

.btn-deltopic > span:first-child {
	vertical-align: top;
	margin-top: 4px;
}

.btn-delprop {
	background: #eee;
	height: 28px;
	font-size: 12px;
	color: #df314d;
	cursor: pointer;
	border: 1px solid #c3c3c3 !important;
	border-left: 0;
}

.inp-cap {
	height: 35px !important;
	margin-top: 6px;
}


</style>

<div id="content">
	
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Main Page</a></li>
		<li role="presentation"><a href="#investment" aria-controls="investment" role="tab" data-toggle="tab">Investment</a></li>
	</ul>

	<div class="tab-content">

		<div role="tabpanel" class="tab-pane active" id="main">
			<br>
			<div class="col-md-12">
				
				<div class="tb-header">
					<div class="row">
						<div class="col-md-4"><h4>Topic</h4></div>
						<div class="col-md-1"></div>
						<div class="col-md-7"><h4>Room</h4></div>
					</div>
				</div>

				<div id="wmContain" class="tb-body">
					<div class="row wm-bd-row">
						<div class="topicContain col-md-4 mgtb7">
							<div class="btn-deltopic col-md-2" data-wmid="new">
								<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
							</div>
							<div class="col-md-10">
								<input type="text" class="inp-topic form-control" data-wmid="new" value="" placeholder="Topic Name.">
							</div>
						</div>
						<div class="col-md-1 no-gutter">
							<a class="btn-save btn btn-danger btn-xs">Save Change</a>
							<a class="btn-addprop btn btn-primary btn-xs">Add Props</a>
						</div>
						<div class="propContain col-md-7 mgtb7">

							<div class="wm-bx-prop input-group col-md-3">
							  <input type="text" class="inp-props form-control" data-wmid="new" value="" placeholder="REF." aria-describedby="addon1">
							  <span class="btn-delprop input-group-addon" id="addon1"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span>
							</div>

						</div>
					</div>
				</div>

				<div><button id="btn-addmoretopic" class="btn btn-success">Add More Topic</button></div>

			</div>
		</div>

		<div role="tabpanel" class="tab-pane" id="investment">
			<br>
			<div class="col-md-12">
				

				<div id="viContain" class="tb-body">

					<div class="row vi-bd-row">
						<div class="topicContain col-md-4 mgtb7">
							<div class="col-md-10">
								<h4>Project Of The Month</h4>
								<input type="hidden" class="inp-topic" data-ivid="1" value="Project Of The Month">
							</div>
						</div>
						<div class="col-md-1 no-gutter">
							<a class="btn-save-inv btn btn-danger btn-xs">Save Change</a>
						</div>
						<div class="propContain col-md-7 mgtb7" data-prop-contain='1'>

							<div class="wm-bx-prop input-group col-md-3">
								<!-- <input type="text" class="inp-props form-control" data-ivid="1" value="" placeholder="REF." aria-describedby="addon1"> -->

								<select id="proj_of_month" class="inp-props form-control" data-ivid="1">
									<?php
									foreach( $params['extends']['project'] as $pj )
									{
										?>
										<option value="<?=$pj['id'];?>"><?=$pj['name'];?></option>
										<?php
									}
									?>
								</select>
							</div>

						</div>
					</div>

					<div class="row vi-bd-row">
						<div class="topicContain col-md-4 mgtb7">
							<div class="input-group col-md-10">
								<span class="input-group-addon" id="addon1"><h4>Capital Gain</h4></span>
								<input type="text" class="inp-topic inp-cap form-control" data-ivid="2" value="" placeholder="Capital Gain.">
								<span class="input-group-addon" id="addon1"> <h4>%</h4> </span>
							</div>
						</div>
						<div class="col-md-1 no-gutter">
							<a class="btn-save-inv btn btn-danger btn-xs">Save Change</a>
							<a class="btn-addprop btn btn-primary btn-xs">Add Props</a>
						</div>
						<div class="propContain col-md-7 mgtb7" data-prop-contain='2'>

							<div class="wm-bx-prop input-group col-md-3">
							  <input type="text" class="inp-props form-control" data-ivid="2" value="" placeholder="REF." aria-describedby="addon1">
							  <span class="btn-delprop input-group-addon" id="addon1"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span>
							</div>

						</div>
					</div>

					<div class="row vi-bd-row">
						<div class="topicContain col-md-4 mgtb7">
							<div class="input-group col-md-10">
								<span class="input-group-addon" id="addon1"><h4>Rental Yield</h4></span>
								<input type="text" class="inp-topic inp-cap form-control" data-ivid="3" value="" placeholder="Rental Yield.">
								<span class="input-group-addon" id="addon1"> <h4>%</h4> </span>
							</div>
						</div>
						<div class="col-md-1 no-gutter">
							<a class="btn-save-inv btn btn-danger btn-xs">Save Change</a>
							<a class="btn-addprop btn btn-primary btn-xs">Add Props</a>
						</div>
						<div class="propContain col-md-7 mgtb7" data-prop-contain='3'>

							<div class="wm-bx-prop input-group col-md-3">
							  <input type="text" class="inp-props form-control" data-ivid="3" value="" placeholder="REF." aria-describedby="addon1">
							  <span class="btn-delprop input-group-addon" id="addon1"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span>
							</div>

						</div>
					</div>

				</div>

			</div>
		</div>

	</div>
</div>

<script src="<?php echo \Main\Helper\URL::absolute("/public/js/bootstrap.min.js");?>"></script>
<script type="text/javascript">
<!--
	
$('.nav-tabs a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})

var wm = {
	
	constant : {
		LOADING_CIRCLE : '<i class="fa fa-refresh fa-spin"></i>',
		SAVE_ICON : '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>',
		URL : "../api/webmanage",
		URLINV : "../api/webmanage/inv"
	},

	init : function () {
		var self = this;
		
		self.$wmContain = $('#wmContain');
		self.$viContain = $('#viContain');
		self.$propContain = $('.propContain');
		self.$tmpl_bdrow = $('#wmContain > div:first()')[0].outerHTML;
		self.$tmpl_bdrow_vi = $('#viContain');
		self.$tmpl_bxprop = $('#wmContain .wm-bx-prop')[0].outerHTML;
		self.$tmpl_viprop = $('#viContain .wm-bx-prop')[0].outerHTML;
		self.$btn_addmoretopic = $('#btn-addmoretopic');
		self.$btn_deltopic = $('.btn-deltopic');
		self.$btn_addprop = $('.btn-addprop');
		self.$btn_delprop = $('.btn-delprop');
		self.$btn_save = $('.btn-save');
		self.$btn_save_inv = $('.btn-save-inv');

		self.handleEvent();

		self.loadWM(self);
		self.loadVI(self);
	},

	handleEvent : function () {
		var self = this;

		self.$btn_addmoretopic.on('click', function () {
			self.addMoreTP.call(this, self);
		});

		// binding del button
		self.$btn_deltopic.on('click', function () {
			self.delTP.call(this, self);
		});

		// binding del button
		self.$btn_delprop.on('click', function () {
			self.delProp.call(this);
		});

		self.$btn_addprop.on('click', function () {
			self.addProp.call(this, self);
		});
	
		self.$btn_save.on('click', function () {
			self.doSave.call(this, self);
		});

		self.$btn_save_inv.on('click', function () {
			self.doSaveInv.call(this, self);
		});
	},

	re_btnEvent : function () {
		var self = this;

		// binding del button
		self.$btn_deltopic = $('.btn-deltopic');
		self.$btn_deltopic.unbind().on('click', function () {
			self.delTP.call(this, self);
		});

		self.$btn_addprop = $('.btn-addprop');
		self.$btn_addprop.unbind().on('click', function () {
			self.addProp.call(this, self);
		});

		self.$btn_delprop = $('.btn-delprop');
		self.$btn_delprop.unbind().on('click', function () {
			self.delProp.call(this);
		});
		
		self.$btn_save = $('.btn-save');
		self.$btn_save.unbind().on('click', function () {
			self.doSave.call(this, self);
		});

		self.$btn_save_inv = $('.btn-save-inv');
		self.$btn_save_inv.unbind().on('click', function () {
			self.doSaveInv.call(this, self);
		});
	},

	addMoreTP : function (_self) {
		_self.$wmContain.append( _self.$tmpl_bdrow );
		_self.re_btnEvent();
	},

	delTP : function (_self) {
		var $this = $(this);

		$.post(_self.constant.URL + '/delete', { id: $this.data('wmid') }, function(msg) {
			$this.parents('.wm-bd-row').remove();
		});
	},

	addProp : function (_self) {
		_self.$propContain = $(this).parents('.wm-bd-row, .vi-bd-row').find('.propContain');
		_self.$propContain.append( _self.$tmpl_bxprop );
		_self.re_btnEvent();
	},

	delProp : function () {
		$(this).parents('.wm-bx-prop').remove();
	},

	doSave : function (_self) {
		var $this_btn = $(this);
		$this_btn.html(_self.constant.LOADING_CIRCLE);

		var $topic_row = $(this).parents('.wm-bd-row');
		var props = '';
		var props_id = '';

		$topic_row.find('.inp-props').each(function() {
			props += this.value + '#|#';
			props_id += $(this).data('wmid') + '#|#';
		});

		var $topic = $topic_row.find('.inp-topic:first()');
		var param = {
			'topic' : $topic.val(),
			'topic_id' : $topic.data('wmid'),
			'props' : props,
			'props_id' : props_id,
		};

		$.post(_self.constant.URL, param, function(msg) {
			
			setTimeout(function() {
				//$this_btn.html(_self.constant.SAVE_ICON);
				$this_btn.html('SAVE CHANGE');
			}, 100);
		});
		
	},
	
	doSaveInv : function (_self) {
		var $this_btn = $(this);
		$this_btn.html(_self.constant.LOADING_CIRCLE);

		var $topic_row = $(this).parents('.vi-bd-row');
		var props = '';
		var props_id = '';

		$topic_row.find('.inp-props').each(function() {
			props += this.value + '#|#';
			props_id += $(this).data('ivid') + '#|#';
		});

		var $topic = $topic_row.find('.inp-topic:first()');
		var param = {
			'topic' : $topic.val(),
			'topic_id' : $topic.data('ivid'),
			'props' : props,
			'props_id' : props_id,
		};

		$.post(_self.constant.URLINV, param, function(msg) {
			
			setTimeout(function() {
				//$this_btn.html(_self.constant.SAVE_ICON);
				$this_btn.html('SAVE CHANGE');
			}, 100);
		});
		
	},

	loadWM : function (_self) {
		var url = "../api/webmanage";

		$.getJSON(_self.constant.URL, {}, function(msg) {
			
			_self.setformWM(msg);
		});

	},

	loadVI : function (_self) {
		var url = "../api/webmanage/iv";

		$.getJSON(_self.constant.URLINV, {}, function(msg) {
			
			_self.setformVI(msg);
		});

	},

	setformWM : function (ob) {
		var self = this;
		var ref, ref_id, topichtml, propshtml, $topicContain, $propContain, $props, $tmpl, tmp;
		$(ob).each(function(i, o) {

			if( i == 0 && o.id != null )
			{
				$('.wm-bd-row').first().remove();
			}
			
			if( o.id != null )
			{
				$tmpl = $(self.$tmpl_bdrow);
				$topicContain = $tmpl.find('.topicContain');
				$propContain = $tmpl.find('.propContain');
			
				// topic spliter
				topichtml = $topicContain[0].outerHTML.replace(/\"new\"/ig, '"'+o.id+'"').replace('value=""', 'value="'+o.name+'"');
				$topicContain.remove();
				$tmpl.prepend(topichtml);
				
				// property spliter
				ref = (o.ref || '').split(',');
				ref_id = (o.ref_id || '').split(',');
			
				tmp = $propContain.find('.wm-bx-prop:first()');
				tmp = tmp[0].outerHTML;

				$propContain.empty();	// clear property div

				if( ref.length > 0 && ref[0] != '' )
				{
					$(ref).each(function(j, p) {
						$propContain.append( tmp.replace('"new"', '"'+ref_id[j]+'"').replace('value=""', 'value="'+p+'"') );
					});
				}
				else
				{
					$propContain.append( tmp );	// non of property
				}

				self.$wmContain.append( $tmpl[0].outerHTML );
			}

		});

		self.re_btnEvent();
	},

	setformVI : function (ob) {
		var self = this;
		var ref, ref_id, topichtml, propshtml, $topicContain, $propContain, $props, $tmpl, tmp;
		$(ob).each(function(i, o) {

			if( o.id != null )
			{

				$('.inp-cap[data-ivid='+o.id+']').val(o.name);

				$tmpl = $('[data-prop-contain='+ (+i+1) +']');

				tmp = $tmpl.html();
				
				$tmpl.empty();
				
				
				// property spliter
				ref = (o.ref || '').split(',');
				ref_id = (o.ref_id || '').split(',');
				
				$(ref).each(function(j, p) {
			
					$tmpl.append( tmp.replace('value=""', 'value="'+p+'"') );

				});
			}

		});

		$('[data-ivid=1]').val( ob[0].ref );
		$('#proj_of_month').chosen({disable_search_threshold: 10});

		self.re_btnEvent();
	}

};

wm.init();

//-->
</script>