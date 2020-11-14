<?php

include("../functions.php");

$sparqlQueryString = "
PREFIX schema: <http://schema.org/>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX iisg: <https://iisg.amsterdam/vocab/>
SELECT ?poster ?begin ?end ?name ?description ?thumb (SAMPLE(?topiclabel) AS ?tl) WHERE {
	?poster rdf:type <https://iisg.amsterdam/vocab/Poster> .
	?poster iisg:topic ?topic .
  	?topic rdfs:label ?topiclabel .
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
	FILTER(STR(?rights)=\"open\")";
if(isset($_GET['place'])){
  	$sparqlQueryString .= "
  	FILTER REGEX(?placename,\"" . $_GET['place'] . "\",\"i\")";
}
if(isset($_GET['topic'])){
  	$sparqlQueryString .= "
  	FILTER REGEX(?topiclabel,\"" . $_GET['topic'] . "\",\"i\")";
}
if(isset($_GET['year'])){
	$sparqlQueryString .= "
	FILTER (year(?begin) <= " . $_GET['year'] . ")
  	FILTER (year(?end) >= " . $_GET['year'] . ")
  	";
} 
$sparqlQueryString .= "
} 
group by ?poster ?begin ?end ?name ?description ?thumb
order by RAND()
LIMIT 20
";

//echo $sparqlQueryString;

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
		"begin" => $v['begin']['value'],
		"topic" => $v['tl']['value'],
		"end" => $v['end']['value'],
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
                $rotate = rand(-2,2);
			?>
				
			<div class="col-md-3">
				
				<div class="poster" style="margin-top: <?= $top ?>px; z-index: <?= $z ?>; margin-left: <?= $left ?>px; transform: rotate(<?= $rotate ?>deg);">
					<img src="<?= $v['img'] ?>" />
					<div class="metadata">
						<h3><?= $v['title'] ?></h3>
						<?= $v['description'] ?>
						<p>
						<?= $v['begin'] ?> - <?= $v['end'] ?> | <?= $v['topic'] ?> | <?= $v['place'] ?>
					</div>
				</div>

			</div>


			<?php if($i%4==0){ ?>
				</div>
				<div class="row">
			<?php } ?>


		<?php } ?>
		
	
	
</div>

<div class="container-fluid">
	<div class="row">
		<form style="margin: 550px auto 100px auto; background-color: #fff; border: 1px solid #000; padding: 20px;" action="index.php" method="get">
			<select name="topic" style="height: 30px;">
			<?php

			if (($handle = fopen("topics.csv", "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			    	if($_GET['topic']==$data[0]){
			        	echo "<option selected value=\"" . $data[0] . "\">" . $data[0] . " (" . $data[1] . ")</option>\n";
			    	}else{
			        	echo "<option value=\"" . $data[0] . "\">" . $data[0] . " (" . $data[1] . ")</option>\n";
			    	}
			    }
			    fclose($handle);
			}

			?>
			</select>

			<button style="background-color: #000; color: #fff; border: none; height: 30px;">nu dit topic</button>
			<p style="font-size: 10px">Je kan (daarbij) ook parameters 'year' en 'place' achter de url typen,<br/>
				als in <a href="index.php?year=1985&place=Amsterdam">index.php?year=1985&place=Amsterdam</a>
			</p>
		</form>
	</div>
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











