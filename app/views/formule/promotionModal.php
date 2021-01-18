
<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>promotion/<?= ((isset($promotion->id)) ? "modifPromotion" : "ajoutPromotion") ?>" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= ((isset($promotion->id)) ? $this->lang['update_promotion'] : $this->lang['ajout_promotion']) ; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="libelle" class="control-label"><?php echo $this->lang['libelle']; ?> (*) :</label>
                        <input type="text" id="libelle" name="libelle" class="form-control" placeholder="<?php echo $this->lang['libelle']; ?>"
                               value="<?= $promotion->libelle; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <div class="input-group date" id="debut" data-target-input="nearest">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                            <div class="input-group date" id="fin" data-target-input="nearest">-->
<!--                            </div>-->
<!--                    </div>-->

                    <!--<div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="debut1" class="control-label"><?php /*echo $this->lang['labDebut']; */?> (*) :</label>
                        <input id="debut1" type="text" name="debut1" class="form-control datetimepicker" data-target="#debut" value="<?/*= $promotion->debut; */?>" placeholder="<?php /*echo $this->lang['labDebut']; */?>"
                        <span class="help-block with-errors"> </span>

                    </div>-->
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="debut" class="control-label"><?php echo $this->lang['labDebut']; ?>(*)</label>

                        <input id="form1" name="debut" class="form-control" type="text"  placeholder="<?php echo $this->lang['labDebut']; ?>"
                                value="<?php if($promotion->debut) echo $promotion->debut; else echo date("Y-m-d H:m:s"); ?>" required>

                        <span class="help-block with-errors"> </span>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="fin" class="control-label"><?php echo $this->lang['labFin']; ?> (*)</label>
                        <input type="text" id="form2" name="fin" class="form-control datetimepicker" data-toggle="datetimepicker" data-target="#fin" value="<?php if($promotion->fin) echo $promotion->fin; else echo date("Y-m-d"); ?>" placeholder="<?php echo $this->lang['labFin']; ?>"
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="taux" class="control-label"><?php echo $this->lang['taux_promotion']; ?> (*) :</label>
                        <input type="text" id="taux" name="taux" class="form-control" placeholder="<?php echo $this->lang['taux_promotion']; ?>"
                               value="<?= $promotion->taux; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>

                    <?php if(isset($promotion->id)){  ?> <input type="hidden" name="id" value="<?= $promotion->id; ?>"><?php } ?>
                </div>
                <div class="col-sm-2"></div>

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>

</form>


<script>

    $(document).ready(function() {

        $('#form1').datetimepicker({
                minDate: 0
            }
        );
        $('#form2').datetimepicker({
                minDate: 0
            }
        );

    });

</script>



<!--
<script type="text/javascript">
    $(function () {
        $('#debut').datetimepicker(
            {
                format : 'YYYY-MM-DD HH:mm:ss'
            }
        );
        $('#fin').datetimepicker({
            useCurrent: false,
            format : 'YYYY-MM-DD HH:mm:ss'
        });
        $("#debut").on("change.datetimepicker", function (e) {
            $('#fin').datetimepicker('minDate', e.date);
        });
        $("#fin").on("change.datetimepicker", function (e) {
            $('#debut').datetimepicker('maxDate', e.date);
        });
    });
</script>-->