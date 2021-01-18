
<!--<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="--><?//= WEBROOT ?><!--partenaire/setPassage" method="post">-->
<form id="validation" class="form-inline form-validator" data-type="update" role="form">


    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h3 class="box-title text-center"><?= $this->lang['lab_infos_membre']; ?></h3></legend>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labprenom']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $details_souscription->prenom; ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labnom']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $details_souscription->nom; ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['telephone']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $details_souscription->telephone; ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labemail']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $details_souscription->email; ?> </p>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h3 class="box-title text-center"><?= $this->lang['lab_infos_carte']; ?></h3></legend>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['lab_espace_carte']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $details_souscription->No_carte; ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['lab_date_deliv']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $details_souscription->date_debut; ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['lab_date_expi']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $details_souscription->date_fin; ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labFormule']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $details_souscription->libelle; ?> </p>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <?php if(isset($details_souscription->id)) { ?> <input type="hidden" name="souscription_id" value="<?= $details_souscription->id; ?>"><?php } ?>
                <?php if(isset($details_souscription->id)) { ?> <input type="hidden" name="membre_id" value="<?= $details_souscription->membre_id; ?>"><?php } ?>
                <?php if(isset($details_partenaire->id)) { ?> <input type="hidden" name="partenaire_id" value="<?= $details_partenaire->id; ?>"><?php } ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="montant_prestation"><?= $this->lang['lab_montant_prestation']; ?></label>
                            <input type="number" class="form-control" id="montant_prestation" name="montant_prestation" onchange="calculMontant(this)" oninput="calculMontant(this)" min="0">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="taux_reduc"><?= $this->lang['lab_taux_reduc']; ?></label>
                            <input type="text" class="form-control" id="taux_reduc" readonly value="<?= $details_partenaire->taux_reduction; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="montant"><?= $this->lang['lab_montant_paye']; ?></label>
                            <input type="number" class="form-control" id="montant" name="montant" value="0" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nombre_point"><?= $this->lang['lab_nbr_point']; ?></label>
                            <input type="number" class="form-control" id="nombre_point" name="nombre_point" value="<?= $details_souscription->nombre_point; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <div class="col-md-12 text-center">
            <button class="btn btn-success confirm" data-form="my-form" type="submit">
                <i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
            </button>
        </div>
    </div>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?= ASSETS;?>js/notify.min.js"></script>
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
                    alert("Echec");
                }
            },
            error: function() {
                alert('La requête n\'a pas abouti'); }

        });
    });
</script>






<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<!--<script type="text/javascript">
    $(document).ready(function () {
        $( "#boutton" ).click(function() {
            $( "#validation" ).submit();
        });
    });
</script-->