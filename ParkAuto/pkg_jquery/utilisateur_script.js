/**
 * Created by berne on 22/06/2017.
 */

$(document).ready(function(){
    $.post(
        'pkg_utilisateur/script/script_utilisateur.php',
        {
            id_user : $("#idUser").val(),
            id_service : $("#service_list").val(),
            ajaxVerifChefIsMe : 'ajaxVerifChefIsMe'
        },
        function(data){
            if(data == 'true')
            {
                $("#isChefService").prop("checked", true);
                $("#isChefService").prop( "disabled", false );
            }
            else
            {
                $("#isChefService").prop("checked", false);
            }
        },

        'text'
    );
    $("#isChefServiceHidden").val($("#isChefService").prop('checked'));
    $("#service_list").on('change', function (){
        $.post(
            'pkg_utilisateur/script/script_utilisateur.php',
            {
                id_service : $("#service_list").val(),
                ajaxVerifChef : 'ajaxVerifChef'
            },
            function(data){
                if(data == 'true'){
                    $("#isChefService").prop( "disabled", true );
                }
                else
                {
                    $("#isChefService").prop( "disabled", false );
                }
            },

            'text'
        );
        $.post(
            'pkg_utilisateur/script/script_utilisateur.php',
            {
                id_user : $("#idUser").val(),
                id_service : $("#service_list").val(),
                ajaxVerifChefIsMe : 'ajaxVerifChefIsMe'
            },
            function(data){
                if(data == 'true')
                {
                    $("#isChefService").prop("checked", true);
                }
                else
                {
                    $("#isChefService").prop("checked", false);
                }
            },

            'text'
        );
    });
    $("#isChefService").on('click', function (){
        $("#isChefServiceHidden").val($("#isChefService").prop('checked'));
    });
});
