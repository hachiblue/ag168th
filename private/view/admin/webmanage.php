
<style type="text/css">

.input-group .form-control {
	padding: 10px;
}

.mgtb7 {
	margin: 7px 0px;
}

.no-gutter {
	padding-right:0;
	padding-left:0;
}

.tb-header {
	border-bottom: 2px solid #009688;
}

.wm-bd-row {
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

.btn-save {
	background: #eee;
	height: 28px;
	font-size: 12px;
	color: #009688;
	cursor: pointer;
	border: 1px solid #c3c3c3 !important;
	border-left: 0;
}

</style>

<div id="content">

	<div class="col-md-12">
		
		<div class="tb-header">
			<div class="row">
				<div class="col-md-3"><h4>Topic</h4></div>
				<div class="col-md-1"></div>
				<div class="col-md-8"><h4>Room</h4></div>
			</div>
		</div>

		<div id="wmContain" class="tb-body">
			<div class="row wm-bd-row">
				<div class="col-md-3 mgtb7">
					<div class="btn-deltopic col-md-2">
						<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
					</div>
					<div class="col-md-10">
						<div class="input-group">
							<input type="text" class="inp-topic form-control" data-wmid="new" value="" placeholder="Topic Name.">
							<span class="btn-save input-group-addon">
								<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-1 no-gutter">
					<a class="btn-addprop btn btn-primary btn-xs">Add Props</a>
				</div>
				<div class="propContain col-md-8 mgtb7">

					<div class="wm-bx-prop input-group col-md-2">
					  <input type="text" class="inp-props form-control" data-wmid="new" value="" placeholder="REF." aria-describedby="addon1">
					  <span class="btn-delprop input-group-addon" id="addon1"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></span>
					</div>

				</div>
			</div>
		</div>

		<div><button id="btn-addmoretopic" class="btn btn-success">Add More Topic</button></div>

	</div>

</div>

<script src="<?php echo \Main\Helper\URL::absolute("/public/js/bootstrap.min.js");?>"></script>
<script type="text/javascript">
<!--
	
var wm = {
	
	constant : {
		LOADING_CIRCLE : '<i class="fa fa-refresh fa-spin"></i>',
		SAVE_ICON : '<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>'
	},

	init : function () {
		var self = this;
		
		self.$wmContain = $('#wmContain');
		self.$propContain = $('.propContain');
		self.$tmpl_bdrow = $('#wmContain > div:first()')[0].outerHTML;
		self.$tmpl_bxprop = $('#wmContain .wm-bx-prop')[0].outerHTML;
		self.$btn_addmoretopic = $('#btn-addmoretopic');
		self.$btn_deltopic = $('.btn-deltopic');
		self.$btn_addprop = $('.btn-addprop');
		self.$btn_delprop = $('.btn-delprop');
		self.$btn_save = $('.btn-save');

		self.handleEvent();

		self.loadWM();
	},

	handleEvent : function () {
		var self = this;

		self.$btn_addmoretopic.on('click', function () {
			self.addMoreTP.call(this, self);
		});

		// binding del button
		self.$btn_deltopic.on('click', function () {
			self.delTP.call(this);
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
	},

	re_btnEvent : function () {
		var self = this;

		// binding del button
		self.$btn_deltopic = $('.btn-deltopic');
		self.$btn_deltopic.unbind().on('click', function () {
			self.delTP.call(this);
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
	},

	addMoreTP : function (_self) {
		_self.$wmContain.append( _self.$tmpl_bdrow );
		_self.re_btnEvent();
	},

	delTP : function () {
		$(this).parents('.wm-bd-row').remove();
	},

	addProp : function (_self) {
		_self.$propContain = $(this).parents('.wm-bd-row').find('.propContain');
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

		var url = "../api/webmanage";

		$.post(url, param, function(msg) {
			
			setTimeout(function() {
				$this_btn.html(_self.constant.SAVE_ICON);
			}, 100);
		});
		
	},

	loadWM : function () {
		var self = this;
		var url = "../api/webmanage";

		$.getJSON(url, {}, function(msg) {
			
			self.setformWM(msg);
		});

	},

	setformWM : function (ob) {
		var self = this;
		var ref, ref_id;
		$(ob).each(function(i, o) {

			if( i == 0 )
			{
				$('.wm-bd-row').first().remove();
			}
			
			if( o.id != null )
			{
				self.$wmContain.append( self.$tmpl_bdrow.replace('"new"', '"'+o.id+'"').replace('value=""', 'value="'+o.name+'"') );

				ref = (o.ref || '').split(',');
				ref_id = (o.ref_id || '').split(',');

				$(ref).each(function(j, p) {
					console.log(p);
				});
			}

		});

		self.re_btnEvent();
	}

};

wm.init();

//-->
</script>