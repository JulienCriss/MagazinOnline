<?php 
session_start();

if (empty($_SESSION["cos"] )) {
	echo '
		<div style="margin-left: 35%;" class="col-md-4 " align="center">
			<div class="pv-30 ph-20 feature-box light-gray-bg bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
				<span class="icon default-bg circle"><i class="fa fa-opencart"></i></span>
				<h3>Cosul dumneavoastra este momentan gol</h3>
				<div class="separator clearfix"></div>
				<a href="http://it-zone.hol.es/">Viziteaza magazin <i class="pl-5 fa fa-angle-double-right"></i></a>
			</div>
	</div>';
}else{

	if (!(isset($_SESSION['login']) && $_SESSION['login'] != ''))
	{
		if(empty($_SESSION["cos"]))
		{
			echo '
			<div style="margin-left: 35%;" class="col-md-4 " align="center">
				<div class="pv-30 ph-20 feature-box light-gray-bg bordered shadow text-center object-non-visible animated object-visible fadeInDownSmall" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
					<span class="icon default-bg circle"><i class="fa fa-opencart"></i></span>
					<h3>Cosul dumneavoastra este momentan gol</h3>
					<div class="separator clearfix"></div>
					<a href="http://it-zone.hol.es/">Viziteaza magazin <i class="pl-5 fa fa-angle-double-right"></i></a>
				</div>
			</div>';
		}else{

			echo '
				<div id="clientNou">
					<div style="padding-left:50px;">
						<h4>Sunt Client nou! <br><small><font color="red">* Daca ai deja un cont te rugam sa te loghezi, apoi sa continui cu finalizarea comenzii.<br> * Daca nu ai cont, te rugam sa completezi formularul de mai jos.</small></font></h4>
					</div>

					<form class="form-horizontal" role="form" pmbx_context="DF6EFB8D-6347-44CA-8F17-988EDCF04EC4">

						<div class="form-group has-feedback">
							<label for="prenume" class="col-sm-3 control-label">Prenume <span class="text-danger small">*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="prenume_final" name="prenume_final" placeholder="Prenume" required="" pmbx_context="C94905AB-C904-4FB9-9C16-42BC03FCA0C1">
								<i class="fa fa-pencil form-control-feedback"></i>
							</div>
						</div>

						<div class="form-group has-feedback">
							<label for="nume" class="col-sm-3 control-label">Nume <span class="text-danger small">*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nume_final" name="nume_final" placeholder="Nume" required="" pmbx_context="A8B8E47E-1E8F-4AB7-92D4-0FC96AB45359">
								<i class="fa fa-pencil form-control-feedback"></i>
							</div>
						</div>

						<div class="form-group has-feedback">
							<label for="telefon" class="col-sm-3 control-label">Telefon <span class="text-danger small">*</span></label>
							<div class="col-sm-8">
								<input type="tel" class="form-control" id="telefon_final" name="telefon_final" placeholder="Telefon" required="" pmbx_context="1A4B3EBC-38CA-4248-B7E1-A4BB83F33EB1">
								<i class="fa fa-phone-square form-control-feedback"></i>
							</div>
						</div>


						<div class="form-group has-feedback">
							<label for="email_sign" class="col-sm-3 control-label">Email <span class="text-danger small">*</span></label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email_sign_final" name="email_final" placeholder="Email" required="" pmbx_context="709FA78D-83EE-4760-8FE3-6A33A9E7B085">
								<i class="fa fa-envelope form-control-feedback"></i>
							</div>
						</div>

						<div class="form-group has-feedback">
							<label for="parola_1" class="col-sm-3 control-label">Parola <span class="text-danger small">*</span></label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="parola_1_final" name="parola_final" placeholder="Minim 4 caractere" required="" pmbx_context="1923384A-BA9A-4535-8915-6D3F5ABEDB77">
								<i class="fa fa-lock form-control-feedback"></i>
							</div>
						</div>

						<div class="form-group has-feedback">
							<label for="adresa_comanda" class="col-sm-3 control-label">Adresa de livrare<span class="text-danger small">*</span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="adresa_livrare_final" name="adresa_livrare_final" placeholder="Adresa de livrare" required="">
								<i class="fa fa-home form-control-feedback"></i>
							</div>
						</div>

						<div class="form-group has-feedback">
							<label for="" class="col-sm-3 control-label">Metoda de Plata<span class="text-danger small">*</span></label>
							<div class="col-sm-8">
								<div class="checkbox">
									<label>
										<input type="radio" name="plata" value="Numerar sau Ramburs">
										Numerar sau Ramburs
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="radio" name="plata" value="Cu Cardul">
										Online cu cardul bancar 
									</label>
								</div>

								<div class="checkbox">
									<label>
										<input type="radio" name="plata" value="Ordin Plata">
										Ordin de Plata
									</label>
								</div>
							</div>
						</div>

						<div align="center" id="error_message" style="display:none;">
							<p>
								<small><font color="red" class="signup_message"></font></small>
							</p>
						</div>

						<div align="center">
							<button type="button" onclick="adauga_comanda();" class="btn btn-animated btn-success btn-sm"> Finalizare comanda <i class="fa fa-check"></i></button>
						</div>
					</form>			
				</div>';
		}
	}else {
		echo '
			<div id="clientLogat">
				<form class="form-horizontal" role="form">
					<div class="form-group has-feedback">
						<label for="adresa_comanda" class="col-sm-3 control-label">Adresa de livrare<span class="text-danger small">*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="adresa_livrare_final" name="adresa_livrare_final" placeholder="Adresa de livrare" required="">
							<i class="fa fa-home form-control-feedback"></i>
						</div>
					</div>

					<div class="form-group has-feedback">
						<label for="" class="col-sm-3 control-label">Metoda de Plata<span class="text-danger small">*</span></label>
						<div class="col-sm-8">
							<div class="checkbox">
								<label>
									<input type="radio" name="plata" value="Numerar sau Ramburs">
									Numerar sau Ramburs
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="radio" name="plata" value="Cu Cardul">
									Online cu cardul bancar 
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="radio" name="plata" value="Ordin Plata">
									Ordin de Plata
								</label>
							</div>
						</div>
					</div>
					<div align="center">
						<button type="button" onclick="adauga_comanda_2();" class="btn btn-animated btn-success btn-sm"> Finalizare comanda <i class="fa fa-check"></i></button>
					</div>
				</form>
			</div>';
	} 
}
?>