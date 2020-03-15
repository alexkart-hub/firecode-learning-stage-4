<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\models\Model_Category;

class Controller_Category extends Controller
{
    public function __construct()
	{
		$this->model = new Model_Category;
		$this->view = new View;
    }
    
    public function action_category($name_category)
    {
        $data = $this->model->getData();
        $data['name_category'] = $name_category;
		
			 $layout = 'category';
			
		$this->view->generate($layout.'.php', 'template_view.php', $data);
    }
}