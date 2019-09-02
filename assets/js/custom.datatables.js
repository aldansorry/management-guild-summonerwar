$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn';

$.extend( true, $.fn.dataTable.defaults, {
	"lengthMenu": [ [10, 25, 50,100,500,1000, -1], [10, 25, 50,100,500,1000, "All"] ]
} );