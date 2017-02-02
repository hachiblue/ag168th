$(document).ready(function() {

	Date.prototype.addDays = function(days)
	{
		var dat = new Date(this.valueOf());
		dat.setDate(dat.getDate() + days);
		return dat;
	}

	/*mobile Swipe Event */
	$("body").swiperight(function() {  
		console.log("swiperight")
		if($('.ui-datepicker').is(":visible")) {
	  		$(".ui-datepicker-prev").click();  
		}
	});  

   $("body").swipeleft(function() { 
   		if($('.ui-datepicker').is(":visible")) {
	  		$(".ui-datepicker-next").click();  
		}
	});

	/*mobile Swipe Event */	
	var winWid = $(window).width();
	viewportSize(winWid);
	$(window).resize(function(){
		winWid = $(window).width();
		viewportSize(winWid);
	});

	var date1Id = '#dpd1';
	var date2Id = '#dpd2';
	//dateQuery("#dpd1", "#dpd2",2, new Date(), "Departure Date", "Return Date");
	//dateQuery("#dpd5", "#dpd6",2, new Date().addDays(1), "Check-In Date", "Check-Out Date");
	//dateQuery("#dpd3", "#dpd4",2, new Date().addDays(1), "Departure Date", "Return Date");

	startCalendar('.is_datepicker');
	
	function viewportSize(winWid)
	{
		if(winWid < 485){}
		else{}
		$("#dpd1,#dpd2,#dpd3,#dpd4,#dpd5,#dpd6").prop("readonly", true);
	}

	$("#dpd1,#dpd2,#dpd3,#dpd4,#dpd5,#dpd6").focus(function(){
		//alert("focus Called")
		$(".custom-dropdown").removeClass("show");
		$(".filter-list").removeClass("visible").addClass("hide");
	});
	

	function startCalendar(startDateId)
	{
		$( startDateId ).datepicker({
		  defaultDate: "+1w",
		  changeMonth: true,
		  numberOfMonths: 1,
		  minDate: new Date(),
		  maxDate: new Date().addDays(332),
		  dateFormat: "dd/mm/yy",
		  prevText: '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>',
		  nextText: '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>',
		  calTitle: "Select Date",
		  closeText: "X Close",
		  showButtonPanel: true,
		  beforeShow: function(dateText, inst) { 
			$("body").addClass("list-visible");

			},
			onSelect: function(dateText, inst) { 

				//var pickedDate = $(this).datepicker( 'getDate' ); //the getDate method
				//$( endDateId ).datepicker( "option", "minDate", pickedDate.addDays(1));

			},
			onClose: function( selectedDate ) {

				if(startDateId === "#dpd1")
				{
					//$( endDateId ).datepicker( "option", "minDate", (selectedDate == "") ? startDate : selectedDate);
				}

				$("body").removeClass("list-visible");
				//$(endDateId).focus();
			}
		});
	}


	function dateQuery(startDateId, endDateId, noOfmonth, startDate, startLabel, endLabel)
	{
		$( startDateId ).datepicker("destroy");
		$( endDateId ).datepicker( "destroy" );
		var firstPickedDateReturn = false;
		$(startDateId).val(formatDate(startDate));
		$(endDateId).val(formatDate(startDate.addDays(1)));

		$( startDateId ).datepicker({
		  defaultDate: "+1w",
		  changeMonth: true,
		  numberOfMonths: noOfmonth,
		  minDate: startDate,
		  maxDate: new Date().addDays(332),
		  dateFormat: "dd/mm/yy",
		  prevText: '<span class="icon im-long-arrow-left">',
		  nextText: '<span class="icon im-long-arrow-right">',
		  calTitle: startLabel,
		  closeText: "X Close",
		  showButtonPanel: true,
		  beforeShow: function(dateText, inst) { 
			 $("body").addClass("list-visible");
			 
		   },
		   onSelect: function(dateText, inst) { 
			  var pickedDate = $(this).datepicker( 'getDate' ); //the getDate method
			  $( endDateId ).datepicker( "option", "minDate", pickedDate.addDays(1));
		   },
		  onClose: function( selectedDate ) {
			 if(startDateId === "#dpd1")
			 {
				$( endDateId ).datepicker( "option", "minDate", (selectedDate == "") ? startDate : selectedDate);
			 }
			 $("body").removeClass("list-visible");
			$(endDateId).focus();
			
		  }
		});
		
		$( endDateId ).datepicker({
		  defaultDate: "+1w",
		  changeMonth: true,
		  numberOfMonths: noOfmonth,
		  dateFormat: "dd/mm/yy",
		  minDate: startDate,
		  maxDate: new Date().addDays(332),
		  prevText: '<span class="icon im-long-arrow-left">',
		  nextText: '<span class="icon im-long-arrow-right">',
		  calTitle: endLabel,
		  closeText: "X Close",
		  showButtonPanel: true,
		  beforeShow: function(dateText, inst) { 
			 $("body").addClass("list-visible");
		   },
		   onSelect: function(dateText, inst) { 
			 $(".add-persons").focus();
		   },
		  onClose: function( selectedDate ) {
			  //if(firstPickedDateReturn)
				//$( startDateId ).datepicker( "option", "minDate", selectedDate );
				 $("body").removeClass("list-visible");
		  }
		});
	}

	function formatDate(date)
	{
		var d = date;
		var curr_date = d.getDate();
		var curr_month = d.getMonth();
		curr_month++;
		var curr_year = d.getFullYear();
		if(curr_date < 10)
			curr_date = "0"+curr_date
		if(curr_month < 10)
			curr_month = "0"+curr_month
		return curr_date + "/" + curr_month + "/" + curr_year;
	}

});