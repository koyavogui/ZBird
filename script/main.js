 /**
  * 
  * Fonction permettant de reecrire le nom de la page pour creer un dossier.
  */

 function slugify (str) {
    var map = {
        ' ' : '_',
        ' ' : "'",
        'a' : 'á|à|ã|â|À|Á|Ã|Â',
        'e' : 'é|è|ê|É|È|Ê',
        'i' : 'í|ì|î|Í|Ì|Î',
        'o' : 'ó|ò|ô|õ|Ó|Ò|Ô|Õ',
        'u' : 'ú|ù|û|ü|Ú|Ù|Û|Ü',
        'c' : 'ç|Ç',
        'n' : 'ñ|Ñ',
        '-' : ' '
    };
    
    for (var pattern in map) {
        str = str.replace(new RegExp(map[pattern], 'g'), pattern);
    };

    return str.split('-').join("").toLowerCase();
};

/**
 * fonction pour recuperer la ville en fonction de l'identifiant du pays.
 */
function recupVilleCombo (str){
    if(str !== ''){
        $.post( "services/registrer.php", { cities : str })
        .done(function( data ) {
             $('#city').html(data);
        });
    }
}

 

$(document).ready(function(){
    $("#formSingin").hide();
     
    // charger la section de connexion
    $("#locationHref").click(function () { 
        const text = $("#locationHref").text();
        console.log(text);
        console.log(text == "Connexion");
        if (text == "Connexion") {
            $("#formRegister").hide();
            $("#formSingin").show();
            $("#locationHref").text("Enregistrement"); 
            $("#formTitle").text("Connexion");
        } else {
            $("#formSingin").hide();
            $("#formRegister").show();
            $("#locationHref").text("Connexion"); 
            $("#formTitle").text('Enregistrement');
        }

    })
    /**
     * verification de mail 
     */
    $("#email").focusout(function () {
        const email = $("#email").val();
        if(email !== ''){
            $.post( "services/registrer.php", { checkEmail : email }, function( data ) {
                if (data.resultCheckEmail == 1) {
                    if (!$("#email").is(".is-invalid")) {
                        $( "#email" ).toggleClass("is-invalid");
                    }
                    if ($("#email").is(".is-valid")) {
                        $( "#email" ).toggleClass("is-invalid", "is-valid");
                    }
                } else {
                    if (!$("#email").is(".is-valid")) {
                        $( "#email" ).toggleClass("is-valid");
                    }
                    if ($("#email").is(".is-invalid")) {
                        $( "#email" ).toggleClass("is-invalid", "is-valid");
                    }
                }
                }, "json");
        }
      })
    
      /**
       *  verification du nom de la page dans la base de données
       */
      $("#pageName").focusout(function () {
        const pageName = $("#pageName").val();
        if(pageName.trim() !== ('' && ' ') ){
            $.post( "services/registrer.php", { checkPageName : pageName }, function( data ) {
                if (data.resultcheckPageName == 1) {
                    if (!$("#pageName").is(".is-invalid")) {
                        $( "#pageName" ).toggleClass("is-invalid");
                    }
                    if ($("#pageName").is(".is-valid")) {
                        $( "#pageName" ).toggleClass("is-invalid", "is-valid");
                    }
                } else {
                    if (!$("#pageName").is(".is-valid")) {
                        $( "#pageName" ).toggleClass("is-valid");
                    }
                    if ($("#pageName").is(".is-invalid")) {
                        $( "#pageName" ).toggleClass("is-invalid", "is-valid");
                    }
                }
                }, "json");
        }else{
            if ($("#pageName").is(".is-valid")) {
                $( "#pageName" ).toggleClass("is-valid");
            }
            if ($("#pageName").is(".is-invalid")) {
                $( "#pageName" ).toggleClass("is-invalid");
            }
        }
      })

    /**
     *  code pour faire la connexion 
     */

    $("#MySigin").click(function (e) { 
        e.preventDefault();
        $.post( "services/registrer.php", $("#formSingin").serialize(), function (data) {
            console.log(data);
            if ( data.login == "S-success" && data.status == "0") {
                document.location = data.folder+'/admin/' ;
            }else{
                $("#formTitle").text("L'un de vos accès est incorrect");
                if ($("#formTitle").is(".bg-warning")) {
                $( "#formTitle" ).toggleClass("bg-danger", "bg-warning");
              }
              if ($("#cadre").is(".border-warning")) {
                $( "#cadre" ).toggleClass("border-danger", "border-warning");
              }
            } 
        },"json")
    });
    /**
     *  code pour faire un enregistrement.
     */
    $("#formRegister").submit(function (e) { 
        e.preventDefault();
        const chaine = $("#pageName").val();
        console.log(chaine);
        $("#nomdossier").val(slugify(chaine));
        console.log($("#nomdossier").val());
        $.post( "services/registrer.php", $("#formRegister").serialize(), function  (data) {
            if (data.enregistrement == 'E-success' && data.page!=='') {
                $("#formRegister").hide();
                $("#formSingin").show();
                $("#locationHref").text("Enregistrement"); 
                $("#formTitle").text("Connexion");
            }
        }, "json");
    });

})
