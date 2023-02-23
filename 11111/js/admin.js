$(function(){
   'use strict' ;
//    Hide placeholder On Form Focus 
$('[placeholder]').focus(function(){
    $(this).attr('data-text', $(this).attr('placeholder'));
    $(this).attr('placeholder', '');
}).blur(function(){
    $(this).attr('placeholder',$(this).attr('data-text'));
});
});


const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});