<?php

include("../functions.php");

$sparqlQueryString = "
PREFIX schema: <http://schema.org/>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX iisg: <https://iisg.amsterdam/vocab/>
SELECT ?poster ?begin ?end ?name ?description ?thumb WHERE {
  ?poster rdf:type <https://iisg.amsterdam/vocab/Poster> .
  ?poster iisg:topic <https://iisg.amsterdam/authority/topic/83052> .
  ?poster iisg:period ?period .
  ?period iisg:begin ?begin .
  ?period iisg:end ?end .
  ?poster schema:name ?name .
  optional{
  	?poster schema:description ?description .
  }
  ?poster schema:about ?place .
  ?place a schema:Place .
  ?place schema:name ?placename .
  ?poster foaf:depiction ?imginfo .
  ?imginfo foaf:thumbnail ?thumb .
  ?thumb <https://iisg.amsterdam/vocab/access> ?rights .
  FILTER(STR(?rights)=\"open\")
  FILTER REGEX(?placename,\"amst\",\"i\")
  FILTER (year(?begin) <= 1977)
  FILTER (year(?end) >= 1977)
  
} 
group by ?poster ?begin ?end ?name ?description ?thumb
order by desc(?nr)
LIMIT 2500
";

$endpoint = 'https://api.druid.datalegend.net/datasets/IISG/iisg-kg/services/iisg-kg/sparql';

$json = getSparqlResults($endpoint,$sparqlQueryString);
$data = json_decode($json,true);

//print_r($data);

$posters = array();
$i = 0;
foreach ($data['results']['bindings'] as $k => $v) {
	$posters[] = array(
		"link" => $v['poster']['value'],
		"img" => $v['thumb']['value'],
		"place" => $v['placename']['value'],
		"title" => $v['name']['value'],
		"description" => $v['description']['value']
	);
	$i++;
	if($i>11){ break; }
}



?>
<!DOCTYPE html>
<html>
<head>
	
	<title>plakmuur</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script
	src="https://code.jquery.com/jquery-3.2.1.min.js"
	integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	crossorigin="anonymous"></script>

	<link rel="stylesheet" href="../assets/styles.css" />



	
</head>
<body>




<div class="container-fluid">
	<div class="row">
		
		<?php 
			$i=0;
			foreach ($posters as $k => $v) { 
				$i++;
				$top = rand(-25,25);
				$left = rand(-25,25);
				$z = rand(1,100);
			?>
				
			<div class="col-md-3">
				
				<div class="poster" style="margin-top: <?= $top ?>px; z-index: <?= $z ?>; margin-left: <?= $left ?>px;">
					<img src="<?= $v['img'] ?>" />
				</div>

			</div>


			<?php if($i%4==0){ ?>
				</div>
				<div class="row">
			<?php } ?>


		<?php } ?>
		
	
	
</div>