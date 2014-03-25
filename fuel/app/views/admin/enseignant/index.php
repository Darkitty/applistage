<h2>Liste des Enseignants</h2>
<br>
<?php if ($enseignants): ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Email</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($enseignants as $item): ?>		<tr>

			<td><?php echo $item->nom; ?></td>
			<td><?php echo $item->prenom; ?></td>
			<td><?php echo $item->email; ?></td>
			<td>
				<?php echo Html::anchor('admin/enseignant/view/'.$item->id, 'Voir'); ?> |
				<?php echo Html::anchor('admin/enseignant/edit/'.$item->id, 'Editer'); ?> |
				<?php echo Html::anchor('admin/enseignant/delete/'.$item->id, 'Supprimer', array('onclick' => "return confirm('Êtes-vous sur ?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>Aucun Enseignant.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/enseignant/create', 'Ajouter un enseignant', array('class' => 'btn btn-success')); ?>
</p>