$().ready(function(){
	$('#opissueform').validate({
		rules: {
			admno:{
				required: true,
			},
			issue_date:{
				issue_date > Date()
			}
		},
		messages: {
			admno: "Please enter somthing",
			issue_date: "Workds"
		}
	})
});