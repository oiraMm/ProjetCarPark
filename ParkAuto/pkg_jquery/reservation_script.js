/**
 * Created by berne on 22/06/2017.
 */


$(document).ready(function(){

    $("#dateDebutSaisi").on('change', function (){
        $.post(
            'pkg_reservation/script/script_reservation.php',
            {
                dateDebut : $("#dateDebutSaisi").val(),
                dateFin : $("#dateFinSaisi").val(),
                modifField : $("#dateDebutSaisi").val(),
                ajaxSetCalendar : 'ajaxSetCalendar'
            },
            function(data){

                    $("#dateFinSaisi").val(data);

            },

            'text'
        );
    });


    $("#dateFinSaisi").on('change', function (){
        $.post(
            'pkg_reservation/script/script_reservation.php',
            {
                dateDebut : $("#dateDebutSaisi").val(),
                dateFin : $("#dateFinSaisi").val(),
                modifField : $("#dateFinSaisi").val(),
                ajaxSetCalendar : 'ajaxSetCalendar'
            },
            function(data){

                if(data==''){
                    alert('Dates non cohérentes');
                    $("#dateFinSaisi").val(data);

                }else{
                    $("#dateFinSaisi").val(data);
                }


            },

            'text'
        );
    });
});
