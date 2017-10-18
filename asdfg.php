<?php

$el = array();
$command = array();

$dom = new DOMDocument('1.0', 'utf-8');
$dom->formatOutput = true;

$xml_array = [
    'root'=>[
    'Good guy' => [
        'name' => [
            '_cdata' => '<h1>Luke Skywalker</h1>'
        ],
        'weapon' => 'Lightsaber'
    ],
    'Bad guy' => [
        'name' => '<h1>Sauron</h1>',
        'weapon' => 'Evil Eye'
    ]
        ]
];

convert_xml($xml_array);

if(!empty($el))
{
    $dom->appendChild(end($el));
}

echo $dom->saveXML();

?>

<?php

 function convert_xml($Xml)
{
    global $el, $dom;
    
        foreach($Xml as $id=>$val)
        {
            if(is_numeric($id))
            {
                $id = "Item".($id);
            }
            
            $id = str_replace(' ', '-', strtolower($id));
            
            if(is_array($val))
            {
                $ele = $dom->createElement($id);
                array_push($el, $ele);
                convert_xml($val);
            }
            else
            {
                $ele = $dom->createElement($id, $val);
                
                if(!empty($el))
                {
                    $com = end($el)->appendChild($ele);
                }
                else
                {
                    $dom->appendChild($ele);
                }
                
            }
        }
        
        if(sizeof($el) > 1)
        {
            $child = end($el);
            $com = prev($el)->appendChild($child);
            array_pop($el);
        }
}

?>
