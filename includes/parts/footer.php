<script type="text/javascript">
	$(document).ready(function(e){
		$('li.dropdown').hover(function(e){
			$(this).find('ul.dropdown-menu').show();
		},
		function(e){
			$(this).find('ul.dropdown-menu').hide();
		});
	});
</script>
</body>
</html>