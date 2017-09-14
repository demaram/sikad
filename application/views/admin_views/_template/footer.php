
<script src="<?=base_url()?>assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/chartist/chartist.min.js"></script>
<script src="<?=base_url()?>assets/js/klorofil.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>/assets/plugins/datatable/media/js/Jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/plugins/datatable/dataTables.css">
<script type="text/javascript" charset="utf8" src="<?=base_url()?>/assets/plugins/datatable/dataTables.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="<?=base_url()?>/assets/plugins/jquery-ui/jquery-ui.js"></script>


<script type="text/javascript">
$(document).ready( function () {
    $('.data_table').DataTable({
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
$(".number").keydown(function (e) {
   // Allow: backspace, delete, tab, escape, enter and .
   if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl/cmd+A
       (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: Ctrl/cmd+C
       (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: Ctrl/cmd+X
       (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right
       (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
   }
   // Ensure that it is a number and stop the keypress
   if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
       e.preventDefault();
   }
});
});
</script>

<script type="text/javascript">
$( function() {
     $( ".datepicker" ).datepicker({
		changeMonth: true,
	     changeYear: true,
          yearRange: "-40:+0"
     });
});
</script>
<script type="text/javascript">
$(function(){
	$('.timepicker').timepicki({
		show_meridian:false,
		min_hour_value:0,
		max_hour_value:23,
		step_size_minutes:5,
		overflow_minutes:true,
		increase_direction:'up',
          start_time: ["06", "00"],
		disable_keyboard_mobile: true
	});
});
</script>


<script>
$(".colorpicker").spectrum({
    color: "#f00",
    showInput: true
});
</script>
