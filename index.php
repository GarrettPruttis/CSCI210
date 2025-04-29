<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="style.css" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<title>Garrett's Portfolio</title>
</head>
<body>

	<h1>Welcome to Montana Tech's Livestock Auction</h1>
	<?php include 'navbar.php'; ?>
	<div id="main">
		<h2>
			Montana Tech's only online cattle retailer <br> (Unless you go to rocker)
		</h2>

	</div>
			<script>
			$(document).ready(function() {
    			// Set Basic variables
    			var slides = $('.slideshow');
    			var slideIndex = 0;
    
    			// Show the first slide
    			$(slides[slideIndex]).show();
    
    		// Set interval to change slides
			setInterval(function() {
    		  	// Hide the current slide
    		  	$(slides[slideIndex]).fadeOut();
      
    		  	// Increment index or reset to 0
    		 	slideIndex = (slideIndex + 1) % slides.length;

     			//console.log(slideIndex);
   		 		$(slides[slideIndex]).fadeIn();
   			}, 3500); 
		});
		</script>
		<div class="slides-con">

		<?php 
			include 'db_conn.php';

			$Cattle_images = scandir("Images\\");

			$scanned_directory = array_diff($Cattle_images, array('..', '.'));
			foreach($scanned_directory as $Cow_image){
				//echo(getimagesize("Images\\".$Cow_image));
				if(getimagesize("Images\\".$Cow_image)[0] == 720){
					echo "<div class='slideshow'>";
					echo "<a href='catalog.php'><img src=Images\\".$Cow_image."></a>";
					echo "</div>"; 
				}
			}
		?>


      </div>
	<div id="footer">

	</div>
</body>
</html>