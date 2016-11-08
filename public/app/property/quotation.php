<?php
session_start();
// if(!(@$_SESSION['login']['level_id'] <= 2 && @$_SESSION['login']['level_id'] > 0)) {
//   return "";
// }
?>

<div ng-controller="QuotCTL">

<div class="row">
	<a href="#list" class="btn btn-primary pull-right">Back</a>
	<button class="btn btn-danger pull-right" onclick="printDiv()">PRINT</button>
	<button class="btn btn-danger pull-right" ng-click="getExcel()">EXCEL</button>
</div>
<div id="printout">
<style>


  .q_header {
    color:#1F497D;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 50px;
  }

  .tl-table {
  	width: 100%;
  	border: 1px solid #95B3D7;
  }

  .q_report {
  	padding: 50px 50px;
  	background: #fff;
  	font-size: 12px;
  }

  .head-table {
	padding: 0;
  	margin-bottom: 50px;
  }

  .qtitle {
  	width: 40%;
  	background-color:#DBE5F1;
  	border-bottom: 1px solid #95B3D7;
	font-weight: bold;
    padding: 3px 10px;
  }

  .qdetail {
  	background: #fff;
  	border-bottom: 1px solid #95B3D7;
  }

  table {
  	width:100%;
  }

  .list-table {
  	margin-bottom: 50px;
  	text-align: center;
  }

  .list-table td{
  	border: 1px solid #4F6128;
  	padding: 10px
  }

  .hd {
  	background: #C2D69B;
  	font-weight: bold;
  }

  .last-sign {
  	width:40%;
  	float:right;
  	font-weight: bold;
  }

  .last-sign td {
  	padding: 10px;
  }

  .san {
  	width: 30%;
  }

  .sgn {
  	width: 70%;
  	border-bottom: 1px solid;
  }

  .bang-table {
  	text-align: center;
  	width: 70%;
  	margin: 50px auto;
  	border:1px solid #548DD4;
  }

  .logo-img {
  	float:right;height: 75px;margin-right: 50px;
  }

@media print {

	body {
		color: #fff;
		background-color: #000;
		font-size: 6pt;
	}

	.qtitle {
		background-color:#DBE5F1;
		border-bottom: 1px solid #95B3D7;
		font-weight: bold;
	}

	.q_header {
		color:#1F497D;
		font-size: 14pt;
		font-weight: bold;
		margin-bottom: 20px;
	}

	.head-table {
		width:50%;
		margin-bottom: 30px;
	}

	.list-table td{
		border: 1px solid #4F6128;
		padding: 5px
	}

	.hd {
		background-color: #C2D69B;
		font-weight: bold;
	}

	.list-table {
		margin-bottom: 20px;
		text-align: center;
	}

	.last-sign {
		width:50%;
	}

	.san {
		width: 40%;
	}

	.bang-table {
		width: 90%;
	}

	.logo-img {
		right: 10px;
		top: 40px;
		position: fixed;
	}
}


</style>

<div class="container" ng-controller="QuotCTL">

	<div id="printSection" class="col-xs-12 q_report">

		<div class="row">
			<div class="col-xs-4 head-table">

				<table class="tl-table  text-center">
					<tr>
						<td class="qtitle">DATE</td>
						<td class="qdetail">&nbsp;</td>
					</tr>
					<tr>
						<td class="qtitle">TIME</td>
						<td class="qdetail">&nbsp;</td>
					</tr>
					<tr>
						<td class="qtitle">Customer name</td>
						<td class="qdetail">&nbsp;</td>
					</tr>
					<tr>
						<td class="qtitle">Contact no.</td>
						<td class="qdetail">&nbsp;</td>
					</tr>
				</table>

			</div>

			<div class="col-xs-4 col-xs-offset-3 text-right">
				<img class="logo-img" src="/public/images/Logo.png">
			</div>
		</div>

		<div class="row">
			<div class="text-center q_header">QUOTATION</div>
		</div>

		<div class="row">
			
			<table class="contain-table" id="testexcel" border='0'>
				<tr ng-repeat="qt in quot">
					<td>
						<table class="list-table">
							<tr class="hd">
								<td colspan='2'>{{qt.list[0].propjectname}}</td>
							</tr>
							<tr class="hd">
								<td>No.<br>ลำดับ</td>
								<td>Address<br>บ้านเลขที่</td>
								<td>Floor<br>ชั้น</td>
								<td>Area (sq.m)<br>พื้นที่ (ตร.ม.)</td>
								<td>TYPE<br>ประเภท</td>
								<td>Bedroom/Bathroom<br>ห้องนอน / ห้องน้ำ</td>
								<td>Price/sqm. (Baht)<br>ราคาต่อตร.ม. (บาท)</td>
								<td>Unit Price (Baht)<br>ราคาสุทธิ (บาท)</td>
								<td>Rent Price (Baht)<br>ราคาสุทธิ (บาท)</td>
							</tr>
							<tr ng-repeat="i in qt.list">
								<td>{{$index + 1}}</td>
								<td>{{i.address_no}}</td>
								<td>{{i.floors}}</td>
								<td>{{i.size}}</td>
								<td>{{i.prop_type}}</td>
								<td>{{i.bedrooms}} / {{i.bathrooms}}</td>
								<td>{{i.sell_price / i.size | number:2}}</td>
								<td>{{i.sell_price | number:2}}</td>
								<td>{{i.rent_price | number:2}}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table class="last-sign">
				<tr>
					<td class="san">Contact Person:</td>
					<td class="sgn">&nbsp;</td>
				</tr>
				<tr><td></td><td>Property Consultant - Sales</td></tr>
				<tr>
					<td class="san">Mobile:</td>
					<td class="sgn">&nbsp;</td>
				</tr>
				<tr>
					<td class="san">Email:</td>
					<td class="sgn">&nbsp;</td>
				</tr>
			</table>
		</div>

		<div class="row">
			<table class="bang-table">
				<tr>
					<td class="">ชื่อบัญชี  Account Name<br><strong>บริษัท เอเจ้นท์168</strong></td>
					<td class="">เลขที่บัญชี  Account No.<br><strong>732-1-02459-3</strong></td>
					<td>สาขา  Branch<br><strong>เดอะมอลล์บางกะปิ</strong></td>
					<td>ประเภทบัญชี<br><strong>กระแสรายวัน</strong></td>
				</tr>
			</table>
		</div>
	</div>	
		
</div>

</div>

</div>

<script>

var printDiv = function () 
{
    var printContents = document.getElementById("printout").innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
};



function exportToExcel()
{
	var htmls = "";
	var uri = 'data:application/vnd.ms-excel;base64,';
	var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'; 
	var base64 = function(s) {
	    return window.btoa(unescape(encodeURIComponent(s)))
	};

	var format = function(s, c) {
	    return s.replace(/{(\w+)}/g, function(m, p) {
	        return c[p];
	    })
	};

	htmls = $("#printSection").html();

	var ctx = {
	    worksheet : 'Worksheet',
	    table : htmls
	}


	var link = document.createElement("a");
	link.download = "quotation.xls";
	link.href = uri + base64(format(template, ctx));
	link.click();
}

</script>