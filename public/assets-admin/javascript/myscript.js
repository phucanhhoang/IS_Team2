$('div.alert.alert-success').delay(3000).slideUp();

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
	if(confirm('Hey,man. Do you really want to delete this size ?') == true){
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

