<?php

namespace app\controllers;

use app\classes\Product;
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

    $data['product'] = Product::GetProduct($name_product['id_product'], $this->model->db);
    $data['purpose'] = Product::GetPurpose($data['product']['purpose_id'], $this->model->db)['name'];
    $data['manufacturer'] = Product::GetManufacturer($data['product']['manufacturer_id'], $this->model->db)['name'];
    $data['name_category'] = $name_product['name_category'];

    foreach ($data['categories'] as $v) {
      if ($v['id'] == $data['product']['id_section']) {
        $data['name_category_rus'] = 'Корм ' . mb_strtolower($v['name']);
      }
    }
    $data['products'] = Product::GetProducts5($data['product']['id_section'],$this->model->db);
    $layout = 'product';

    $this->view->generate($layout . '.php', 'template_view.php', $data);
  }
}
