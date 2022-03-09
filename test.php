<?php
/* 
XML layout
<?xml version="1.0" encoding="UTF-8"?>
<results>
  <L2_language>German</L2_language>
  <L1_language>English</L1_language>
  <result>
      <word>vernachlässigen</word>
      <translations>
        <translation>
	   <definition>to neglect</definition>
           <examples>
             <example>
               <L2_sentence></L2_sentence>
               <L1_translation></L1_translation>
             </example> 
          </examples>
        </translation>
        <translation>
           <definition>to ignore</definition>
           <examples>
             <example>
               <L2_sentence></L2_sentence>
               <L1_translation></L1_translation>
             </example> 
          </examples>
        </translation>
      </translations>
  </result>
  </results>
*/

$skel = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<results>
  <L2_language>German</L2_language>
  <L1_language>English</L1_language>
</results>
EOS;
 
function simplexml_add_test($xml, $word)
{
   $result = $xml->addChild('result'); //Note: $this->xml->results[0]
   
   $result->addChild('word', $word); 

   $translations = $result->addChild('translations');

   $tran = $translations->addChild('translation');

   $tran->addChild('definition', $word);

   $examples = $tran->addChild('examples');

   $ex = $examples->addChild('example');

   $ex->addChild('L2_sentence', "Hallo mein Freund");
   $ex->addChild('L1_sentence', "Hello my friend");

   $ex = $examples->addChild('example');

   $ex->addChild('L2_sentence', "Guten Abend Gisela");
   $ex->addChild('L1_sentence', "Good evening Gisela");
}

function simplexml_parse($xml)
{
  echo  $xml->note[1]->to . "\n";
  echo  $xml->note[1]->from . "\n";
  echo  $xml->note[1]->heading . "\n";
  echo  $xml->note[1]->body . "\n";

  echo "-----------\n";

  echo  $xml->note[1]->to . "\n";
  echo  $xml->note[1]->from . "\n";
  echo  $xml->note[1]->heading . "\n";
  echo  $xml->note[1]->body . "\n";
}

function xml_xpath_parse($xml, string $xpath)
{

  $dom_co = $this->loadHTML($xml); // load initial page, there may be more which buildDOMTable() will fetch.

  $xpath = new \DOMXPath($dom_doc);

  $nodeList = $xpath->query($xpath);
         
  if ($nodeList->length == 0) { // if not found

     return 0; 
  }
   
  // todo: finish 
  //...
}
 // Add to xml file (created initial from string)  using SimpleXML
  $xml = new SimpleXMLElement($skel);

  simplexml_add_test($xml, "Hallo");
  simplexml_add_test($xml, "Abend");

  $xml->asXML('exp.xml');
  
  echo "-----------\n";

 // Parse xml file using SimpleXML
  $xml = simplexml_load_file("notes.xml");
  simplexml_parse($xml);

  // Parse xml using DOM and XPath
