<?php 

namespace app\core;

use app\classes\db\DbMysqli;
use app\classes\Product;

class Model
{
	public $db;
	public $data;

	public function __construct()
	{
		$this->db = DbMysqli::GetInstance();
		$this->data['db'] = $this->db;
        $this->data['categories'] = Product::GetCategorys($this->db);
	}
	
	public function getData()
	{
		$data = $this->data;
        return $data;
	}
}
