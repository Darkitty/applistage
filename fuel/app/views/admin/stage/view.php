<h2>Détails #<?php echo $stage->id; ?></h2>

<p>
	<strong>Etudiant:</strong>
	<?php if(empty($stage->etudiant)) {
					echo 'aucun';
				} else { echo Html::anchor('admin/etudiant/view/'.$stage->etudiant, $stage->no_etudiant); } ?></p>
<p>
	<strong>Contact:</strong>
	<?php echo Html::anchor('admin/contact/view/'.$stage->contact, $stage->contact_nom); ?></p>
<p>
	<strong>Contact email:</strong>
	<?php if(empty($stage->contact_email)) {
					echo 'aucun';
				} else { echo $stage->contact_email; } ?></p>
<p>
	<strong>Contact tél:</strong>
	<?php if(empty($stage->contact_tel)) {
					echo 'aucun';
				} else { echo $stage->contact_tel; } ?></p>
<p>
	<strong>Enseignant:</strong>
	<?php if(empty($stage->enseignant)) {
					echo 'aucun';
				} else { echo Html::anchor('admin/enseignant/view/'.$stage->enseignant, $stage->enseignant_nom); } ?></p>
<p>
	<strong>Entreprise:</strong>
	<?php echo Html::anchor('admin/entreprise/view/'.$stage->entreprise, $stage->ent_nom); ?></p>
<p>
	<strong>Sujet:</strong>
	<?php echo $stage->sujet; ?></p>
<p>
	<strong>Visibilité:</strong>
	<?php echo $stage->visibilite; ?></p>
<p>
	<strong>Contexte:</strong>
	<?php echo $stage->contexte; ?></p>
<p>
	<strong>Résultats:</strong>
	<?php echo $stage->resultats; ?></p>
<p>
	<strong>Conditions:</strong>
	<?php if(empty($stage->conditions)) {
					echo 'aucun';
				} else { echo $stage->conditions; } ?></p>
<p>
	<strong>Url doc:</strong><?php if(empty($stage->url_doc)) {
					echo ' aucun';
				} else { echo ' ' . Html::anchor($stage->url_doc, $stage->url_doc); } ?></p>
<p>
	<strong>Public:</strong>
	<?php echo $stage->public; ?></p>
<p>
	<strong>Etat:</strong>
	<?php echo $stage->etat; ?></p>
<p>
	<strong>Date:</strong>
	<?php echo $stage->date; ?></p>
<form method="POST">
				<div class="btn-group">
					<button type="submit" name="valide" class="btn btn-success" value=<?php echo "\"" . $stage->id . "\""; ?> >Valider</button>
					<button type="submit" name="refus" class="btn btn-warning" value=<?php echo "\"" . $stage->id . "\""; ?> >Refuser</button>
					<button type="submit" name="clos" class="btn btn-danger" value=<?php echo "\"" . $stage->id . "\""; ?> >Clore</button>
				    </div>
				</form>
<?php echo Html::anchor('admin/stage/edit/'.$stage->id, 'Editer'); ?> |
<?php echo Html::anchor('admin/stage', 'Retour'); ?>