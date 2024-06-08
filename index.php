<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<!-- jquery ui css  -->
		  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
		
</head>
<body>
 
    <div class="container">
      <div>
         <?php include 'navbar.php' ?>
	<label for="from">From</label>
<input type="text" id="from" name="from">
<label for="to">to</label>
<input type="text" id="to" name="to">
      </div>
        <h1>Welcome to Dashboard</h1>
        <form action="movie-search.php" method="POST">
		<div class="autocomplete">
			<input type="text" id="movie-box" name="search" autocomplete="off" placeholder="Movie search..." minlength="2">
		</div>
		<input type="submit" name="submit-search" value="Search">
        <div id="movieList" class="autocomplete-items">
        </div>
	</form>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
		<!-- jquery ui js -->
		  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$("#movie-box").keyup(function(){
		var movie = $(this).val();

		if(movie != ''){
			$.ajax({
				url: "load-movie.php",
				method: "POST",
				data: {movie: movie},
				success: function(data){
					console.log(data);
					$("#movieList").fadeIn("fast").html(data);
				}
			});
		} else {
			$("#movieList").fadeOut();
		}
	});

	$(document).on('click','#movieList div',function(){
		$('#movie-box').val($(this).text());
		$('#movieList').fadeOut();
	});

  });
	// jquery data rage selector
	$( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          // defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1       })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        // defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
</script>
</body>
</html>