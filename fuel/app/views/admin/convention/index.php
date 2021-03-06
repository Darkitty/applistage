<script>
  $(function() {
    $('#myTabs a').click(function (e) {
		e.preventDefault();
		var pane = $(this);
		pane.tab('show');
	});

	// load first tab content
	$('.active a').tab('show');
  });
</script>

<?php
	echo '<div class="btn-toolbar">';
	echo '<div class="btn-group">';
	echo Html::anchor('/admin/convention/', 'Tous', array('class' => 'btn btn-primary'));
	echo '</div>';
	echo '<div class="btn-group">';
	echo Html::anchor('/admin/convention/index/dut', 'DUT Info', array('class' => 'btn btn-primary'));
	echo Html::anchor('/admin/convention/index/lp', 'LP S2Ima', array('class' => 'btn btn-primary'));
	echo '</div>';
	echo '</div>';
	if ($promo==1) {
		echo "<h2>Liste des conventions des DUT Info</h2>";
		$tous=1;
		$lp=1;
		$dut=1;
	}
	elseif ($promo==2) {
		echo "<h2>Liste des conventions des LP S2IMa</h2>";
		$tous=2;
		$lp=2;
		$dut=2;
	}
	else {
		echo "<h2>Liste de toutes les conventions</h2>";
		$tous=0;
		$lp=2;
		$dut=1;
	}
