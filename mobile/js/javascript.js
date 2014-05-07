function changePage(page,reverse){

	//$('#custom_title').text(btnObj);

    $.mobile.changePage( page, {

        transition: "slide",

        reverse: reverse,

        changeHash: true,

    });	

}



function changeTitle(btnTitle){

	$('#page_title').text(btnTitle);

}



function activeClick(id){

    $(document).ready(function() {

      $(id).toggleClass('ui-btn-text active');

    });

}



$('input[name=user_name]').focus();





function toggle_img(id){

	

		$(document.getElementById(id)).html("<img src='images/"+id+"on.png'>");

		alert(id);

	}