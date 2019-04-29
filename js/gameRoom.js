
function execScript(){
	console.log("bite")
     $.ajax({
       type: "GET",
       url: "",
       data: "name=John&location=Boston&foo=bar",
       success: function(msg){
		   
       }
     });
}