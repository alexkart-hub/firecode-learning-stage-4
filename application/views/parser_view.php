<?php 
echo '<br>';
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

$xmlstring=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/doc/catalogCut.xml');
$sections = simplexml_load_string($xmlstring)->sections->section;
$products = simplexml_load_string($xmlstring)->products->product;
$characteristics = simplexml_load_string($xmlstring)->characteristics_dictionary->characteristic;
// $xml = simplexml_load_string($xmlstring);
foreach($sections as $s){
    debug($s);
}
foreach($products as $p){
    foreach($p as $k=>$v){
        echo $k.': ';
        if($k == 'description'){
            echo $v->asXML().'<br>';
        } elseif($k == 'characteristics'){
            echo '<br>';
            foreach($v->characteristic as $v_c){
                echo $v_c->id.': '.$v_c->value.'<br>';
            }
        } else {
            echo $v.'<br>';
        }
        echo '<br>';
    }
}
foreach($characteristics as $c){
    foreach($c as $k=>$v){
        echo $v.'  ';
    }
    echo '<br>';
    // debug($c);
}
// debug($xmlstring);
// debug($xml->products->product[9]->description->asXML());