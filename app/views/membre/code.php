<style>
    html{
        background: #2f2d2d;
    }
    .table thead > tr > th {
        background: #fff;
        border: 0;
    }
    .table-striped > tbody > tr:nth-of-type(2n+1) {
        background-color: #fff;
    }
    .bd-7 {
        border: 2px solid #f0f0f0;
        border-radius: 10px;
    }
    ul.confirm li span {
        color: #555;
        font-size: 14px;
        text-transform: capitalize;
        width: 50%;
        float: left;
    }
    ul.confirm li label {
        color: #909090;
        font-size: 14px;
        margin-bottom: 0;
        width: 50%;
        float: left;
    }
    ul.payment li label {
        display: initial;
    }
    p{
        padding: 12px;
        font-size: 16px;
    }
</style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>" class="common-home res layout-1">
	<div id="wrapper" class="wrapper-fluid banners-effect-10">
		<!-- Main Container  -->
		<div id="content" style="margin-bottom: 100px;">
			<div class="so-page-builder">
                <?php include(ROOT."app/views/site/nav.php"); ?>
				<section class="section-style4" style="background: #2f2d2d;">
					<div class="container page-builder-ltr">
						<div class="row maxrow" style="background: #fff;margin: 7px 0 0 0;padding: 30px;text-align: center;">
                            <p>Paiement éffectué avec succès <br> Un QRCODE a été généré pour vous et vous sera également envoyé par mail</p>
                            <img style="width: 15%;" src="<?= WEBROOT?>theme/image/codeqr.png" alt="">
                            <p>Veuillez le présenter au partenaire <br> A chaque visite pour bénéficier de votre remise</p>
						</div>
					</div>

				</section>
			</div>
		</div>

		<!-- //Main Container -->
		<!-- Footer Container -->
