<h2>Liste des propositions de stage</h2>
<br />
<?php if ($stages): ?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Date</th>
					<th>Entreprise</th>
					<th>Sujet</th>
					<th>Ville</th>
					<th>Pays</th>
					<th>Public</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($stages as $stage):
					if(($stage->visibilite==1) AND ($stage->etat==1)) { ?>
					<tr>
						<td><?php $date = new DateTime($stage->date); echo $date->format('d/m/Y'); ?></td>
						<td><?php echo $stage->ent_nom; ?></td>
						<td><?php echo $stage->sujet; ?></td>
						<td><?php echo $stage->ent_ville.' ('.$stage->ent_code.')'; ?></td>
						<td><?php echo $stage->ent_pays; ?></td>
						<td><?php
									if ($stage->public == 0) {
										echo "Tout public";
									}
									else if ($stage->public == 1) {
										echo "DUT Info";
									}
									else
										echo "Licence Pro";
								?></td>
						<td>
							<?php echo Html::anchor('./entreprise/details/'.$stage->id, 'Voir'); ?>
						</td>
					</tr>
				<?php }	endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<p>Pas de stage proposé.</p>
<?php endif; ?>
<p>
	<?php echo Html::anchor('entreprise/formulaire', 'Ajouter une proposition', array('class' => 'btn btn-success')); ?>
</p>