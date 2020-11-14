<?php

include("../functions.php");

$sparqlQueryString = "
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX schema: <http://schema.org/>
PREFIX nagolist: <https://nago.nl/lijsten/>
PREFIX crm: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
SELECT ?url ?subject ?name ?begin ?end (SAMPLE(?img) AS ?img) WHERE {
  ?affiche crm:P2_has_type nagolist:97 ; # vind alleen affiches
           schema:url ?url ;
           foaf:depiction ?img ;
           crm:P1_is_identified_by ?title ;
           crm:P108i_was_produced_by ?creation ;
           dc:subject ?agent .

  ?title crm:P2_has_type <http://vocab.getty.edu/aat/300404670> ;
         crm:P190_has_symbolic_content ?name .

  ?creation crm:P4_has_time-span/crm:P82a_begin_of_the_begin ?begin ;
            crm:P4_has_time-span/crm:P82b_end_of_the_end ?end .

  ?agent rdfs:label ?subject ;
       a crm:Agent";

  if(isset($_GET['subject'])){
        $sparqlQueryString .= "
        FILTER REGEX(?subject,\"" . $_GET['subject'] . "\",\"i\")";
  };

  if(isset($_GET['year'])){
	$sparqlQueryString .= "
	FILTER (year(?begin) <= " . $_GET['year'] . ")
  	FILTER (year(?end) >= " . $_GET['year'] . ")
      ";
  };
      
  $sparqlQueryString .= "}";

//echo $sparqlQueryString;

$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/wci/nago/services/nago/sparql';

$json = getSparqlResults($endpoint,$sparqlQueryString);
$data = json_decode($json,true);

//print_r($data);

$posters = array();
$i = 0;
foreach ($data['results']['bindings'] as $k => $v) {
	$posters[] = array(
		"link" => $v['url']['value'],
		"img" => $v['img']['value'],
		"begin" => $v['begin']['value'],
		"subject" => $v['subject']['value'],
		"end" => $v['end']['value'],
		"title" => $v['name']['value'],
		// "description" => $v['description']['value']
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
				$top = rand(-15,15);
                $left = rand(-15,15);
                $rotate = rand(-3,3);
				$z = rand(1,100)
			?>
				
			<div class="col-md-3">
				
				<div class="poster" style="margin-top: <?= $top ?>%; z-index: <?= $z ?>; margin-left: <?= $left ?>%; transform: rotate(<?= $rotate ?>deg);">
					<img src="getimage.php?url=<?= $v['img'] ?>" />
					<div class="metadata">
						<h3><?= $v['title'] ?></h3>
						<?= $v['description'] ?>
						<p>
						<?= $v['begin'] ?> - <?= $v['end'] ?> | <?= $v['subject'] ?>
					</div>
				</div>

			</div>


			<?php if($i%4==0){ ?>
				</div>
				<div class="row">
			<?php } ?>


		<?php } ?>
		
	
	
</div>


<script>

	$(".poster img").mouseover(function(){

		$(".metadata").hide();

		zindex = $(this).parent().css("z-index");
		//console.log(zindex);
		$(this).parent().css("z-index","101");

		$(this).next('.metadata').show();

		$(this).mouseleave(function(){
			$(this).parent().css("z-index",zindex);
			$(".metadata").hide();
		})

	});

</script>











