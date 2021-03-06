<?php

class Model_Fichestage extends \Model_Crud
{
	protected static $_properties = array(
		'etudiant',
		'enseignant',
		'stage',
		'sujet',
		'description_stage',
		'environnement_dev',
		'observations_resp',
		'indemnite',
		'entreprise',
		'responsable_tech',
		'responsable_adm',
		'contact_urgence',
		'contact_urgence_tel',
		'rpz_np',
		'rpz_adresse',
		'rpz_tel',
		'origine_offre',
		'type',
		'langue',
		'duree',
		'date_debut',
		'date_fin',
		'allongee',
		'nb_jour_semaine',
		'horaire_hebdo',
		'retribution',
		'nature',
		'etat',
		'last_edit',
		'chemin_file',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);
	protected static $_table_name = 'fichestages';
	
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('etudiant', 'Etudiant', 'valid_string[numeric]');
		$val->add_field('enseignant', 'Enseignant', 'valid_string[numeric]');
		$val->add_field('stage', 'Stage', 'valid_string[numeric]');
		$val->add_field('sujet', 'Sujet', 'max_length[255]');
		$val->add_field('description_stage', 'Description Stage', 'required');
		$val->add_field('environnement_dev', 'Environnement Dev', 'required');
		$val->add_field('observations_resp', 'Observations Resp', '');
		$val->add_field('indemnite', 'Indemnite', 'valid_string[numeric]');
		$val->add_field('entreprise', 'Entreprise', 'valid_string[numeric]');
		$val->add_field('responsable_tech', 'Responsable Tech', 'valid_string[numeric]');
		$val->add_field('responsable_adm', 'Responsable Adm', 'valid_string[numeric]');
		$val->add_field('contact_urgence', 'Contact Urgence', 'max_length[255]');
		$val->add_field('contact_urgence_tel', 'Contact urgence telephone', 'max_length[255]');
		$val->add_field('rpz_np', 'Rpz Np', 'max_length[255]');
		$val->add_field('rpz_adresse', 'Rpz Adresse', 'max_length[255]');
		$val->add_field('rpz_tel', 'Rpz Tel', 'max_length[255]');
		$val->add_field('origine_offre', 'Origine Offre', 'valid_string[numeric]');
		$val->add_field('type', 'Type', 'valid_string[numeric]');
		$val->add_field('langue', 'Langue', 'valid_string[numeric]');
		$val->add_field('duree', 'Duree', 'valid_string[numeric]');
		$val->add_field('date_debut', 'Date Debut', 'required');
		$val->add_field('date_fin', 'Date Fin', 'required');
		$val->add_field('allongee', 'Allongee', 'valid_string[numeric]');
		$val->add_field('nb_jour_semaine', 'Nb Jour Semaine', 'valid_string[numeric]');
		$val->add_field('horaire_hebdo', 'Horaire Hebdo', 'valid_string[numeric]');
		$val->add_field('retribution', 'Retribution', 'valid_string[numeric]');
		$val->add_field('nature', 'Nature', 'max_length[255]');
		$val->add_field('etat', 'Etat', 'valid_string[numeric]');
		$val->add_field('last_edit', 'Last Edit', 'date');
		$val->add_field('chemin_file', 'Chemin convention', 'max_length[255]');

