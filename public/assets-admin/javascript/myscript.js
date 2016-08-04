$('div.alert').delay(3000).slideUp();

//delete Product
function deletePro(){
	if(confirm('Hey,man. Do you really want to delete this Product ?') == true){
		return true;
	} else {
		return false;
	}
}

//delete Category
function deleteCat(){
	if(confirm('Hey,man. Do you really want to delete this category ?') == true){
		return true;
	} else {
		return false;
	}
}
//delete Size
function deleteSize(){
	if(confirm('Hey,man. Do you really want to delete this cize ?') == true){
		return true;
	} else {
		return false;
	}
}

//delete Color
function deleteColor(){
	if(confirm('Hey,man. Do you really want to delete this color ?') == true){
		return true;
	} else {
		return false;
	}
}

//create a new category
// jQuery(document).ready(function($) {
// 	$('#addCat').click(function(){
// 		$('#parent_cat').append('<input type="text" value = "0" class ="form-control" />');
// 	});
// });

//size
// $(document).ready(function(){
// 	$(".hide_size").hide();
// 	$(".ck_size").hover(function(){
// 	    $(this).children("td:last-child").children().show();
// 	},
// 	function(){
// 	    $(this).children("td:last-child").children().hide();
// 	});
// });



//delete size
function deleteSize(){
	if(confirm("Hey, man. Do you really want to delete this size ?") == true) {
		return true;
	} else {
		return false;
	}
}
//Uploda muliple images
// var form = document.getElementById('upload');
// var request = new XMLHttpRequest();

// form.addEventListener('submit', function(e){
// 	e.preventDefault();
// 	var formdata = new FormData(form);

// 	request.open('post', 'admin/upload/images/details');
// 	request.addEventListener("load", transferComplete);
// 	request.send(formdata);

// });
// function transferComplete(data){
// 	console.log(data.currentTarget.response);
// }

//add more detail images
$(document).ready(function(){  
	var i=1;  
	$('#add').click(function(){  
	   i++;  
	   $('#dynamic_field').append(
	   	'<tr id="row'+i+'"><td><input type="file" name="file[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td><td></td></tr>'
	   );  
	});  
	$(document).on('click', '.btn_remove', function(){  
	   var button_id = $(this).attr("id");   
	   $('#row'+button_id+'').remove();  
	});  
	$('#submit').click(function(){            
	   $.ajax({  
	        url:"name.php",  
	        method:"POST",  
	        data:$('#add_name').serialize(),  
	        success:function(data)  
	        {  
	             alert(data);  
	             $('#add_name')[0].reset();  
	        }  
	   });  
	});  
});  