<?php
class Controller_Admin_Entreprise extends Controller_Template{

	public function before()
	{
		// check for admin
		parent::before();
		if ( ! Auth::check())
		{
		    Response::redirect('/util/connexion');
		}
		else {
			$id_info = Auth::get_groups();
    		foreach ($id_info as $info)	{
			    if (($info[1] != "10")&&($info[1] != "11")) {
			    	Response::redirect('/util/connexion');
			    	break;
			    }
    		}
		}
	}

	public function action_index()
	{
		$data['entreprises'] = Model_Entreprise::find_all();
		$this->template->link_header = 'admin/index';
		$this->template->title = "Entreprise &raquo; Gestion";
		$this->template->main_title = 'Applistage 2014';
		$this->template->sub_title = 'Entreprise';
		$this->template->content = View::forge('admin/entreprise/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('admin/entreprise');

		$data['entreprise'] = Model_Entreprise::find_by_pk($id);
		$this->template->link_header = 'admin/index';
		$this->template->title = "Entreprise &raquo; Gestion";
		$this->template->main_title = 'Applistage 2014';
		$this->template->sub_title = 'Entreprise';
		$this->template->content = View::forge('admin/entreprise/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Entreprise::validate('create');
			
			if ($val->run())
			{
				$entreprise = Model_Entreprise::forge(array(
					'nom' => Input::post('nom'),
					'adresse' => Input::post('adresse'),
					'ville' => Input::post('ville'),
					'pays' => Input::post('pays'),
					'url_entreprise' => Input::post('url_entreprise'),
					'stagiaire' => Input::post('stagiaire'),
				));

				if ($entreprise and $entreprise->save())
				{
					Session::set_flash('success', 'Added entreprise #'.$entreprise->id.'.');
					Response::redirect('admin/entreprise');
				}
				else
				{
					Session::set_flash('error', 'Could not save entreprise.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->link_header = 'admin/index';
		$this->template->title = "Entreprise &raquo; Gestion";
		$this->template->main_title = 'Applistage 2014';
		$this->template->sub_title = 'Entreprise';
		$this->template->content = View::forge('admin/entreprise/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('admin/entreprise');

		$entreprise = Model_Entreprise::find_one_by_id($id);

		if (Input::method() == 'POST')
		{
			$val = Model_Entreprise::validate('edit');

			if ($val->run())
			{
				$entreprise->nom = Input::post('nom');
				$entreprise->adresse = Input::post('adresse');
				$entreprise->ville = Input::post('ville');
				$entreprise->pays = Input::post('pays');
				$entreprise->url_entreprise = Input::post('url_entreprise');
				$entreprise->stagiaire = Input::post('stagiaire');

				if ($entreprise->save())
				{
					Session::set_flash('success', 'Updated entreprise #'.$id);
					Response::redirect('admin/entreprise');
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

		$this->template->set_global('entreprise', $entreprise, false);
		$this->template->link_header = 'admin/index';
		$this->template->title = "Entreprise &raquo; Gestion";
		$this->template->main_title = 'Applistage 2014';
		$this->template->sub_title = 'Entreprise';
		$this->template->content = View::forge('admin/entreprise/edit');

	}

	public function action_delete($id = null)
	{
		if ($entreprise = Model_Entreprise::find_one_by_id($id))
		{
			$entreprise->delete();

			Session::set_flash('success', 'Deleted entreprise #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete entreprise #'.$id);
		}

		Response::redirect('admin/entreprise');

	}
}