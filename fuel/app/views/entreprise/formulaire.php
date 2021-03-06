<?php echo Asset::js('checkform_ent.js'); ?>
<script language="JavaScript" type="text/javascript">
$(function() {
	var availablePays = <?php echo str_replace('&quot;', '"', $liste_pays) ?>;
    var availableEnt = <?php echo str_replace('&quot;', '"', $liste_ent) ?>;
    var availableVille = <?php echo str_replace('&quot;', '"', $liste_ville) ?>;
    var availableCode = <?php echo str_replace('&quot;', '"', $liste_code) ?>;
    $( "#ent_pays" ).autocomplete({
    source: availablePays
    });
    $( "#ent_nom" ).autocomplete({
    source: availableEnt
    });
    $( "#ent_ville" ).autocomplete({
    source: availableVille
    });
    $( "#ent_codepostal" ).autocomplete({
    source: availableCode
    });
    
  });
</script>
		<div style="width:90%;
			margin:auto;
			padding-left:30px;
			padding-right:30px;
			border: 3px solid #DBDBDB;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			overflow: hidden;
			text-align:center;">
			<h2>Formulaire de saisie d'une proposition de stage</h2>
			<p><font color="red"><b>*</b></font> : Champs obligatoires</p>
			<form class="form-horizontal" id="formulaire_entreprise" enctype="multipart/form-data" role="form" method="POST" action="" onsubmit="return checkform();">
				<div class="form-group">
					<label for="sujet" class="col-sm-2 control-label" >Sujet<font color="red">*</font></label>
					<div class="col-sm-10">
						<div id="sujet_div"><input type="text" class="form-control" id="sujet" name="sujet" placeholder=""></div>
					</div>
				</div>
				<div class="form-group">
					<label for="contact_nom" class="col-sm-2 control-label" >Contact<font color="red">*</font></label>
					<div class="col-sm-10">
						<div id="contact_nom_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="contact_nom" name="contact_nom" placeholder="Nom"></div>
						<div id="contact_prenom_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="contact_prenom" name="contact_prenom" placeholder="Prénom"></div>
						<div id="contact_mail_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="contact_mail" name="contact_mail" placeholder="Adresse mail"></div>
						<div id="contact_tel_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="contact_tel" name="contact_tel" placeholder="Téléphone"></div>
					</div>
				</div>
				<div class="form-group">
					<label for="ent_nom" class="col-sm-2 control-label" >Entreprise<font color="red">*</font></label>
					<div class="col-sm-10">
						<div id="ent_nom_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_nom" name="ent_nom" placeholder="Nom"></div>
						<div id="ent_adresse_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_adresse" name="ent_adresse" placeholder="Adresse"></div>
						<div id="ent_codepostal_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_codepostal" name="ent_codepostal" placeholder="Code Postal"></div>
						<div id="ent_ville_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_ville" name="ent_ville" placeholder="Ville"></div>
						<div id="ent_pays_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_pays" name="ent_pays" placeholder="Pays"></div>
						<div id="ent_url_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_url" name="ent_url" placeholder="URL"></div>
					</div>
				</div>
				<div class="form-group">
				    <label for="public" class="col-sm-2 control-label">Montrer cette offre au public</label>
				    <div class="col-sm-10">
				      <input type="checkbox" id="public" name="public" value="1" checked="true">
				    </div>
				</div>
				<div class="form-group">
				    <label for="" class="col-sm-2 control-label">Public visé</label>
				    <div class="col-sm-10">
				      	<select class="form-control" id="promo" name="promo">
						  <option value="0" selected="selected">Indifférent</option>
						  <option value="1">DUT Avril-Juin</option>
						  <option value="2">Licence Pro Février-Juin</option>
						</select>
				    </div>
				    </div>
			  <div class="form-group">
			    <label for="contexte" class="col-sm-2 control-label">Contexte du stage<font color="red">*</font></label>
			    <div class="col-sm-10">
			      <div id="contexte_div"><textarea id="contexte" name="contexte" class="form-control" rows="3"></textarea></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="resultats_attendus" class="col-sm-2 control-label">Résultats attendus<font color="red">*</font></label>
			    <div class="col-sm-10">
			      <div id="resultats_attendus_div"><textarea id="resultats_attendus" name="resultats_attendus" class="form-control" rows="3"></textarea></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="conditions_part" class="col-sm-2 control-label">Conditions particulières</label>
			    <div class="col-sm-10">
			      <div id="conditions_part_div"><textarea id="conditions_part" name="conditions_part" class="form-control" rows="3"></textarea></div>
			    </div>
			  </div>
			  <div class="form-group">
					<label for="url_doc_prez" class="col-sm-2 control-label" >URL d'un document de présentation</label>
					<div class="col-sm-10">
						<div id="url_doc_prez_div"><input type="text" class="form-control" id="url_doc_prez" name="url_doc_prez" placeholder=""></div>
					</div>
				</div>
			<div class="form-group">
				<label>Document PDF de présentation</label>
					<input size='50' type='file' accept="application/pdf" name='filename' style="margin-left:40%;"/><br />
				</div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-8">
			    	<button id="valider" type="submit" class="btn btn-success">Valider</button>
					<button type="reset" class="btn btn-danger" onclick="return effacer('#formulaire_entreprise')">RAZ</button>
			    </div>
			  </div>
			</form>
		</div>