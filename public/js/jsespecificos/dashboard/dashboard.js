$(document).ready(function(){

chosechido();



$('#data_5 .input-daterange').datepicker({
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true
});


});


function chosechido()
{

      $(".chosen-select").chosen({width: "100%"});
}
