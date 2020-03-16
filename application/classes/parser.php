<?php

namespace app\classes;

use app\classes\db\Db;
use DOMDocument;
use XMLReader;

class Parser
{
    /**
     * @return array
     * @param str $file путь к файлу;
     * @param int $flag если 0 - возвращает производителей ($manufacturers); 
     * если 1 - возвращает назначение ($purposes)
     */
    static public function GetCharacteristics($file, int $flag)
    {
        $result_array = [];
        $reader = new XMLReader;
        $reader->open($file);
        while ($reader->read()) {
            switch ($reader->nodeType) {
                case (XMLREADER::ELEMENT):
                    if ($reader->localName == 'products') {
                        $node = $reader->expand();
                        $dom = new DOMDocument();
                        $result = $dom->importNode($node, true);
                        $result = simplexml_import_dom($result);
                        foreach ($result as $product) {
                            $manufacturer = $product->characteristics->characteristic[$flag]->value;
                            $manufacturer = json_encode($manufacturer);
                            $manufacturer = json_decode($manufacturer, true);
                            if (!in_array($manufacturer[0], $result_array)) {
                                array_push($result_array, $manufacturer[0]);
                            }
                        }
                    }
                    break;
            }
        }
        return $result_array;
    }

    static public function GetSections($file)
    {
        $result_array = [];
        $reader = new XMLReader;
        $reader->open($file);
        while ($reader->read()) {
            switch ($reader->nodeType) {
                case (XMLREADER::ELEMENT):
                    if ($reader->localName == 'sections') {
                        $node = $reader->expand();
                        $dom = new DOMDocument();
                        $result = $dom->importNode($node, true);
                        $result = simplexml_import_dom($result);
                        foreach ($result as $section) {
                            $id = json_decode(json_encode($section->id), true);
                            $name = json_decode(json_encode($section->name), true);
                            $result_array[$id[0]] = $name[0];
                        }
                    }
                    break;
            }
        }
        return $result_array;
    }

    static public function GetProducts($file)
    {
        $result_array = [];
        $reader = new XMLReader;
        $reader->open($file);
        while ($reader->read()) {
            switch ($reader->nodeType) {
                case (XMLREADER::ELEMENT):
                    $node = $reader->expand();
                    $dom = new DOMDocument();
                    $result = $dom->importNode($node, true);
                    $result = simplexml_import_dom($result);
                    switch ($reader->localName) {
                        case 'products':
                            foreach ($result as $product) {
                                foreach ($product as $k => $v) {
                                    if ($k == 'id') {
                                        $id_product = '' . $v;
                                    } elseif ($k == 'description') {
                                        $result_array[$id_product][$k] = $v->asXML();
                                    } elseif ($k == 'characteristics') {
                                        $result_array[$id_product]['manufacturer'] = '' . $v->characteristic[0]->value;
                                        $result_array[$id_product]['purpose'] = '' . $v->characteristic[1]->value;
                                    } else {
                                        $result_array[$id_product][$k] = '' . $v;
                                    }
                                }
                            }
                            break;
                    }
                    break;
            }
        }
        return $result_array;
    }

    static public function GetManufacturerByName($name, Db $db)
    {
        $query = "SELECT id FROM manufacturers WHERE name='$name'";
        $result = $db->ExecuteQuery($query)->fetch_assoc();
        if ($result) {
            return $result['id'];
        } else {
            return false;
        }
    }
    static public function GetPurposeByName($name, Db $db)
    {
        $query = "SELECT id FROM purposes WHERE name='$name'";
        $result = $db->ExecuteQuery($query)->fetch_assoc();
        if ($result) {
            return $result['id'];
        } else {
            return false;
        }
    }

    static public function LoadManufacturersToDb($file, Db $db)
    {
        $manufacturers = self::GetCharacteristics($file, 0);
        foreach ($manufacturers as $manufacturer) {
            $query = "INSERT INTO manufacturers (name) VALUES ('$manufacturer')";
            $id = self::GetManufacturerByName($manufacturer, $db);
            if (!$id) {
                $db->ExecuteQuery($query);
            }
        }
    }

    static public function LoadPurposesToDb($file, Db $db)
    {
        $purposes = self::GetCharacteristics($file, 1);
        $id_purpose = 1;
        foreach ($purposes as $purpose) {
            $query = "INSERT INTO purposes (id,name) VALUES ('$id_purpose','$purpose')";
            $id = self::GetPurposeByName($purpose, $db);
            if (!$id) {
                $db->ExecuteQuery($query);
                ++$id_purpose;
            }
        }
    }

    static public function GetSectionById($id, Db $db)
    {
        $query = "SELECT name FROM sections WHERE id='$id'";
        // echo $query;
        $result = $db->ExecuteQuery($query)->fetch_assoc();
        if ($result) {
            return $result['name'];
        } else {
            return false;
        }
    }

    static public function LoadSectionsToDb($file, Db $db)
    {
        $sections = self::GetSections($file);
        // debug($sections);
        foreach ($sections as $k => $v) {
            $name = self::GetSectionById($k, $db);
            // echo $name;
            if (!$name) {
                $query = "INSERT INTO sections (id,name) VALUES ('$k','$v')";
                $db->ExecuteQuery($query);
            }
        }
    }

    static public function GetProductById($id, Db $db)
    {
        $query = "SELECT * FROM products WHERE id='$id'";
        // echo $query;
        $result = $db->ExecuteQuery($query)->fetch_assoc();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    static public function LoadProductsToDb($file, Db $db)
    {
        $products = self::GetProducts($file);
        foreach ($products as $key => $product) {
            $id = $key;
            $is_product = self::GetProductById($id, $db);
            if (!$is_product) {
                extract($product);
                $manufacturer_id = self::GetManufacturerByName($manufacturer, $db);
                $purpose_id = self::GetPurposeByName($purpose, $db);
                $description = json_encode(htmlspecialchars($description), JSON_UNESCAPED_UNICODE);
                $price = rand(500,2000);
                $query = "INSERT INTO products 
            (id,name,price,id_section,description,image,purpose_id,manufacturer_id)
            VALUES 
            ('$id','$name','$price','$id_section','$description','$image','$purpose_id','$manufacturer_id')";
                $db->ExecuteQuery($query);
            }
            // echo htmlspecialchars_decode(json_decode($description)).'<br><br>';
        }
    }

    static public function LoadXMLToDb($file, Db $db)
    {
        self::LoadManufacturersToDb($file, $db);
        self::LoadPurposesToDb($file, $db);
        self::LoadSectionsToDb($file, $db);
        self::LoadProductsToDb($file, $db);
    }
}
