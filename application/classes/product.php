<?php

namespace app\classes;

use app\classes\db\Db;
use app\classes\db\DbMysqli;

class Product
{
    static public function GetCategorys(Db $db)
    {
        $result = $db->ExecuteQuery("SELECT * FROM sections");
        if ($result) {
            foreach ($result as $k => $v) {
                $data[$k] = $v;
            }
            return $data;
        } else {
            return false;
        }
    }
    static public function GetCategoryById(Db $db, $id)
    {
        $result = $db->ExecuteQuery("SELECT * FROM sections WHERE id='$id'");
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            foreach ($row as $key => $vol) {
                $data[$key] = $vol;
            }
            $result->free();
            return $data;
        } else {
            return false;
        }
    }
    static function GetListCategories($categories)
    {
        $category_pages = [];
        foreach ($categories as $v) {
            array_push($category_pages, translit('Корм ' . $v['name']));
        }
        return $category_pages;
    }

    static public function GetProductsOfCategory($id_category, Db $db)
    {
        $result = $db->ExecuteQuery("SELECT * FROM products WHERE id_section='$id_category'");
        if ($result) {
            foreach ($result as $k => $v) {
                $data[$k] = $v;
            }
            return $data;
        } else {
            return false;
        }
    }
    static public function GetProducts(Db $db)
    {
        $result = $db->ExecuteQuery("SELECT * FROM products");
        if ($result) {
            foreach ($result as $k => $v) {
                $data[$k] = $v;
            }
            return $data;
        } else {
            return false;
        }
    }
    static public function GetProducts5($id_category, Db $db)
    {
        $result = $db->ExecuteQuery("SELECT * FROM products WHERE id_section = '$id_category'");
        if ($result) {
            foreach ($result as $k => $v) {
                $data[$k] = $v;
            }
            $rand_id = array_rand($data,5);
            foreach($data as $k=>$v){
                if(in_array($k,$rand_id)){
                    $data5[$k] = $v;
                }
            }
            return $data5;
        } else {
            return false;
        }
    }

    static public function GetProduct( $id, Db $db )
    {
        $result = $db->ExecuteQuery("SELECT * FROM products WHERE id='$id'");
        if ($result->num_rows) {
            foreach ($result->fetch_assoc() as $k => $v) {
                if ($k == 'description') {
                    $data[$k] = htmlspecialchars_decode($v);
                } else {
                    $data[$k] = $v;
                }
            }
            return $data;
        } else {
            return false;
        }
    }
    static public function GetPrice( $id, Db $db )
    {
        $result = $db->ExecuteQuery("SELECT price FROM products WHERE id='$id'")->fetch_assoc();
        if ($result) {
            return $result['price'];
        } else {
            return false;
        }
    }

    static public function GetPurpose($id, Db $db)
    {
        $result = $db->ExecuteQuery("SELECT * FROM purposes WHERE id='$id'");
        if ($result) {
            foreach ($result->fetch_assoc() as $k => $v) {
                $data[$k] = $v;
            }
            return $data;
        } else {
            return false;
        }
    }
    static public function GetManufacturer($id, Db $db)
    {
        $result = $db->ExecuteQuery("SELECT * FROM manufacturers WHERE id='$id'");
        if ($result) {
            foreach ($result->fetch_assoc() as $k => $v) {
                $data[$k] = $v;
            }
            return $data;
        } else {
            return false;
        }
    }
}
