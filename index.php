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

	<link rel="stylesheet" href="assets/styles.css" />



	
</head>
<body>




<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-4">
			
			

		</div>
		
		<div class="col-md-4">
			
			<div class="done1" style="margin-top: 16px; margin-left: -23px; transform: rotate(-1deg);">
				<h1>IISG plakmuur</h1>
				<strong>De 114.268 affiches van het IISG zijn te doorzoeken op topic (film, music, aids, environmentalism), plaats (Amsterdam, China) en jaar.</strong>

				<br />
				<br />

				<ul>
					<li><a href="iisg/?year=1900">year=1900</a></li>
					<li><a href="iisg/?place=china">place=china</a></li>
					<li><a href="iisg/?topic=enviro">topic=enviro</a></li>
					<li><a href="iisg/?topic=film&year=1976&place=amster">topic=film&year=1976&place=amster</a></li>
				</ul>
				
				De parameters kunnen naar believen gecombineerd of weggelaten worden. Voor place en topic  kan ook een deel van een woord gebruikt worden.

				<br />
				<br />

				<a href="https://api.druid.datalegend.net/s/GQBsDWYw0">Zo</a> sparql je een lijst van alle topics.
				<br />
				<br />
			</div>

		</div>
		
		<div class="col-md-4">
			
			<div class="done2" style="margin-top: -3px; margin-left: 3px; transform: rotate(3deg);">
				<h1>EYE plakmuur</h1>
				<strong>EYE Filmposters, geschraapt uit Het Geheugen van Nederland / Delpher (<a href="https://gist.github.com/LvanWissen/1aa74dee61e85923826b6372a24f9367">script</a>).</strong>

				<br />
				<br />

				<ul>
					<li><a href="eye/">bekijk de filmposters!</a></li>
					<li><a href="eye/?year=1935">year=1935</a></li>
				</ul>
				
				We zijn ook aan het kijken of we deze posters kunnen verbinden met films in Cinema Context en daarmee voorstellingen van bioscopen waarin ze vertoond werden. Later meer!

				<br />
				<br />
				<br />
				<br />
			</div>

		</div>
	</div>

	<div class="row">
		
		<div class="col-md-4">
			
			<div class="doel1" style="margin-top: -8px;">
				<h1>Uit in R'dam</h1>
				<p>
					<strong>Affiches uit het Stadsarchief verbinden met locaties, films, artiesten</strong>
				</p>

				<p>
					De niet auteursrechtelijk beschermde affiches zijn, voor zover ze van afbeelding waren voorzien, geschraapt van de website van het Stadsarchief Rotterdam, omgezet naar RDF en gepubliceerd in  <a href="https://druid.datalegend.net/menno/rotterdamspubliek/graphs">Druid</a>
				</p>
				<p>
					Dat zal vooral handmatig werk zijn, maar het is te overzien: er zijn zo'n 1700 affiches en ze staan allemaal onder elkaar in <a href="https://api.druid.datalegend.net/s/yH58nhyU2">deze query</a>
				</p>
				<br />
				<br />
				<br />
			</div>

		</div>
		
		<div class="col-md-4">
			
			<div class="doel2" style="margin-top: 16px; margin-left: -23px;">
				<h1>Inventarisatie</h1>
				<strong>Welke collecties bevatten (veel) affiches? In hoeverre zijn ze gedateerd? Ingedeeld op onderwerp? Op plaatsnaam?</strong>

				<br />
				<br />
				<br />

				<ul>
					<li><a href="https://api.data.netwerkdigitaalerfgoed.nl/s/GHd-VG3ni">Museum voor Wereldculturen</a> (813)</li>
					<li><a href="https://api.druid.datalegend.net/s/wO7jYmSnu">IISG</a> (114.269 waarvan de thumbnail 'open' is)</li>
					<li><a href="https://api.druid.datalegend.net/s/Hi2xoHn6A">Stadsarchief Rotterdam</a> (1773 niet auteursrechtelijk beschermd)</li>
				</ul>
				

				<br />
				<br />
				<br />
				<br />
			</div>

		</div>
		
		<div class="col-md-4">
			
			<div class="doel3">
				<h1>Plakmuur</h1>
				<strong>Toon een muur met affiches uit een specifiek jaar, en als het even kan ook uit een specifieke stad</strong>

				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
			</div>

		</div>
	</div>
	
</div>