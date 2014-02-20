<?php

class Model_Ville extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nom',
		'code_postal',
		'pays',
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
	protected static $_table_name = 'ville';

}
