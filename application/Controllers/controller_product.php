<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\models\Model_Product;

class Controller_Product extends Controller
{
    public function __construct()
	{
		$this->model = new Model_Product;
		$this->view = new View;
    }
    
    public function action_product($name_product)
    {
        $data = $this->model->getData();
        $data['name_category'] = $name_product['name_category'];
        $data['id_product'] = $name_product['id_product'];
		
			 $layout = 'product';
			
		$this->view->generate($layout.'.php', 'template_view.php', $data);
    }
}