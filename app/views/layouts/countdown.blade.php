<?php $next_day = date('Y/m/d', strtotime(' +1 day')) ?>
<script>
$( document ).ready(function() {
	$('.clock').countdown("<?php echo $next_day; ?>", function(event) {
		var totalHours = event.offset.totalDays * 24 + event.offset.hours;
		$(this).html(event.strftime(totalHours + ':%M:%S'));
	});
});
</script>