		return $val;
	}
	
	protected static function pre_find(&$query)
	{
	    // alter the query
	    $query->order_by('last_edit', 'desc');
	}

	public static function post_find($result)
	{
	    if($result !== null)
	    {
	        foreach ($result as $value) {
				if (!empty($value->entreprise)) {
		        	$entreprise = DB::select('nom', 'ville', 'pays', 'url_entreprise', 'adresse')->from('entreprise')->where('id', $value->entreprise)->execute();
		        	$ent_nom = $entreprise->get('nom');
		        	$id_ville = $entreprise->get('ville');
		        	$id_pays = $entreprise->get('pays');
		        	$ent_url = $entreprise->get('url_entreprise');
		        	$ent_adresse = $entreprise->get('adresse');
		        	if ((!empty($entreprise)) AND (!empty($ent_nom)) AND (!empty($id_ville)) AND (!empty($id_pays))) {
		        		$ent_ville = Model_Ville::find_one_by_id($id_ville)->nom;
		        		$ent_code = Model_Ville::find_one_by_id($id_ville)->code_postal;
						$ent_pays = Model_Pays::find_one_by_id($id_pays)->nom;
		        		$value->set(array(
					    	'ent_nom' => $ent_nom,
					    	'ent_ville' => $ent_ville,
					    	'ent_pays' => $ent_pays,
					    	'ent_pays_id' => $id_pays,
					    	'ent_url' => $ent_url,
					    	'ent_adresse' => $ent_adresse,
					    	'ent_code' => $ent_code,
							));
					}
				}
				if (!empty($value->enseignant)) {
					$enseignant = DB::select('nom', 'prenom')->from('enseignant')->where('id', $value->enseignant)->execute();
					$enseignant_np = $enseignant->get('prenom')." ".$enseignant->get('nom');
		        	if(!empty($enseignant_np)) {
		        		$value->set(array(
					    	'enseignant_np' => $enseignant_np,
							));
					}
				}
				if (!empty($value->etudiant)) {
					$etudiant = DB::select('no_etudiant', 'nom', 'prenom', 'adresse1', 'ville1', 'iut_annee')->from('etudiant')->where('id', $value->etudiant)->execute();
					$no_etudiant = $etudiant->get('no_etudiant');
					$promo = $etudiant->get('iut_annee');
					$etudiant_np = $etudiant->get('prenom')." ".$etudiant->get('nom');
					$etudiant_adr = $etudiant->get('adresse1')." ".$etudiant->get('ville1');
		        	if(!empty($no_etudiant)) {
		        		$value->set(array(
					    	'no_etudiant' => $no_etudiant,
					    	'etudiant_np' => $etudiant_np,
					    	'etudiant_adr' => $etudiant_adr,
					    	'etudiant_promo' => $promo,
							));
					}
				}
				if (!empty($value->stage)) {
					$stage = DB::select('conditions', 'public')->from('stage')->where('id', $value->stage)->execute();
					$stage_cond = $stage->get('conditions');
					$stage_public = $stage->get('public');
		        	if(!empty($stage)) {
		        		$value->set(array(
					    	'stage_cond' => $stage_cond,
					    	'public' => $stage_public,
							));
					}
				}
				if (!empty($value->responsable_tech)) {
					$contact = DB::select('nom', 'prenom', 'telephone', 'email')->from('contact')->where('id', $value->responsable_tech)->execute();
					$contact_nom = $contact->get('nom');
					$contact_prenom = $contact->get('prenom');
					$contact_tel = $contact->get('telephone');
					$contact_email = $contact->get('email');
					if (!empty($contact)) {
		        		if (!empty($contact_nom)) {
		        		$value->set(array(
					    	'responsable_tech_nom' => $contact_nom,
							));
						}
						if (!empty($contact_prenom)) {
		        		$value->set(array(
					    	'responsable_tech_prenom' => $contact_prenom,
							));
						}
						if ((!empty($contact_nom)) AND (!empty($contact_tel))) {
		        		$value->set(array(
					    	'responsable_tech_np' => $contact_nom.' '.$contact_prenom,
							));
						}
						if (!empty($contact_tel)) {
		        		$value->set(array(
					    	'responsable_tech_tel' => $contact_tel,
							));
						}
						if(!empty($contact_email)) {
		        		$value->set(array(
					    	'responsable_tech_email' => $contact_email,
							));
						}
					}
				}
				if (!empty($value->responsable_adm)) {
					$contact = DB::select('nom', 'prenom', 'telephone', 'email')->from('contact')->where('id', $value->responsable_adm)->execute();
					$contact_nom = $contact->get('nom');
					$contact_prenom = $contact->get('prenom');
					$contact_tel = $contact->get('telephone');
					$contact_email = $contact->get('email');
		        	if (!empty($contact)) {
		        		if (!empty($contact_nom)) {
		        		$value->set(array(
					    	'responsable_adm_nom' => $contact_nom,
							));
						}
						if (!empty($contact_prenom)) {
		        		$value->set(array(
					    	'responsable_adm_prenom' => $contact_prenom,
							));
						}
						if ((!empty($contact_nom)) AND (!empty($contact_tel))) {
		        		$value->set(array(
					    	'responsable_adm_np' => $contact_nom.' '.$contact_prenom,
							));
						}
						if (!empty($contact_tel)) {
		        		$value->set(array(
					    	'responsable_adm_tel' => $contact_tel,
							));
						}
						if(!empty($contact_email)) {
		        		$value->set(array(
					    	'responsable_adm_email' => $contact_email,
							));
						}
					}
				}
			}
		}
		
		// return the result
	    return $result;
	}
}