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

			<div class="doel1" style="margin-top: -8px; transform: rotate(-3deg);">
				<h1>WAT IS DIT??</h1>
				<p>
					<strong>Op de HackaLOD 2020 hebben we hier een beetje geprutst met affiches in verschillende collecties</strong>
				</p>

				<p>
					We hebben wat 'plakmuren' gemaakt, zodat we een beeld konden krijgen van wat er zoal te vinden was en hoe we daar op konden query'en. En natuurlijk ook een beetje in de hoop dat anderen het leuk vinden om te bekijken.
				</p>
				<p>
					In de toekomst zouden we affiches graag nog meer en beter verbinden aan locaties en vooral ook aan events: voorstellingen, concerten, tentoonstellingen, etc.
				</p>
			</div>
			
			

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
					<li><a href="eye/?year=1940&week=&city=Amsterdam&cinema=Alhambra">year=1940&week=&city=Amsterdam&cinema=Alhambra</a></li>
				</ul>
				
				Waar mogelijk is de filmposter verbonden met een film in <a href="http://www.cinemacontext.nl/">Cinema Context</a>. Je kunt per jaar, per week, per stad en per bioscoop de filmposters opvragen van films die toen draaiden. Niet elke combinatie zal evenveel posters opleveren, dus probeer het vooral een aantal keer. 

				<br />
				<br />
				<br />
				<br />
			</div>

		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="done3" style="margin-top: -8px; transform: rotate(1deg);">
				<h2>RotterdamsPubliek</h2>
				<p>
					<strong>We wilden affiches van het Stadsarchief Rotterdam tonen bij RotterdamsPubliek locaties en op tijdmachine</strong>
				</p>
				<p>
					We hebben <a target="_blank" href="https://github.com/mmmenno/rotterdams-publiek-data/blob/master/data/sa-affiche-links.ttl">131 affiches</a> met de hand aan uitgaansgelegenheden en films verbonden.
				</p>

				<p>
					Op zaalpagina's als die van <a href="https://rotterdamspubliek.nl/plekken/plek.php?qid=Q76161844" target="_blank">Thalia</a> zie je de met die locatie verbonden affiches. <a href="https://rotterdamspubliek.nl/plekken/" target="_blank">Hier is trouwens een overzicht</a> van alle uitgaansgelegenheden so far (niet allemaal met affiches!).
				</p>

				<p>
					De RotterdamsPubliek tijdmachine toont affiches van dat jaar. De jaren <a href="https://rotterdamspubliek.nl/tijdmachine/?year=1943" target="_blank">1943</a> en die vlak daarvoor hebben de meeste.
				</p>
			</div>
		</div>
		<div class="col-md-4">
			
			
			
			<div class="done4" style="margin-top: 30px; margin-left: 3px; transform: rotate(4deg);">
				<h1>NAGO plakmuur</h1>
				<strong>NAGO, het Nederlands Archief Grafisch Ontwerpers, bevat 3000+ affiches.</strong>

				<br />
				<br />

				<ul>
					<li><a href="nago/">bekijk de NAGO affiches hier</a></li>
				</ul>
				
				Later meer info over NAGO hier!

				<br />
				<br />
				<br />
				<br />
			</div>

		</div>
		<div class="col-md-4">
			
			<div class="doel2" style="margin-top: 16px; margin-left: -23px; transform: rotate(1deg);">
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
	</div>

	<div class="row">
		
		<div class="col-md-4">
			
			

		</div>
		<div class="col-md-4">
			
			<div class="doel1" style="margin-top: -40px; transform: rotate(-3deg);">
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
			
			

		</div>
		
		
		
		
	</div>
	
</div>