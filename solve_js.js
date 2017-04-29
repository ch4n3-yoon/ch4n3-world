

$('#auth').click(function() {
	var flag = $("#flag").val().trim();
	if (flag == "") return;
	$(".alert").hide().show('medium');
	 var url = "./problem.php?no="+no;
	 var params = "flag="+flag+"&no="+no;
	 $.ajax({
		  type: "POST",
		  url: url,
		  data: params,
		  success: function(data) {
			  $("#result").html(data);
			  $("#result").hide().show('medium');
		  }
	 })
});
