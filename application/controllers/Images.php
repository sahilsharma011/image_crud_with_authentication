<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		/* ------------------ */
		
		$this->load->helper('url'); 
		
		$this->load->library('image_CRUD');
		$this->load->library('ion_auth');
	}
	function _example_output($output = null)
	{
		$this->load->view('photos.php',$output);
		$this->load->library('ion_auth');	
	}
	
	function index()
	{	if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		}
	}	
	function imageWithTitle()
	{	if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_name_field('name');
		$image_crud->set_url_field('url');
		$image_crud->set_table('bannerImage')
		->set_ordering_field('priority')
		->set_image_path('assets/uploads');
			
		$output = $image_crud->render();
	
		$this->_example_output($output);
		}
	}
	function gallery()
	{
		$image_crud = new image_CRUD();
		
		$image_crud->unset_upload();
		$image_crud->unset_delete();
		
		$image_crud->set_primary_key_field('id');
		$image_crud->set_name_field('name');
		$image_crud->set_table('bannerImage')
		->set_image_path('assets/uploads');
		
		$output = $image_crud->render();
		
		$this->_example_output($output);		
	}
}