// Entities
var entities = [{"name": "John Doe", "desc": "Currently on mission", "position": [61.5, 48.3, -2.5]},
{"name": "De Izara", "desc": "Definitively on another planet", "position": [61.5, 58.3, -2.5]},
{"name": "First Test", "desc": "Pringles", "position": [61.5, 58.3, -2.5]},
{"name": "Lorem Ipsum", "desc": "Lorem ipsum dolor sit amet", "position": [69.5, 58.3, -2.5]},
{"name": "Badass Rover", "desc": "4x4 rover", "position": [67.5, 58.3, -2.5]},
{"name": "Second Test", "desc": "Lipton", "position": [67.5, 58.3, -2.5]},
{"name": "Twix", "desc": "Mars", "position": [67.5, 58.3, -2.5]},
{"name": "Insa glisse", "desc": "Rien a Foutre", "position": [67.5, 58.3, -2.5]},
{"name": "ON MERGE", "desc": "Encore un test", "position": [67.5, 58.3, -2.5]}];

// Init list
var output = "";
for (var i = 0; i < entities.length; i++){
	output += '<li class="container-list-item" data-id="' + i + '" data-pos="' + i + '">';
		output += '<h3 class="container-list-item-title">' + entities[i]["name"] + '</h3>';
		output += '<span class="container-list-item-subline">' + entities[i]["desc"] + '</span>';
		output += '<a class="container-list-item-button" href="#">Edit</a>';
	output += '</li>';
}
document.getElementsByClassName("container-list")[0].innerHTML = output;

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
		select_modal_offset = (59 * this.getAttribute("data-pos"));
		document.getElementsByClassName("container-select_modal")[0].style.display = "block";
		document.getElementsByClassName("container-select_modal")[0].style.top = (53 + select_modal_offset - document.getElementsByClassName("container-list")[0].scrollTop) + "px";
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
	var pos = 0;
	for (var i = 0; i < document.getElementsByClassName("container-list-item").length; i++){
		if (needle == "" || entities[i]["name"].toLowerCase().indexOf(needle) != -1 || entities[i]["desc"].toLowerCase().indexOf(needle) != -1){
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

// Canvas init - fit 100% to parent (can't do it in CSS bc canvas props are defined in pixels only)
document.getElementsByClassName("container-canvas")[0].style.width = (document.getElementsByClassName("container")[0].parentElement.offsetWidth - document.getElementsByClassName("container-list")[0].offsetWidth) + "px";
document.getElementsByClassName("container-canvas")[0].style.height = document.getElementsByClassName("container")[0].parentElement.offsetHeight + "px";

// Canvas onclick listener
document.getElementsByClassName("container-canvas")[0].onclick = function(event){
	// Log click
	var x = event.x - this.offsetLeft;
	var y = event.y - this.offsetTop;
	console.log(x + " " + y);

	// Unselect
	document.getElementsByClassName("container-select_modal")[0].style.display = "none";
	if (document.getElementsByClassName("container-list-item--active").length){
		document.getElementsByClassName("container-list-item--active")[0].classList.remove("container-list-item--active");
	}
}

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