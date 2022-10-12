
<?php
$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => "https://cricbuzz-cricket.p.rapidapi.com/matches/v1/recent",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: cricbuzz-cricket.p.rapidapi.com",
		"X-RapidAPI-Key: 71f6da107fmshcb500d66662e077p1890e8jsn9a0e7082ea73"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$response=json_decode($response,true);
// echo "<pre>";
// print_r($response);
// echo "</pre>";

$count=count($response);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>Cricket Score</title>
	<style>
		.main{
			width: 30vw;
			height: auto;
			margin-top:5rem;
			background-image: linear-gradient(to bottom right, #0d47a1, black);
			margin: auto;
			position: relative;
			top: 15vh;
			padding: 2vw;
			color: white;
		}
		;body{
			font-family: 'Roboto', sans-serif;
		}
		.flag{
			height: 3vw;
			width: 4vw;
		}
		.overs{
			color: silver;
			position: relative;
			bottom: 1vw;
		}
		.score{
			position: relative;
			bottom: 0.5vw;
			color: white;
		}span{
			color: white;
		}tr{
			border: 2px solid white;
		}.right1{
			text-align: right;
		}.head{
			font-size: 1.3vw;
		}.day{
			font-size: 1vw;
			color: silver;
		}.target{
			font-size: 1vw;
		}.res{
			font-size: 1.5vw;
		}
		.match{color: silver;
		}
	</style>
</head>
<body style="background-image:url('black.jpg');">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Cricket App</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="latest.php">Current Matches</a></li>
				<li><a href="upcomingmatches.php">Upcoming Matches</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<?php
		for($i=0;$i<$count;$i++)
		{   
			if($i==1)
			{
				continue;
			}
			else if($i==3)
			{
				continue;
			}
			$count1=count((array)($response['typeMatches'][$i]['seriesMatches']));
			for($j=0;$j<$count1;$j++)
			{
				if($j==1)
				{
					continue;
				}
				$count2=count((array)($response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches']));
				for($k=0;$k<$count2;$k++)
				{ 

					?>
					<form method="request">
						<div class="main" style="margin-top:5rem">
							<a href="details.php?matchId=<?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchInfo']
							['matchId']?>" style="color: white;text-decoration: none;">

							<p class="head"><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['seriesName'] ?> 
							<span class="right day"><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchInfo']
							['matchDesc']?></span></p><br>
							<table class="table">
								<tr>
									<td>
										<img class="flag" src="team1.png"
										alt="">&emsp;<span><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchInfo']
										['team1']['teamSName']?>     vs</span><br><br>
										<p class="score"><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchScore']['team1Score']['inngs1']['runs']?>/<?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches']['0']['matchScore']['team1Score']['inngs1']['wickets']?></p>
										<p class="overs"><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchScore']['team1Score']['inngs1']['overs']?></p>
									</td>

									<td class="right1">
										<span><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchInfo']
										['team2']['teamSName']?></span>&emsp;<img class="flag" src="team2.png" alt=""><br><br>
										<p class="score pak"><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchScore']['team2Score']['inngs1']['runs']?>/
											<?php
											if (isset($response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchScore']['team2Score']['inngs1']['wickets']))
											{
												echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchScore']['team2Score']['inngs1']['wickets'];
											}
											else{
												echo "0";
											}
										?></p>


										<p class="overs pak"><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchScore']['team2Score']['inngs1']['overs']?></p>
									</td>
								</tr>
							</table>
							<center>
								<p class="target"><u style="text-decoration: none;">Ground::<?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchInfo']
								['venueInfo']['ground']?>,<?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchInfo']
								['venueInfo']['city']?></u></p>
								<p class="res"><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchInfo']['status']?></p>
								<p class="match"><?php echo $response['typeMatches'][$i]['seriesMatches'][$j]['seriesAdWrapper']['matches'][$k]['matchInfo']['matchDesc']?></p>
							</center>
						</div>
					</form>
					<?php
				}
			}
		}
		?>
	</a>
</body>
</ht$k