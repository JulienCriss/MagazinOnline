function arata_produse(str) {
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
     document.getElementById("produse_stoc").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "stoc_produse.php?catProdus="+encodeURIComponent(str), true);
  xhttp.send();
};

$(function() {
	if (document.title === "Adminstrare IT-Zone | Users") {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("tabel_users").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET", "table_users.php?t=" + Math.random(), true);
		xhttp.send();
	};
});