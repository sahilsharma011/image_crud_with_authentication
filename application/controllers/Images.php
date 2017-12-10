<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Images extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries */
        $this->load->database();
        /* ------------------ */

        $this->load->helper('url');

        $this->load->library('image_CRUD');
        $this->load->library('ion_auth');
        $this->load->library('upload');
        
    }

    function _example_output($output = null)
    {
        $this->load->view('photos.php', $output);
        $this->load->library('ion_auth');
    }

    function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        } else {
            $this->_example_output((object)array('output' => '', 'js_files' => array(), 'css_files' => array()));
        }
    }

    function imageWithTitle()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        } else {
            $url = explode('/', $_SERVER['REQUEST_URI']);

            $image_crud = new image_CRUD();

            $image_crud->set_primary_key_field('id');
            $image_crud->set_name_field('name');
            $image_crud->set_url_field('url');

            if (isset($url[4]) && $url[4] == 'upload_file') {
                $image_crud->set_relation_field('user_id');
            }

            $image_crud->set_table('images')
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
        $image_crud->set_table('images')
        ->set_image_path('assets/uploads');

        $output = $image_crud->render();

        $this->_example_output($output);
    }

    function aroundMe()
    {
        $this->load->view('aroundme.php');
    }


    function upload_file() {

        //upload file
        $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024'; //1 MB
        
        //var_dump($_POST);

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('assets/uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : ' . $_FILES['file']['name'];
                } else {
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {

                        $data = array(
                            'url' => 'blast',
                            'name' => $_FILES['file']['name'],
                            'latitude' => $_POST['lat'],
                            'longitude' => $_POST['long'],
                            'description' =>$_POST['description']
                        );

                        $this->db->insert('images', $data);
                        echo 'File successfully uploaded : uploads/' . $_FILES['file']['name'];

                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }
    }

    function nearbyImages()
    {
        $this->db->select('images.id,images.user_id,images.name,images.latitude,images.longitude,users.username');
        $this->db->from('images');
        $this->db->join('users', 'users.id = images.user_id');
        $this->db->where('images.latitude >', $_GET['lat1']);
        $this->db->where('images.latitude <', $_GET['lat2']);
        $this->db->where('images.longitude >', $_GET['long1']);
        $this->db->where('images.longitude <', $_GET['long2']);
        $this->db->order_by('images.id', 'RANDOM');
        $this->db->limit(10);
        $query = $this->db->get();
        $images = [];
        foreach ($query->result() as $image)
        {
            array_push($images,$image);
        }

        echo json_encode($images);

    }
}