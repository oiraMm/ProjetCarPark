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
        $.post(
            'pkg_reservation/script/script_reservation.php',
            {
                idReservation : $("#idReservation").val(),
                dateDebut : $("#dateDebutSaisi").val(),
                dateFin : $("#dateFinSaisi").val(),
                modifField : $("#dateFinSaisi").val(),
                ajaxSetVehiculeList : 'ajaxSetVehiculeList'
            },
            function(data){
                var $list = $("#vehicule_list");
                $list.empty(); //vide la liste

                //Ca dessous ca marche pour récup Key, Value
                $.each(data, function (key, val) {
                    $list.append($("<option></option>")
                        .attr("value", key).text(val));
                    });
            },
            ///http://www.journaldunet.com/developpeur/tutoriel/dht/040421-javascript-remplir-dynamiquement-liste.shtml
            'json'
        );
    });
    $("#wrapper").on('change', function (){
        $.post(
            'pkg_reservation/script/script_reservation.php',
            {
                dateDebut : $("#resa_dateDebut").val(),
                idVehicule: $("#resa_vehicule_list").val(),
                idStatus: $("#resa_status_list").val(),
                ajaxResaList : 'ajaxResaList'
            },
            function(data){
                $("#Reservations").empty();

                //alert(data);
                $("#Reservations").append(data);
                /*
                //Ca dessous ca marche pour récup Key, Value
                $.each(data, function (key, val) {
                    $list.append($("<option></option>")
                        .attr("value", key).text(val));
                });*/
            },
            ///http://www.journaldunet.com/developpeur/tutoriel/dht/040421-javascript-remplir-dynamiquement-liste.shtml
            'text'
        );
    });
    $("#wrappervalid").on('change', function (){
        $.post(
            'pkg_reservation/script/script_reservation.php',
            {
                dateDebut : $("#resa_dateDebut").val(),
                idVehicule: $("#resa_vehicule_list").val(),
                idStatus: $("#resa_status_list").val(),
                idUser: $("#resa_user_list").val(),
                ajaxResaList : 'ajaxResaListValid'
            },
            function(data){
                $("#Reservations").empty();

                //alert(data);
                $("#Reservations").append(data);
                /*
                 //Ca dessous ca marche pour récup Key, Value
                 $.each(data, function (key, val) {
                 $list.append($("<option></option>")
                 .attr("value", key).text(val));
                 });*/
            },
            ///http://www.journaldunet.com/developpeur/tutoriel/dht/040421-javascript-remplir-dynamiquement-liste.shtml
            'text'
        );
    });
});