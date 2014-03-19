<?php
class Controller_Admin_Etudiant extends Controller_Template{

	public function action_index()
	{
		$data['etudiants'] = Model_Admin_Etudiant::find_all();
		$this->template->title = "Etudiants";
		$this->template->content = View::forge('admin/etudiant/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('admin/etudiant');

		$data['etudiant'] = Model_Admin_Etudiant::find_by_pk($id);

		$this->template->title = "Etudiant";
		$this->template->content = View::forge('admin/etudiant/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Admin_Etudiant::validate('create');
			
			if ($val->run())
			{
				$etudiant = Model_Admin_Etudiant::forge(array(
					'no_etudiant' => Input::post('no_etudiant'),
					'nom' => Input::post('nom'),
					'prenom' => Input::post('prenom'),
					'datedenaissance' => Input::post('datedenaissance'),
					'sexe' => Input::post('sexe'),
					'bac' => Input::post('bac'),
					'mention' => Input::post('mention'),
					'bac_annee' => Input::post('bac_annee'),
					'email' => Input::post('email'),
					'adresse1' => Input::post('adresse1'),
					'ville1' => Input::post('ville1'),
					'adresse2' => Input::post('adresse2'),
					'ville2' => Input::post('ville2'),
					'telephone1' => Input::post('telephone1'),
					'telephone2' => Input::post('telephone2'),
					'iut_annee' => Input::post('iut_annee'),
				));

				if ($etudiant and $etudiant->save())
				{
					Session::set_flash('success', 'Added etudiant #'.$etudiant->id.'.');
					Response::redirect('admin/etudiant');
				}
				else
				{
					Session::set_flash('error', 'Could not save etudiant.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Etudiants";
		$this->template->content = View::forge('admin/etudiant/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('admin/etudiant');

		$etudiant = Model_Admin_Etudiant::find_one_by_id($id);

		if (Input::method() == 'POST')
		{
			$val = Model_Admin_Etudiant::validate('edit');

			if ($val->run())
			{
				$etudiant->no_etudiant = Input::post('no_etudiant');
				$etudiant->nom = Input::post('nom');
				$etudiant->prenom = Input::post('prenom');
				$etudiant->datedenaissance = Input::post('datedenaissance');
				$etudiant->sexe = Input::post('sexe');
				$etudiant->bac = Input::post('bac');
				$etudiant->mention = Input::post('mention');
				$etudiant->bac_annee = Input::post('bac_annee');
				$etudiant->email = Input::post('email');
				$etudiant->adresse1 = Input::post('adresse1');
				$etudiant->ville1 = Input::post('ville1');
				$etudiant->adresse2 = Input::post('adresse2');
				$etudiant->ville2 = Input::post('ville2');
				$etudiant->telephone1 = Input::post('telephone1');
				$etudiant->telephone2 = Input::post('telephone2');
				$etudiant->iut_annee = Input::post('iut_annee');

				if ($etudiant->save())
				{
					Session::set_flash('success', 'Updated etudiant #'.$id);
					Response::redirect('admin/etudiant');
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

		$this->template->set_global('etudiant', $etudiant, false);
		$this->template->title = "Etudiants";
		$this->template->content = View::forge('admin/etudiant/edit');

	}

	public function action_delete($id = null)
	{
		if ($etudiant = Model_Admin_Etudiant::find_one_by_id($id))
		{
			$etudiant->delete();

			Session::set_flash('success', 'Deleted etudiant #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete etudiant #'.$id);
		}

		Response::redirect('admin/etudiant');

	}


}
