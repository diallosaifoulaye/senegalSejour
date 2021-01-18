<?php include(ROOT."app/views/template/header_ep.php"); ?>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1" style="background-color: #2B2B2B;">
<div id="wrapper" class="wrapper-fluid banners-effect-10">
		<!-- Main Container  -->
		<div id="content" style="margin-bottom: 0;">
			<div class="so-page-builder">
				<section class="section-style1" id="contact">
					<div class="container page-builder-ltr">
						<div class="row row-style row_a1" style="padding-top: 300px;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c about-text">
								<h3><span><?= $this->lang['first_connect']; ?></span></h3>
							</div>
							<div class="contact_us_v2">
								<div class="contact-bot clearfix">
									<form id="validation" action="<?= WEBROOT ?>utilisateur/saveNewPasswordFirst" method="post" enctype="multipart/form-data" class="form-contact pull-left" style="width: 100%;padding: 38px 326px;background: #fff0;">

                                        
                                        <div class="form-group required">
                                            <input type="password" id="password" name="password" class="form-control" onchange="verifePass(this)" placeholder="Entrer votre ancien mot de passe"
                                                   value="" style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #fff;border-radius: 0;" required>
                                            <span id="msgpassword"></span>
										</div>
                                        <div class="form-group required">
                                            <input type="password" id="newpassword" name="newpassword" class="form-control"  placeholder="Entrer votre nouveau mot de passe"
                                                   value="" style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #fff;border-radius: 0;" minlength="6" onkeyup="checkPass(); return false;" required>
                                            <span id="msgnewpassword"></span>
										</div>
                                        <div class="form-group required">
                                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control"  onkeyup="checkPass(); return false;" placeholder="Confirmer votre nouveau mot de passe"
                                                   value="" style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #fff;border-radius: 0;" minlength="6" required>
                                            <span id="msgconfirmpassword"></span>
										</div>
										<div class="buttons" style="text-align: center;">
											<button class="btn btn-info" id="bouton" type="button"><?= $this->lang['connect']; ?></button>
										</div>

                                        <input type="hidden" name="id" value="<?= $rowid; ?>">
									</form>
                                    <div class="row text-center">
                                        <p id="error" style='color:#F00;display: none; #F00'>Veuillez corriger les erreurs</p>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- //Main Container -->
		<!-- Footer Container -->

<?php include(ROOT."app/views/template/footer_ep.php"); ?>
    <script>

        function capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
        function checkPass()
        {

            var pass1 = document.getElementById('newpassword');
            var pass2 = document.getElementById('confirmpassword');
            var message = document.getElementById('msgnewpassword');
            var message_ = document.getElementById('msgconfirmpassword');
            var goodColor = "#66cc66";
            var badColor = "#ff6666";

            if(pass1.value.length > 5)
            {
                pass1.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = ""
            }
            else
            {
                pass1.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = " Vous devez rentrer au moins 6 caracteres!"
                return;
            }

            if(pass1.value == pass2.value)
            {
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message_.style.color = goodColor;
                message_.innerHTML =""
            }
            else
            {
                pass2.style.backgroundColor = badColor;
                message_.style.color = badColor;
                message_.innerHTML = " Les mots de passe ne correspondent pas."
            }
        }

        function verifePass(element) {
            // alert(element) ;
            var nom = element.name ;
            var valeur = element.value ;
            $.ajax({
                type: 'POST',
                data:{ champ : nom, valeur:valeur, id: <?= $this->_USER->id; ?> },
                url: '<?php echo WEBROOT ?>utilisateur/verifiePass',
                success: function(data) {
                    var donnees = JSON.parse(data);
                    if (parseInt(donnees) == 1) {
                        $('#msg'+nom).html("");
                        if ($("#msgpassword").text() == "" && $("#msgconfirmpassword").text() == "" && $("#msgnewpassword").text() == "" ) {
                            $("#bouton").removeAttr('disabled');
                        }else {
                            $("#bouton").attr('disabled','disabled');
                        }
                    }
                    else {
                        $('#msg'+nom).html("<p style='color:#F00;display: inline; #F00'>Mot de passe incorrect</p>");
                        $("#bouton").attr('disabled','disabled');
                    }
                },
                error: function() {
                    alert('La requête n\'a pas abouti'); }

            });
            //alert(name+' '+value);  \app\core\Utils::ConvNumberLetter($transactT[0]->mnt,'','')
        }

        $( "#bouton" ).click(function( event ) {
            if ($("#msgpassword").text() == "" && $("#msgconfirmpassword").text() == "" && $("#msgnewpassword").text() == "")
            {
                $( "#validation" ).submit()
                $( "#error" ).hide()
            }else {
                $( "#error" ).show()
            }
        })

    </script>
