<?php

include("../functions.php");

$year = $_GET['year'];

$sparqlQueryString = "
PREFIX schema: <http://schema.org/>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX iisg: <https://iisg.amsterdam/vocab/>

SELECT ?poster ?begin ?name ?creator ?thumb WHERE {
  ?poster a schema:Poster ;
          schema:name ?name ;
          schema:creator ?creator ;
          foaf:depiction ?thumb ;
          schema:about ?ccFilm .
        
  OPTIONAL { ?poster schema:dateCreated ?begin }
}
LIMIT 2500
";

$endpoint = 'https://api.druid.datalegend.net/datasets/LvanWissen/Afficheproject/services/Afficheproject/sparql';  // TODO: veranderen

$json = getSparqlResults($endpoint,$sparqlQueryString);
$data = json_decode($json,true);

//print_r($data);

$posters = array();
$i = 0;
foreach ($data['results']['bindings'] as $k => $v) {

    if ($year) {       
        if (substr($v['begin']['value'], 0, 4) != $year) {
            continue;
        }
    }

	$posters[] = array(
		"link" => $v['poster']['value'],
		"img" => $v['thumb']['value'],
        "begin" => $v['begin']['value'],
        "creator" => $v['creator']['value'],
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
				$top = rand(-33,33);
                $left = rand(-30,30);
                $rotate = rand(-8,8);
				$z = rand(1,100)
			?>
				
			<div class="col-md-3">
				
				<div class="poster" style="margin-top: <?= $top ?>%; z-index: <?= $z ?>; margin-left: <?= $left ?>%; transform: rotate(<?= $rotate ?>deg);">
                    <a href="<?= $v['link'] ?>" style="text-decoration: none;" target="_blank">
                        <img src="<?= $v['img'] ?>" />
                    
                        <div class="metadata">
                            <h3><?= $v['title'] ?></h3>
                            <?= $v['description'] ?>
                            <p>
                            <?= $v['begin'] ?> | <?= $v['creator'] ?> 
                            </p>
                        </div>
                    </a>
                    
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

		zindex = $(this).parent().parent().css("z-index");
		//console.log(zindex);
		$(this).parent().parent().css("z-index","101");

		$(this).next('.metadata').show();

		$(this).mouseleave(function(){
			$(this).parent().parent().css("z-index",zindex);
			$(".metadata").hide();
		})

	});

</script>