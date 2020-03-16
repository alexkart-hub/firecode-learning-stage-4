<?php

use app\classes\db\DbMysqli;
use app\classes\Parser;

echo '<br>';

// Парсинг при помощи DOM

// $doc = new DOMDocument();
// $doc->load($_SERVER['DOCUMENT_ROOT'].'/doc/catalogCut.xml');
// $elements = ['id','name','id_section','description'];
// $products = $doc -> getElementsByTagName('product');
// foreach($products as $product){
//     foreach($elements as $v){
//         $$v = $product -> getElementsByTagName($v)->item(0)->nodeValue;
//     }
//     $characteristics = $product -> getElementsByTagName('characteristic');
//     foreach($characteristics as $k => $v){
//         $characteristic[$k][0] = $v -> getElementsByTagName('id')->item(0)->nodeValue;
//         $characteristic[$k][1] = $v -> getElementsByTagName('value')->item(0)->nodeValue;
//     }
//     echo $id.': '.$name.' => '.$id_section;
//     echo  '<br>';
//     echo $description;
//     echo  '<br>';
//     debug($characteristic);
// }
// debug($doc->saveXML());


// Парсинг при помощи SimpleXML

// $xmlstring=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/doc/catalogCut.xml');
// $sections = simplexml_load_string($xmlstring)->sections->section;
// $products = simplexml_load_string($xmlstring)->products->product;
// $characteristics = simplexml_load_string($xmlstring)->characteristics_dictionary->characteristic;
// foreach($sections as $s){
//     debug($s);
// }
// foreach($products as $p){
//     foreach($p as $k=>$v){
//         echo $k.': ';
//         if($k == 'description'){
//             echo $v->asXML().'<br>';
//         } elseif($k == 'characteristics'){
//             echo '<br>';
//             foreach($v->characteristic as $v_c){
//                 echo $v_c->id.': '.$v_c->value.'<br>';
//             }
//         } else {
//             echo $v.'<br>';
//         }
//         echo '<br>';
//     }
// }
// foreach($characteristics as $c){
//     foreach($c as $k=>$v){
//         echo $v.'  ';
//     }
//     echo '<br>';
// }

// Парсинг при помощи XMLReader

// $reader = new XMLReader;
// $reader->open($_SERVER['DOCUMENT_ROOT'] . '/doc/catalogCut.xml');
// while ($reader->read()) {
//     switch ($reader->nodeType) {
//         case (XMLREADER::ELEMENT):
//             $node = $reader->expand();
//             $dom = new DOMDocument();
//             $result = $dom->importNode($node, true);
//             $result = simplexml_import_dom($result);
//             switch ($reader->localName) {
//                 case 'sections':
//                     echo $reader->localName . '<br>';
//                     foreach ($result as $section) {
//                         foreach ($section as $k => $v) {
//                             echo $k . ': ' . $v . '<br>';
//                         }
//                     }
//                     break;
//                 case 'products':
//                     echo $reader->localName . '<br>';
//                     foreach ($result as $product) {
//                         echo 'product:<br>';
//                         foreach ($product as $k => $v) {

//                             if ($k == 'description') {
//                                 echo $k . ': ' . $v->asXML() . '<br>';
//                             } elseif ($k == 'characteristics') {
//                                 echo $k.':';
//                                 echo '<br>';
//                                 echo 'Производитель: '.$v->characteristic[0]->value;echo '<br>';
//                                 echo 'Назначение:    '.$v->characteristic[1]->value;echo '<br>';
//                             } else {
//                                 echo $k . ': ' . $v . '<br>';
//                             }
//                         }
//                         echo '<br>';
//                     }
//                     break;
//                 case 'characteristics_dictionary':
//                     debug($result);
//                     break;
//             }
//             break;
//     }
// }

$file = $_SERVER['DOCUMENT_ROOT'] . '/doc/catalog.xml';
echo $file;
$db = DbMysqli::GetInstance();
$result = Parser::LoadXMLToDb($file,$db);


echo '<br> parser <br>';