<?php

class Model_Enseignant extends \Model_Crud
{
	protected static $_properties = array(
		'id',
		'no_enseignant',
		'nom',
		'prenom',
		'voeux_1',
		'voeux_2',
		'voeux_3',
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
	protected static $_table_name = 'enseignant';
	
	protected static function pre_find(&$query)
	{
	    // alter the query
	    $query->order_by('nom', 'asc');
	}
	
	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('nom', 'Nom', 'required|max_length[255]');
		$val->add_field('prenom', 'Prenom', 'required|max_length[255]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');

		return $val;
	}
}