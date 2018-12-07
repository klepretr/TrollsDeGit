

// List items listeners
var select_modal_offset = 0;
for (var i = 0; i < document.getElementsByClassName("container-list-item").length; i++){
	document.getElementsByClassName("container-list-item")[i].onclick = function(){
		// Remove last focus and focus new
		if (document.getElementsByClassName("container-list-item--active").length){
			document.getElementsByClassName("container-list-item--active")[0].classList.remove("container-list-item--active");
		}
		this.classList += " container-list-item--active";
	
		// Modal display
		select_modal_offset = (this.offsetHeight * this.getAttribute("data-pos"));
		document.getElementsByClassName("container-select_modal")[0].style.display = "block";
		document.getElementsByClassName("container-select_modal")[0].style.top = ( select_modal_offset - document.getElementsByClassName("container-list")[0].scrollTop) + "px";
		document.getElementsByClassName("container-select_modal_info")[0].innerHTML="Name : "+this.getAttribute("data_name")+"<br>Description : "+this.getAttribute("data_description")+"<br>Type : "+this.getAttribute("data_type")+"<br> State : "+this.getAttribute("data_state");
	}
}

// Search list
function search_list(needle){ 
	needle = needle.toLowerCase();

	// Unselect
	document.getElementsByClassName("container-select_modal")[0].style.display = "none";
	if (document.getElementsByClassName("container-list-item--active").length){
		document.getElementsByClassName("container-list-item--active")[0].classList.remove("container-list-item--active");
	}

	// Search
	var pos = 1;
	for (var i = 0; i < document.getElementsByClassName("container-list-item").length; i++){
		if (needle == "" || document.getElementsByClassName("container-list-item-title")[i].innerHTML.toLowerCase().indexOf(needle) != -1 ){
			document.getElementsByClassName("container-list-item")[i].style.display = "block";
			document.getElementsByClassName("container-list-item")[i].setAttribute("data-pos", pos);
			pos ++;
		}else{
			document.getElementsByClassName("container-list-item")[i].style.display = "none";
		}
	}
}

// Search input
document.getElementsByClassName("container-search-input")[0].onkeyup = function(){
	search_list(this.value);
}


// // Canvas onclick listener
// document.getElementsByClassName("container-canvas")[0].onclick = function(event){
// 	// Log click
// 	var x = event.x - this.offsetLeft;
// 	var y = event.y - this.offsetTop;
// 	//console.log(x + " " + y);

// 	// Unselect
// 	document.getElementsByClassName("container-select_modal")[0].style.display = "none";
// 	if (document.getElementsByClassName("container-list-item--active").length){
// 		document.getElementsByClassName("container-list-item--active")[0].classList.remove("container-list-item--active");
// 	}
// }

// Handle focus
document.getElementsByClassName("container-list")[0].onscroll = function(){
	document.getElementsByClassName("container-select_modal")[0].style.top = (53 + select_modal_offset - this.scrollTop) + "px";
}

// Unselect
document.getElementsByClassName("container-select_modal-cross")[0].onclick = function(){
	document.getElementsByClassName("container-select_modal")[0].style.display = "none";
	if (document.getElementsByClassName("container-list-item--active").length){
		document.getElementsByClassName("container-list-item--active")[0].classList.remove("container-list-item--active");
	}
}