?>
<br />
<?php if ($conventions): ?>
	<div class="container-fluid">
		<ul class="nav nav-tabs" id="myTabs">
		  <li class="active">
		    <a href="#tabs-1">Toutes</a>
		  </li>
		  <li><a href="#tabs-2">Saisies</a></li>
		  <li><a href="#tabs-3">Complètes</a></li>
		  <li><a href="#tabs-4">Incomplètes</a></li>
		  <li><a href="#tabs-5">Générées</a></li>
		</ul>
		<br />
		<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Etudiant</th>
							<th>Enseignant</th>
							<th>Sujet</th>
							<th>Entreprise</th>
							<th>Filière</th>
							<th>Etat</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($conventions as $item):
							if(($item->public==$tous) OR ($item->public==$dut) OR ($item->public==$lp)) {  ?>
							<tr>
								<td><?php if(empty($item->etudiant))
										echo 'aucun';
									else
										echo Html::anchor('admin/etudiant/view/'.$item->etudiant, $item->no_etudiant);
									?></td>
								<td><?php if(empty($item->enseignant))
										echo 'aucun';
									else
										echo Html::anchor('admin/enseignant/view/'.$item->enseignant, $item->enseignant_np);
									?></td>
								<td><?php echo $item->sujet; ?></td>
								<td><?php echo Html::anchor('admin/entreprise/view/'.$item->entreprise, $item->ent_nom); ?></td>
								<td><?php
									if (($item->etudiant_promo == 1) OR ($item->etudiant_promo == 2)) {
										echo '<span class="label label-info">DUT</span>';
									}
									else if ($item->etudiant_promo == 3) {
										echo '<span class="label label-default">LP</span>';
									}
								?></td>
								<td><?php
									if ($item->etat == 0) {
										echo '<span class="label label-info">Saisie</span>';
									}
									else if ($item->etat == 1) {
										echo '<span class="label label-warning">Incomplète</span>';
									}
									else if ($item->etat == 2) {
										echo '<span class="label label-success">Générée</span>';
									}
									else if ($item->etat == 3) {
										echo '<span class="label label-primary">Complète</span>';
									}
								?></td>
								<td style="text-align:center;">
									<?php echo Html::anchor('admin/convention/view/'.$item->id, 'Voir'); ?> |
									<?php echo Html::anchor('admin/convention/edit/'.$item->id, 'Editer'); ?>
									<form method="POST">
										<div class="btn-group">
											<button type="submit" name="incomplete" class="btn btn-warning btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Incomplète</button>
											<button type="submit" name="complete" class="btn btn-primary btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Complète</button>
									    </div>
									    <button type="submit" name="generee" class="btn btn-success btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Générer</button>
									<?php
									if ($item->etat == 2)
										echo Html::anchor('assets/doc/convention/convention-' . $item->no_etudiant . '.pdf', 'PDF', array('class' => 'glyphicon glyphicon-save',));
									?>
									</form>
								</td>
							</tr>
						<?php } endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="tabs-2">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Etudiant</th>
							<th>Enseignant</th>
							<th>Sujet</th>
							<th>Entreprise</th>
							<th>Etat</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($conventions as $item): ?>
						<?php if(($item->public==$tous) OR ($item->public==$dut) OR ($item->public==$lp)) {
								if ($item->etat == 0) { ?>
							<tr>
								<td><?php if(empty($item->etudiant))
										echo 'aucun';
									else
										echo Html::anchor('admin/etudiant/view/'.$item->etudiant, $item->no_etudiant);
									?></td>
								<td><?php if(empty($item->enseignant))
										echo 'aucun';
									else
										echo Html::anchor('admin/enseignant/view/'.$item->enseignant, $item->enseignant_np);
									?></td>
								<td><?php echo $item->sujet; ?></td>
								<td><?php echo Html::anchor('admin/entreprise/view/'.$item->entreprise, $item->ent_nom); ?></td>
								<td><?php
									if ($item->etat == 0) {
										echo '<span class="label label-info">Saisie</span>';
									}
									else if ($item->etat == 1) {
										echo '<span class="label label-warning">Incomplète</span>';
									}
									else if ($item->etat == 2) {
										echo '<span class="label label-success">Générée</span>';
									}
									else if ($item->etat == 3) {
										echo '<span class="label label-primary">Complète</span>';
									}
								?></td>
								<td style="text-align:center;">
									<?php echo Html::anchor('admin/convention/view/'.$item->id, 'Voir'); ?> |
									<?php echo Html::anchor('admin/convention/edit/'.$item->id, 'Editer'); ?>
									<form method="POST">
										<div class="btn-group">
											<button type="submit" name="incomplete" class="btn btn-warning btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Incomplète</button>
											<button type="submit" name="complete" class="btn btn-primary btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Complète</button>
									    </div>
									    <button type="submit" name="generee" class="btn btn-success btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Générer</button>
									<?php
									if ($item->etat == 2)
										echo Html::anchor('assets/doc/convention/convention-' . $item->no_etudiant . '.pdf', 'PDF', array('class' => 'glyphicon glyphicon-save',));
									?>
									</form>
								</td>
							</tr>
						<?php } ?>
						<?php } endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="tabs-3">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Etudiant</th>
							<th>Enseignant</th>
							<th>Sujet</th>
							<th>Entreprise</th>
							<th>Etat</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($conventions as $item): ?>
						<?php if(($item->public==$tous) OR ($item->public==$dut) OR ($item->public==$lp)) {
							if ($item->etat == 3) { ?>
							<tr>
								<td><?php if(empty($item->etudiant))
										echo 'aucun';
									else
										echo Html::anchor('admin/etudiant/view/'.$item->etudiant, $item->no_etudiant);
									?></td>
								<td><?php if(empty($item->enseignant))
										echo 'aucun';
									else
										echo Html::anchor('admin/enseignant/view/'.$item->enseignant, $item->enseignant_np);
									?></td>
								<td><?php echo $item->sujet; ?></td>
								<td><?php echo Html::anchor('admin/entreprise/view/'.$item->entreprise, $item->ent_nom); ?></td>
								<td><?php
									if ($item->etat == 0) {
										echo '<span class="label label-info">Saisie</span>';
									}
									else if ($item->etat == 1) {
										echo '<span class="label label-warning">Incomplète</span>';
									}
									else if ($item->etat == 2) {
										echo '<span class="label label-success">Générée</span>';
									}
									else if ($item->etat == 3) {
										echo '<span class="label label-primary">Complète</span>';
									}
								?></td>
								<td style="text-align:center;">
									<?php echo Html::anchor('admin/convention/view/'.$item->id, 'Voir'); ?> |
									<?php echo Html::anchor('admin/convention/edit/'.$item->id, 'Editer'); ?>
									<form method="POST">
										<div class="btn-group">
											<button type="submit" name="incomplete" class="btn btn-warning btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Incomplète</button>
											<button type="submit" name="complete" class="btn btn-primary btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Complète</button>
									    </div>
									    <button type="submit" name="generee" class="btn btn-success btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Générer</button>
									<?php
									if ($item->etat == 2)
										echo Html::anchor('assets/doc/convention/convention-' . $item->no_etudiant . '.pdf', 'PDF', array('class' => 'glyphicon glyphicon-save',));
									?>
									</form>
								</td>
							</tr>
						<?php } ?>
						<?php } endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="tabs-4">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Etudiant</th>
							<th>Enseignant</th>
							<th>Sujet</th>
							<th>Entreprise</th>
							<th>Etat</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($conventions as $item): ?>
						<?php if(($item->public==$tous) OR ($item->public==$dut) OR ($item->public==$lp)) {
							if ($item->etat == 1) { ?>
							<tr>
								<td><?php if(empty($item->etudiant))
										echo 'aucun';
									else
										echo Html::anchor('admin/etudiant/view/'.$item->etudiant, $item->no_etudiant);
									?></td>
								<td><?php if(empty($item->enseignant))
										echo 'aucun';
									else
										echo Html::anchor('admin/enseignant/view/'.$item->enseignant, $item->enseignant_np);
									?></td>
								<td><?php echo $item->sujet; ?></td>
								<td><?php echo Html::anchor('admin/entreprise/view/'.$item->entreprise, $item->ent_nom); ?></td>
								<td><?php
									if ($item->etat == 0) {
										echo '<span class="label label-info">Saisie</span>';
									}
									else if ($item->etat == 1) {
										echo '<span class="label label-warning">Incomplète</span>';
									}
									else if ($item->etat == 2) {
										echo '<span class="label label-success">Générée</span>';
									}
									else if ($item->etat == 3) {
										echo '<span class="label label-primary">Complète</span>';
									}
								?></td>
								<td style="text-align:center;">
									<?php echo Html::anchor('admin/convention/view/'.$item->id, 'Voir'); ?> |
									<?php echo Html::anchor('admin/convention/edit/'.$item->id, 'Editer'); ?>
									<form method="POST">
										<div class="btn-group">
											<button type="submit" name="incomplete" class="btn btn-warning btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Incomplète</button>
											<button type="submit" name="complete" class="btn btn-primary btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Complète</button>
									    </div>
									    <button type="submit" name="generee" class="btn btn-success btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Générer</button>
									</form>
									<button type="submit" name="generee" class="btn btn-success btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Générer</button>
									<?php
									if ($item->etat == 2)
										echo Html::anchor('assets/doc/convention/convention-' . $item->no_etudiant . '.pdf', 'PDF', array('class' => 'glyphicon glyphicon-save',));
									?>
								</td>
							</tr>
						<?php } ?>
						<?php } endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane" id="tabs-5">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Etudiant</th>
							<th>Enseignant</th>
							<th>Sujet</th>
							<th>Entreprise</th>
							<th>Etat</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($conventions as $item): ?>
						<?php if(($item->public==$tous) OR ($item->public==$dut) OR ($item->public==$lp)) {
							if ($item->etat == 2) { ?>
							<tr>
								<td><?php if(empty($item->etudiant))
										echo 'aucun';
									else
										echo Html::anchor('admin/etudiant/view/'.$item->etudiant, $item->no_etudiant);
									?></td>
								<td><?php if(empty($item->enseignant))
										echo 'aucun';
									else
										echo Html::anchor('admin/enseignant/view/'.$item->enseignant, $item->enseignant_np);
									?></td>
								<td><?php echo $item->sujet; ?></td>
								<td><?php echo Html::anchor('admin/entreprise/view/'.$item->entreprise, $item->ent_nom); ?></td>
								<td><?php
									if ($item->etat == 0) {
										echo '<span class="label label-info">Saisie</span>';
									}
									else if ($item->etat == 1) {
										echo '<span class="label label-warning">Incomplète</span>';
									}
									else if ($item->etat == 2) {
										echo '<span class="label label-success">Générée</span>';
									}
									else if ($item->etat == 3) {
										echo '<span class="label label-primary">Complète</span>';
									}
								?></td>
								<td style="text-align:center;">
									<?php echo Html::anchor('admin/convention/view/'.$item->id, 'Voir'); ?> |
									<?php echo Html::anchor('admin/convention/edit/'.$item->id, 'Editer'); ?>
									<form method="POST">
										<div class="btn-group">
											<button type="submit" name="incomplete" class="btn btn-warning btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Incomplète</button>
											<button type="submit" name="complete" class="btn btn-primary btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Complète</button>
									    </div>
									</form>
									<button type="submit" name="generee" class="btn btn-success btn-xs" value=<?php echo "\"" . $item->id . "\""; ?> >Générer</button>
									<?php
									if ($item->etat == 2)
										echo Html::anchor('assets/doc/convention/convention-' . $item->no_etudiant . '.pdf', 'PDF', array('class' => 'glyphicon glyphicon-save',));
									?>
								</td>
							</tr>
						<?php } ?>
						<?php } endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php else: ?>
	<p>Aucune convention.</p>
<?php endif; ?>
<p>