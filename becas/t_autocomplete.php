<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.autocomplete.css">
<script src="./js/jquery.js"></script>
<script src="./js/jquery.autocomplete.js"></script>
<script>
$(document).ready(function(){
	
			function formatItem(row) {
				return  row[0];
			}
			function formatResult(row) {
				return  row[0];
			}


		$("#asegurado").autocomplete(
					'universidad.php', {
						width : 300,
						//multiple : true,
						matchContains : true,
						formatItem : formatItem,
						formatResult : formatResult
					});

		$("#asegurado").result(
					function(event, data, formatted) {
						var hidden = $(this).parent().next().find(">:input");
						hidden.val((hidden.val() ? hidden.val() + ";" : hidden
								.val())
								+ data[1]);
						 console.debug(data[1]);
						
						$("#asegurado_id").val(data[1]);
					});

});
</script>
</head>
<body>
<table>
<tr>
		<td>Cliente:</td>
			<td>
			<input id="asegurado" type="text" name="asegurado"
				value=""></input> 

			<input id="asegurado_id" type="hidden" name="asegurado_id"
				value=""></input>	
			</td>
		</tr>
</table>
</body>
</html>