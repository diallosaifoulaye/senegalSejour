    <style>
        html{
            background: #f4f4f4;
    }
        .table thead > tr > th {
            background: #fff;
            border: 0;
        }
        .table-striped > tbody > tr:nth-of-type(2n+1) {
            background-color: #fff;
        }
    </style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1">
	<div id="wrapper" class="wrapper-fluid banners-effect-10">
		<div id="content" style="margin-bottom: 100px;">
			<div class="so-page-builder">
                <?php include(ROOT."app/views/site/nav.php"); ?>
				<section class="section-style4" style="background: #f4f4f4;">
					<div class="container page-builder-ltr">
                        <form id="validation">
                            <div class="row maxrow">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-bottom: 25px">
                                    <h3 style="color: #707070;font-size: 18px;text-align: left;">INFORMATIONS MEMBRE</h3>
                                    <div class="row" style="padding: 18px;">

                                        <div class="col-md-5">
                                            <img class="img-fluid" src="http://placehold.it/750x500" alt="">
                                        </div>

                                        <div class="col-md-7">
                                            <ul>
                                                <li><span style="font-weight: bold;" ><?php echo $this->lang['labprenom']; ?></span>: <?= $details_souscription->prenom; ?></li>
                                                <li><span style="font-weight: bold;" ><?php echo $this->lang['labnom']; ?></span>: <?= $details_souscription->nom; ?></li>
                                                <li><span style="font-weight: bold;" ><?php echo $this->lang['telephone']; ?></span>: <?= $details_souscription->telephone; ?> </li>
                                                <li><span style="font-weight: bold;" ><?php echo $this->lang['labemail']; ?></span>:  <?= $details_souscription->email; ?> </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h3 style="color: #707070;font-size: 18px;text-align: right;">INFORMATIONS CARTE DE MEMBRE</h3>
                                    <div class="row" style="padding: 23px;background: #fff;">
                                        <div class="col-md-12">
                                            <ul>
                                                <li><span style="font-weight: bold;" ><?php echo $this->lang['lab_espace_carte']; ?></span>: N° <?= $details_souscription->No_carte; ?> </li>
                                                <li><span style="font-weight: bold;" ><?php echo $this->lang['lab_date_deliv']; ?></span>: <?= $details_souscription->date_debut; ?></li>
                                                <li><span style="font-weight: bold;" ><?php echo $this->lang['lab_date_expi']; ?></span>: <?= $details_souscription->date_fin; ?></li>
                                                <li><span style="font-weight: bold;" ><?php echo $this->lang['labFormule']; ?></span>: <?= $details_souscription->libelle; ?> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped custab" style="box-shadow: 0 0.1px 7px 0 rgba(0, 0, 0, 0.35);">
                                    <thead>
                                    <tr>
                                        <th class="text-center"><?= $this->lang['lab_montant_prestation']; ?></th>
                                        <th class="text-center"><?= $this->lang['lab_taux_reduc']; ?></th>
                                        <th class="text-center"><?= $this->lang['lab_montant_paye']; ?></th>
                                        <th class="text-center"><?= $this->lang['lab_nbr_point']; ?></th>
                                        <th class="text-center"></th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td class="text-center"><input type="number" name="montant_prestation" min="0"  onchange="calculMontant(this)" oninput="calculMontant(this)"></td>
                                        <td class="text-center"><input type="number" name="" id="taux_reduc" readonly value="<?= $details_partenaire->taux_reduction; ?>"</td>
                                        <td class="text-center"><input type="number" name="montant" id="montant" value="0" min="0" readonly></td>
                                        <td class="text-center"><input type="number" name="nombre_point" value="<?= $details_souscription->nombre_point; ?>" readonly></td>
                                        <td><input style="background: #957b5f;" type="submit" value="<?php echo $this->lang['btnValider']; ?>" class="btn btn-primary"></td>
                                    </tr>
                                </table>
                            </div>

                            <?php if(isset($details_souscription->id)) { ?> <input type="hidden" name="souscription_id" value="<?= $details_souscription->id; ?>"><?php } ?>
                            <?php if(isset($details_souscription->id)) { ?> <input type="hidden" name="membre_id" value="<?= $details_souscription->membre_id; ?>"><?php } ?>
                            <?php if(isset($details_partenaire->id)) { ?> <input type="hidden" name="partenaire_id" value="<?= $details_partenaire->id; ?>"><?php } ?>
                        </form>
					</div>
				</section>
			</div>
		</div>
		<!-- //Main Container -->
		<!-- Footer Container -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        function calculMontant(element) {
            var valeur = element.value ;
            var taux = $('#taux_reduc').val();
            $('#montant').val()
            if (valeur != ""){
                var somme_ = parseFloat(valeur) * parseFloat(taux)
                var somme = somme_ / 100
                $('#montant').val(somme)
            }else {
                $('#montant').val(0)
            }

        }
        $("#validation").submit(function(event){
            console.log( $( this ).serializeArray() );
            var d = $( this ).serializeArray();
            console.log(d)
            event.preventDefault();
            // alert("Submitted");
            $.ajax({
                type: 'POST',
                data:d,
                url: '<?php echo WEBROOT ?>partenaire/setPassage',
                success: function(data) {
                     var donnees = JSON.parse(data);
                    if (parseInt(donnees) == 1) {
                        Swal.fire({
                            title: 'Paiement!',
                            text: 'Vous paiement a ete effectue avec succes!!',
                            icon: 'info',
                            confirmButtonText: 'OK',
                            onClose: (e) =>{
                                window.location = "<?php echo WEBROOT ?>home/logout";
                            }
                        })
                    }
                    else {
                        Swal.fire({
                            title: 'Paiement!',
                            text: 'Votre paiement a echoue!!',
                            icon: 'alert',
                            confirmButtonText: 'FERMER'
                        })
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Paiement!',
                        text: 'Echec de l\'operation !!',
                        icon: 'danger',
                        confirmButtonText: 'FERMER'
                    })
                }

            });
        });
</script>
