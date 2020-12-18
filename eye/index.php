<?php

include("../functions.php");

$sparqlQueryString = "
PREFIX sem: <http://semanticweb.cs.vu.nl/2009/11/sem/>
PREFIX schema: <http://schema.org/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

SELECT DISTINCT ?movie ?poster ?title ?depiction WHERE {
  GRAPH <https://data.create.humanities.uva.nl/id/cinemacontext/> {
    ?movie a schema:Movie ;
             schema:name ?title ;
           ^schema:workPresented ?screening .

    ?screening ^schema:subEvent ?programme .
                
    ?programme a schema:Event ;
               schema:location ?cinema ;
               sem:hasTimeStamp ?date .

    ?cinema schema:name ?cinemaName ;
            schema:location/schema:address/schema:addressLocality ?city .

  }
  
  GRAPH <https://data.create.humanities.uva.nl/id/cinemacontext/affiches/> {
    ?poster a schema:Poster ;
            schema:about ?movie ;
            schema:image ?depiction .
  }";

if(isset($_GET['year']) && !empty($_GET['year'])){
    $sparqlQueryString .= "
    FILTER(year(?date) = " . $_GET['year'] . ")";
} else {

    $randomyear = rand(1910, 1955);

    $sparqlQueryString .= "
    FILTER(year(?date) = " . $randomyear . ")";
    $_GET['year'] = $randomyear ;
}

if(isset($_GET['week']) && !empty($_GET['week'])){
    $sparqlQueryString .= "
    FILTER(bif:week(?date) = " . $_GET['week'] . ")";
} else {
    $_GET['week'] = "" ;
}

if(isset($_GET['city']) && !empty($_GET['city'])){
    $sparqlQueryString .= "
    FILTER REGEX(?city,\"" . $_GET['city'] . "\",\"i\")";
} else {
    $_GET['city'] = "" ;
}

if(isset($_GET['cinema']) && !empty($_GET['cinema'])){
    $sparqlQueryString .= "
    FILTER REGEX(?cinemaName,\"" . $_GET['cinema'] . "\",\"i\")";
} else {
    $_GET['cinema'] = "" ;
}
  
$sparqlQueryString .= "
} 

order by RAND()
";

// echo $sparqlQueryString;

$endpoint = 'https://data.create.humanities.uva.nl/sparql';

$json = getSparqlResults($endpoint,$sparqlQueryString);
$data = json_decode($json,true);

//print_r($data);

$posters = array();
$i = 0;
if (isset($data['results'])) {
    foreach ($data['results']['bindings'] as $k => $v) {
        $posters[] = array(
            "movie" => $v['movie']['value'],
            "link" => $v['poster']['value'],
            "img" => $v['depiction']['value'],
            "title" => $v['title']['value']
        );
        $i++;
    }
}



?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Wat draaide wanneer? - Plakmuur</title>

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
                $top = rand(-33,28);
                $left = rand(-30,30);
                $rotate = rand(-8,8);
                $z = rand(1,100)
            ?>
                
            <div class="col-md-3">
                
                <div class="poster" style="margin-top: <?= $top ?>%; z-index: <?= $z ?>; margin-left: <?= $left ?>%; transform: rotate(<?= $rotate ?>deg);">
                    <a href="<?= $v['movie'] ?>" style="text-decoration: none;" target="_blank">
                        <img src="<?= $v['img'] ?>" />
                    
                        <div class="metadata">
                            <h3><?= $v['title'] ?></h3>
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

<div class="container-fluid">
    <div class="row">

   
    <form style="margin: 750px auto 100px auto; background-color: #fff; border: 1px solid #000; padding: 20px;" action="index.php" method="get">
            
             <!-- Year 1910-1955 --> 
            <select name="year" style="height: 30px;">
            <?php

            foreach (range(1910, 1955) as $number) {
                if($_GET['year']==strval($number)){
                    echo "<option selected value=\"" . $number . "\">" . $number . "</option>\n";
                }else{
                    echo "<option value=\"" . $number . "\">" . $number . "</option>\n";
                }
            }

            ?>
            </select>

             <!-- Week 1-53 -->
            <select name="week" style="height: 30px;">
            <?php
            echo "<option value=''>Weeknummer</option>\n";
            foreach (range(1, 53) as $number) {
                if($_GET['week']==strval($number)){
                    echo "<option selected value=\"" . $number . "\">" . $number . "</option>\n";
                }else{
                    echo "<option value=\"" . $number . "\">" . $number . "</option>\n";
                }
            }

            ?>
            </select>

            <!-- City -->
            <select name="city" style="height: 30px;" onchange="showCinemas(this.value, '')">
            <?php

            if (($handle = fopen("cities.csv", "r")) !== FALSE) {
                echo "<option value=''>Stad</option>\n";
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if($_GET['city']==$data[0]){
                        echo "<option selected value=\"" . $data[0] . "\">" . $data[0] . "</option>\n";
                    }else{
                        echo "<option value=\"" . $data[0] . "\">" . $data[0] . "</option>\n";
                    }
                }
                fclose($handle);
            }

            ?>
            </select>

            <!-- Cinema -->
            <select name="cinema" style="height: 30px;">
            <?php

            if (($handle = fopen("cinemas.csv", "r")) !== FALSE) {
                echo "<option value=''>Bioscoop</option>\n";
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if($_GET['cinema']==$data[1]){
                        echo "<option data-city=\"" . $data[0] . "\" selected value=\"" . $data[1] . "\">" . $data[1] . "</option>\n";
                    }else{
                        echo "<option data-city=\"" . $data[0] . "\" value=\"" . $data[1] . "\">" . $data[1] . "</option>\n";
                    }
                }
                fclose($handle);
            }

            ?>
            </select>

            <button style="background-color: #000; color: #fff; border: none; height: 30px;">Laat zien wat er draaide!</button>
            <p>NB: Hoewel je een week kunt selecteren, is er voor sommige steden en sommige bioscopen te weinig informatie beschikbaar om filmposters te tonen.<br/>
            De programmeringsdata zijn afkomstig uit <a href="http://www.cinemacontext.nl/">Cinema Context</a>. Meer informatie over de data van Cinema Context in RDF vind je in deze <a href="https://uvacreate.gitlab.io/cinema-context/cinema-context-rdf/">handleiding</a>.</p>
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

    function showCinemas(city, cinema) {

        if(city === "") {
            $("option").show();
        } else {
            // hide the cinemas not in this city
            $("select[name*='cinema'] option[data-city]").hide();
            $(`option[data-city='${city}']`).show();

            if (cinema === "") {
                $("select[name*='cinema'] option").removeAttr('selected');
                $(`select[name*='cinema'] option:first`).attr("selected", true);
            } else {
                
            }

        }
    }

    $(document).ready ( function(){
        showCinemas("<?php echo $_GET['city'] ?>", "<?php echo $_GET['cinema'] ?>");
    });
    
    
</script>











