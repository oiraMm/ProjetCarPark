/**
 * Created by berne on 22/06/2017.
 */

$(document).ready(function(){
    $("#service_list").on('change', function (){
        $.post(
            'pkg_utilisateur/script/script_utilisateur.php',
            {
                id_service : $("#service_list").val(),
                ajaxVerifChef : 'ajaxVerifChef'
            },
            function(data){
                if(data == 'true'){
                    $("#isChefService").prop("checked", false);
                    $("#isChefService").prop( "disabled", true );
                }
                else
                {
                    $("#isChefService").prop( "disabled", false );
                }
            },

            'text'
        );
    });
});
