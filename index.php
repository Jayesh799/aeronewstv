<?
function curl_get_contents($url) {
    // Initiate the curl session
    $ch = curl_init();
    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $url);
    // Removes the headers from the output
    curl_setopt($ch, CURLOPT_HEADER, 0);
    // Return the output instead of displaying it directly
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //set timeout
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    // Execute the curl session
    $output = curl_exec($ch);
    // Close the curl session
    curl_close($ch);
    // Return the output as a variable
    return $output;
}

$feed = curl_get_contents("https://www.youtube.com/feeds/videos.xml?channel_id=UCDqcLShiMuAOie-GZqnfMDA");

$xml = new SimpleXmlElement($feed);

$count = count($xml->entry);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Aeronewstv est une chaine dédiée à l'aéronautique avec des reportages vidéo courts. Aller à l'essentiel est notre credo. Le contenu, plutôt didactique, s'adresse à une audience grand public pour mieux connaître ce monde fascinant de l'aviation civile et militaire.">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Custom css -->
	<link href="css/custom.css" rel="stylesheet">
   
	<title>Aeronews TV - La chaine 100% aéro !</title>
  </head>
  <body>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center mt-2">
				<img src="images/aeronews.png" class="logo w-25" alt="logo">
			</div>
		</div>
			
		<div class="row m-3 mt-0">
			<div class="row row-cols-1 row-cols-md-1 g-4">

			<?
				for($i=0; $i < 1; $i++) 
				{
					$url = $xml->entry[$i]->link->attributes();
					$videourl = explode("&",$url['href']);
					$video = str_replace("https://www.youtube.com/watch?v=","",$videourl[0]);
					
					?>
						<div class="col">
							<div class="card border-0">
							<iframe height="350" src="https://www.youtube.com/embed/<?=$video?>" frameborder="0" allowfullscreen></iframe></p>
									<div class="card-body px-0">
										<h5 class="card-title"><?=$xml->entry[$i]->title?></h5>
										<p>Posté sur le <?=date('jS M Y h:i:s', strtotime($xml->entry[$i]->published))?></p>
									</div>
							</div>
						</div>

					<?
				}
			?>

			</div>
		</div>

		<div class="row m-3">
			<div class="row row-cols-1 row-cols-md-2 g-4">

			<?
				for($i=1; $i < ($count); $i++) 
				{
					$url = $xml->entry[$i]->link->attributes();
					$videourl = explode("&",$url['href']);
					$video = str_replace("https://www.youtube.com/watch?v=","",$videourl[0]);
					
					?>
						<div class="col">
							<div class="card border-0">
							<iframe height="300" src="https://www.youtube.com/embed/<?=$video?>" frameborder="0" allowfullscreen></iframe></p>
									<div class="card-body px-0">
										<h5 class="card-title"><?=$xml->entry[$i]->title?></h5>
										<p>Posté sur le <?=date('jS M Y h:i:s', strtotime($xml->entry[$i]->published))?></p>
									</div>
							</div>
						</div>

					<?
				}
			?>
			
			</div>
		</div>
	</div>










    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>