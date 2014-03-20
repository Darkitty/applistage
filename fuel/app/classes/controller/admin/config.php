<?php
class Controller_Admin_Config extends Controller_Template{

	public function action_index()
	{
		$data['configs'] = Model_Admin_Config::find_all();
		$this->template->title = "Configs";
		$this->template->content = View::forge('admin/config/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('admin/config');

		$data['config'] = Model_Admin_Config::find_by_pk($id);

		$this->template->title = "Config";
		$this->template->content = View::forge('admin/config/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Admin_Config::validate('create');
			
			if ($val->run())
			{
				$config = Model_Admin_Config::forge(array(
					'colonne_1' => Input::post('colonne_1'),
					'colonne_2' => Input::post('colonne_2'),
					'colonne_3' => Input::post('colonne_3'),
					'colonne_4' => Input::post('colonne_4'),
					'colonne_5' => Input::post('colonne_5'),
					'colonne_6' => Input::post('colonne_6'),
					'colonne_8' => Input::post('colonne_8'),
					'colonne_9' => Input::post('colonne_9'),
					'colonne_10' => Input::post('colonne_10'),
					'colonne_11' => Input::post('colonne_11'),
					'colonne_12' => Input::post('colonne_12'),
					'colonne_13' => Input::post('colonne_13'),
					'colonne_14' => Input::post('colonne_14'),
					'colonne_15' => Input::post('colonne_15'),
					'colonne_16' => Input::post('colonne_16'),
					'colonne_17' => Input::post('colonne_17'),
					'colonne_18' => Input::post('colonne_18'),
					'colonne_20' => Input::post('colonne_20'),
					'colonne_21' => Input::post('colonne_21'),
					'colonne_22' => Input::post('colonne_22'),
					'colonne_23' => Input::post('colonne_23'),
					'colonne_24' => Input::post('colonne_24'),
					'remuneration' => Input::post('remuneration'),
					'date_debut' => Input::post('date_debut'),
					'date_fin' => Input::post('date_fin'),
					'annee_courante' => Input::post('annee_courante'),
				));

				if ($config and $config->save())
				{
					Session::set_flash('success', 'Added config #'.$config->id.'.');
					Response::redirect('admin/config');
				}
				else
				{
					Session::set_flash('error', 'Could not save config.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Configs";
		$this->template->content = View::forge('admin/config/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('admin/config');

		$config = Model_Admin_Config::find_one_by_id($id);

		if (Input::method() == 'POST')
		{
			$val = Model_Admin_Config::validate('edit');

			if ($val->run())
			{
				$config->colonne_1 = Input::post('colonne_1');
				$config->colonne_2 = Input::post('colonne_2');
				$config->colonne_3 = Input::post('colonne_3');
				$config->colonne_4 = Input::post('colonne_4');
				$config->colonne_5 = Input::post('colonne_5');
				$config->colonne_6 = Input::post('colonne_6');
				$config->colonne_8 = Input::post('colonne_8');
				$config->colonne_9 = Input::post('colonne_9');
				$config->colonne_10 = Input::post('colonne_10');
				$config->colonne_11 = Input::post('colonne_11');
				$config->colonne_12 = Input::post('colonne_12');
				$config->colonne_13 = Input::post('colonne_13');
				$config->colonne_14 = Input::post('colonne_14');
				$config->colonne_15 = Input::post('colonne_15');
				$config->colonne_16 = Input::post('colonne_16');
				$config->colonne_17 = Input::post('colonne_17');
				$config->colonne_18 = Input::post('colonne_18');
				$config->colonne_20 = Input::post('colonne_20');
				$config->colonne_21 = Input::post('colonne_21');
				$config->colonne_22 = Input::post('colonne_22');
				$config->colonne_23 = Input::post('colonne_23');
				$config->colonne_24 = Input::post('colonne_24');
				$config->remuneration = Input::post('remuneration');
				$config->date_debut = Input::post('date_debut');
				$config->date_fin = Input::post('date_fin');
				$config->annee_courante = Input::post('annee_courante');

				if ($config->save())
				{
					Session::set_flash('success', 'Updated config #'.$id);
					Response::redirect('admin/config');
				}
				else
				{
					Session::set_flash('error', 'Nothing updated.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->set_global('config', $config, false);
		$this->template->title = "Configs";
		$this->template->content = View::forge('admin/config/edit');

	}

	public function action_delete($id = null)
	{
		if ($config = Model_Admin_Config::find_one_by_id($id))
		{
			$config->delete();

			Session::set_flash('success', 'Deleted config #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete config #'.$id);
		}

		Response::redirect('admin/config');

	}


}
