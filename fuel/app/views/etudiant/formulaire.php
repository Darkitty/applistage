		<?php echo Asset::js('checkform_etud.js'); ?>
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
			<br />
			<form class="form-horizontal" id="formulaire_etudiant" role="form" method="POST" action="" value="submit" onsubmit="return checkform();">
				<div class="form-group">
					<label for="idEtudiant" class="col-sm-2 control-label" >Id Etudiant</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="idEtudiant" placeholder="" disabled value=<?php
							$id_info = Auth::get_groups();
							foreach ($id_info as $info) {
								if ($info[1] == "2") {
									echo Auth::get('username');
									break;
								}
							}
						?>>
					</div>
				</div>
				<div class="form-group">
					<label for="derniereModif" class="col-sm-2 control-label" >Dernière modification</label>
					<div class="col-sm-10">
			    	<input type="email" class="form-control" id="derniereModif" placeholder="" disabled>
			    </div>
			</div>
			<div class="form-group">
				<label for="contact_urgence" class="col-sm-2 control-label">Contact en cas d'urgence</label>
				<div class="col-sm-10">
					<div id="contact_urgence_div"><input type="text" class="form-control" id="contact_urgence" placeholder="Nom et Prénom"></div>
				</div>
			</div>
			<div class="form-group">
				<label for="rep_nom" class="col-sm-2 control-label" >Représentant légal</label>
				<div class="col-sm-10">
						<div id="rep_nom_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="rep_nom" placeholder="Nom et Prénom"></div>
						<div id="rep_adresse_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="rep_adresse" placeholder="Adresse"></div>
						<div id="rep_tel_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="rep_tel" placeholder="Téléphone"></div>
				</div>
			</div>
			<div class="form-group">
			    <label for="sujetStage" class="col-sm-2 control-label">Sujet du stage</label>
			    <div class="col-sm-10">
			      <div id="sujetStage_div"><input type="text" class="form-control" id="sujetStage" placeholder="" value=<?php 
			      if(isset($stage))
			      	echo $stage->sujet;
			      ?>></div>
			    </div>
			</div>
			<div class="form-group">
			    <label for="" class="col-sm-2 control-label">Origine de l'offre</label>
			    <div class="col-sm-10">
			      	<select class="form-control">
					  <option>offre_iut</option>
					  <option>etudiant</option>
					</select>
			    </div>
			</div>
			<div class="form-group">
				<label for="ent_nom" class="col-sm-2 control-label" >Entreprise</label>
				<div class="col-sm-10">
					<div id="ent_nom_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_nom" placeholder="Nom" value=<?php 
			      if(isset($stage))
			      	echo '"' . $stage->entreprise . '"';
			      ?>></div>
					<div id="ent_adresse_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_adresse" placeholder="Adresse" value=<?php 
			      if(isset($stage))
			      	echo '"' . $stage->ent_adresse . '"';
			      ?>></div>
					<div id="ent_codepostal_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_codepostal" placeholder="Code Postal" value=<?php 
			      if(isset($stage))
			      	echo '"' . $stage->ent_code . '"';
			      ?>></div>
					<div id="ent_ville_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_ville" placeholder="Ville" value=<?php 
			      if(isset($stage))
			      	echo '"' . $stage->ent_ville . '"';
			      ?>></div>
					<div id="ent_pays_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_pays" placeholder="Pays" value=<?php 
			      if(isset($stage))
			      	echo '"' . $stage->ent_pays . '"';
			      ?>></div>
					<div id="ent_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="ent_url" placeholder="URL" value=<?php 
			      if(isset($stage))
			      	echo '"' . $stage->ent_url . '"';
			      ?>></div>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-2 control-label">Type de convention</label>
			    <div class="col-sm-10">
			      	<select class="form-control">
					  <option>entreprise</option>
					  <option>secteur-public</option>
					</select>
			    </div>
			  </div>
			  <div class="form-group">
					<label for="resT_nom" class="col-sm-2 control-label" >Responsable technique</label>
					<div class="col-sm-10">
						<div id="resT_nom_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="resT_nom" placeholder="Nom"></div>
						<div id="resT_email_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="resT_email" placeholder="Email"></div>
						<div id="resT_tel_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="resT_tel" placeholder="Téléphone"></div>
					</div>
				</div>
			  <div class="form-group">
					<label for="resA_nom" class="col-sm-2 control-label" >Responsable administratif</label>
					<div class="col-sm-10">
						<div id="resA_nom_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="resA_nom" placeholder="Nom"></div>
						<div id="resA_email_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="resA_email" placeholder="Email"></div>
						<div id="resA_tel_div" style="margin-bottom:9px;"><input type="text" class="form-control" id="resA_tel" placeholder="Téléphone"></div>
					</div>
				</div>
				<div class="form-group">
			    <label for="adresse_stage" class="col-sm-2 control-label">Adresse du lieu du stage</label>
			    <div class="col-sm-10">
			      <div id="adresse_stage_div"><input type="text" class="form-control" id="adresse_stage" placeholder=""></div>
			    </div>
			  </div>
			  <div class="form-group" id="adresse_stage">
			    <label for="" class="col-sm-2 control-label">Langue de la convention</label>
			    <div class="col-sm-10">
			      	<select class="form-control">
					  <option>Francais</option>
					  <option>Anglais</option>
					</select>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="duree_stage" class="col-sm-2 control-label">Durée du stage en semaines</label>
			    <div class="col-sm-10">
			      <div id="duree_stage_div"><input type="number" class="form-control" id="duree_stage" placeholder="10"></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="date_debut" class="col-sm-2 control-label">Date de début de stage</label>
			    <div class="col-sm-10">
			      <div id="date_debut_div"><input type="date" class="form-control" id="date_debut" value=<?php echo '"' . $date_debut .'"'; ?>></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="date_fin" class="col-sm-2 control-label">Date de fin de stage</label>
			    <div class="col-sm-10">
			      <div id="date_fin_div"><input type="date" class="form-control" id="date_fin" value=<?php echo '"' . $date_fin .'"'; ?>></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-sm-2 control-label">Stage à durée allongée</label>
			    <div class="col-sm-10">
			      <input type="checkbox" id="duree_allongee" value="option1">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="nb_jour_travailles" class="col-sm-2 control-label">Nombre de jours travaillés par semaine</label>
			    <div class="col-sm-10">
			      <div id="nb_jour_travailles_div"><input type="number" class="form-control" id="nb_jour_travailles" placeholder=""></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="horaire_hebdo" class="col-sm-2 control-label">Horaire hebdomadaire maximum</label>
			    <div class="col-sm-10">
			      <div id="horaire_hebdo_div"><input type="number" class="form-control" id="horaire_hebdo" value="35"></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="retribution" class="col-sm-2 control-label">Rétribution proposée</label>
			    <div class="col-sm-10">
			      <div id="retribution_div"><input type="number" class="form-control" id="retribution" placeholder=""></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="montant" class="col-sm-2 control-label">Montant mensuel prévu</label>
			    <div class="col-sm-10" id="montant_div">
			      <div id="montantdiv"><input type="number" class="form-control" id="montant" placeholder="" value=<?php echo '"' . $remuneration .'"'; ?>></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="nature" class="col-sm-2 control-label">En nature</label>
			    <div class="col-sm-10">
			      <div id="nature_div"><input type="text" class="form-control" id="nature" placeholder=""></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="description_sujet" class="col-sm-2 control-label">Description détaillée du sujet de stage</label>
			    <div class="col-sm-10">
			      <div id="description_sujet_div"><textarea id="description_sujet" class="form-control" rows="3"><?php 
			      if(isset($stage))
			      	echo $stage->contexte . "\n" . $stage->resultats;
			      ?></textarea></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="" class="col-sm-2 control-label">Votre mission</label>
			    <div class="col-sm-10">
			      <input type="checkbox" id="inlineCheckbox1" value="option1"> <label for="inlineCheckbox1">Analyse</label>
			      <input type="checkbox" id="inlineCheckbox2" value="option2"> <label for="inlineCheckbox2">Conception</label>
			      <input type="checkbox" id="inlineCheckbox3" value="option3"> <label for="inlineCheckbox3">Réalisation</label>
			      <input type="checkbox" id="inlineCheckbox4" value="option4"> <label for="inlineCheckbox4">Test</label>
			      <input type="checkbox" id="inlineCheckbox5" value="option5"> <label for="inlineCheckbox5">Mise en production</label>  
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="environnement" class="col-sm-2 control-label">Environnement de développement</label>
			    <div class="col-sm-10">
			      <div id="environnement_div"><textarea id="environnement" class="form-control" rows="3" value="Outils et Langages"><?php 
			      if(isset($stage))
			      	echo $stage->conditions;
			      ?></textarea></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="valideCheckbox1" class="col-sm-2 control-label">Stage accepté</label>
			    <div class="col-sm-10">
			      <input type="checkbox" id="valideCheckbox1" value="option1" disabled>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="observations" class="col-sm-2 control-label">Observations du responsable</label>
			    <div class="col-sm-10">
			      <textarea id="observations" class="form-control" rows="3" disabled></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default" onclick="return effacer('#formulaire_etudiant')">RAZ</button>
			      <button id="valider" type="submit" class="btn btn-default">Valider</button>
			    </div>
			  </div>
			</form>
		</div>