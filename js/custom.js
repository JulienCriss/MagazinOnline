
// load la produse
$(function() {
	if (document.title === "IT-Zone | Acasa") {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("demo").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET", "php_scripts/produse.php?t=" + Math.random(), true);
		xhttp.send();
	};
});


function verifica_date () {
	var parola = $("#parola_1").val();
	var check_parola = $("#parola_2").val();

	if( parola.length < 4 ){
		$("#error_message").show();
		$(".signup_message").empty().append("* Parola dvs. este prea mica, incercati ceva mai complex!");

		$("#parola_1").val("");
		$("#parola_2").val("");

		$("#parola_1").focus();

		return false;
	}

	if( parola != check_parola){
		$("#error_message").show();
		$(".signup_message").empty().append("* Parolele nu corespund, mai incercati inca odata cu atentie!");
		$("#parola_1").val("");
		$("#parola_2").val("");

		$("#parola_1").focus();

		return false;

	}else{

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("mesaj_salut").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("POST","php_scripts/add_user.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("prenume="+$("#prenume").val()+"&nume="+$("#nume").val()+"&telefon="+$("#telefon").val()+"&email="+$("#email_sign").val()+"&parola="+$("#parola_1").val());
		$("#formRegister").hide();
		$("#loginPart").load('php_scripts/check_if_loged.php');
	}
};

// verifica daca este vreun user logat
$(function() {

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("loginPart").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET", "php_scripts/check_if_loged.php?t=" + Math.random(), true);
		xhttp.send();
		
});


// logout user

function logOut() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("loginPart").innerHTML = xhttp.responseText;
			location.reload();
		}
	};
	xhttp.open("GET", "php_scripts/logOutUser.php?t=" + Math.random(), true);
	xhttp.send();
	
	
};

function verifica_Login(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			// verifica daca userul are cont 
			if(xhttp.responseText == "0"){
				$("#errorUser").show();

				$("#email").val("");
				$("#parola").val("");
				$("#email").focus();

			}else{
				document.getElementById("loginPart").innerHTML = xhttp.responseText;
				location.reload();
			}
		}
	};
	xhttp.open("POST", "php_scripts/loginUser.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("email="+$("#email").val()+"&parola="+$("#parola").val());
};


function GetURLParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}



$(function() {
	if (document.title === "IT-Zone | Shop Product") {

		var ID = GetURLParameter('id');
		var nume_produs = GetURLParameter('product_name');

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("selectedProduct").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET","php_scripts/selecteaza_produs.php?id="+ID+"&product_name="+nume_produs, true);
		xhttp.send();
		//$("#test_div").load('php_scripts/selecteaza_produs.php');
		
	}
});


//poza random in meniu
$(function(){
	var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("oferteRandom").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET","php_scripts/randomImage.php?t=" + Math.random(), true);
		xhttp.send();
});


// Slide Show images product
function show_image_product (newPic) {
	$(".overlay-container").empty();
	$(".overlay-container").append('<img src="imagini_produs/'+newPic+'"><a href="imagini_produs/'+newPic+'" class="popup-img overlay-link" title="image title"><i class="icon-plus-1"></i></a>').fadeIn( "slow" );
}



// from nav when click an anchor tag take the inner an send to ajax
function goToCat (e) {
	
	var str = e.innerHTML;
	//extrage categoria
    var res = str.match(/([A-Z])\w+.+|([A-Z])\w+/g);
    e.href="http://it-zone.hol.es/categorie?catProduct="+encodeURIComponent(res);
	return true;
}



$(function(){
	if (document.title === "IT-Zone | Cat. Produs") {
		
		var categorie = GetURLParameter('catProduct');
		document.getElementById("catTitle").innerHTML= '<i class="fa fa-cubes"></i> '+decodeURIComponent(categorie);


		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("populareDinCategorie").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET","php_scripts/categorieProdus.php?catProduct="+categorie, true);
		xhttp.send();

	}
});



$(function(){
	if (document.title === "IT-Zone | Cos. Cumparaturi") {

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("produse_Din_Cos").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET","php_scripts/cos_cumparaturi.php", true);
		xhttp.send();

	}

});



function adauga_produs(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			window.location= "http://it-zone.hol.es/cos-cumparaturi";
			document.getElementById("produse_Din_Cos").innerHTML = xhttp.responseText;
			
		}
	};
	xhttp.open("GET","php_scripts/cos_cumparaturi.php?id="+id, true);
	xhttp.send();
	

}

function delete_produs(id_prod){

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			window.location= "http://it-zone.hol.es/cos-cumparaturi";
			document.getElementById("produse_Din_Cos").innerHTML = xhttp.responseText;
			
		}
	};
	xhttp.open("GET","php_scripts/sterge_din_cos.php?id_prod="+id_prod, true);
	xhttp.send();
		
};


$(function(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("cosCumparaturi_min").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET","php_scripts/cos_minimal.php?t="+Math.random(), true);
	xhttp.send();
	$('#cosCumparaturi_min').load('php_scripts/cos_minimal.php');
});


function finalizare_comanda () {	
	window.location= "http://it-zone.hol.es/finalizare-comanda";
}


$(function (){
	if (document.title === "IT-Zone | Finazalizare Comanda") {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById('finalComandaBox').innerHTML=xhttp.responseText;
			}
		};
		xhttp.open("GET","php_scripts/finalizare_comanda.php", true);
		xhttp.send();
	}
});

function adauga_comanda () {
	var parola = $("#parola_1_final").val();
	

	if( parola.length < 4 ){
		$("#error_message").show();
		$(".signup_message").empty().append("* Parola dvs. este prea mica, incercati ceva mai complex!");

		$("#parola_1_final").val("");
		$("#parola_1_final").focus();

		return false;
	}
	else{

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("finalComandaBox").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("POST","php_scripts/adauga_comanda.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("prenume="+$("#prenume_final").val()+"&nume="+$("#nume_final").val()+"&telefon="+$("#telefon_final").val()+"&email="+$("#email_sign_final").val()+"&parola="+$("#parola_1_final").val()+"&adresa_livrare_final="+$('#adresa_livrare_final').val()+"&plata="+$('input[name="plata"]:checked').val());

	}

	$('#cosCumparaturi_min').load('php_scripts/cos_minimal.php');
};


function adauga_comanda_2 () {
	{

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("finalComandaBox").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("POST","php_scripts/adauga_comanda_2.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("adresa_livrare_final="+$('#adresa_livrare_final').val()+"&plata="+$('input[name="plata"]:checked').val());

	}
	$('#cosCumparaturi_min').load('php_scripts/cos_minimal.php');
};


$(function(){
	if (document.title === "IT-Zone | Comenzile Mele") {

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				if (xhttp.responseText == 0) {
					window.location= "http://it-zone.hol.es/";
				}else{
					document.getElementById("comenzile_mele").innerHTML = xhttp.responseText;
				}
				
			}
		};
		xhttp.open("GET","php_scripts/comenziUser.php", true);
		xhttp.send();

	}

});

function reseteaza_parola(){

	var parola = $("#parola_reset").val();
	

	if( parola.length < 4 ){
		$("#error_message").show();
		$(".signup_message").empty().append("* Parola dvs. este prea mica, incercati ceva mai complex!");

		$("#parola_reset").val("");
		$("#parola_reset").focus();

		return false;
	}
	else{

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("resetPassword").innerHTML = xhttp.responseText;
				$("#loginPart").load('php_scripts/check_if_loged.php');	
			}
		};
		xhttp.open("POST","php_scripts/resetPassword.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("email="+$("#email_reset").val()+"&parola="+$("#parola_reset").val());

	}
}