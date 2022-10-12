<?php
if (!empty($_REQUEST['matchId'])) {
	$matchid = $_REQUEST['matchId'];
	
	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://cricbuzz-cricket.p.rapidapi.com/mcenter/v1/$matchid/hscard",
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cricket Score Board</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#3d403d;color: white;">
  <h2 style="text-align: center;">Scorecard</h2>
  <hr size="1" width="100%">
  <div class="header" style="width:100%; display: flex; justify-content: center;">
    <div class="left" style="margin-left: 250px;width:500px;">
      <p style="font-size:20px;font-weight: bold;"><?php echo $response['scoreCard']['0']['batTeamDetails']['batTeamShortName']?></p>
      <p><?php echo $response['scoreCard']['0']['scoreDetails']['runs']?>/
      	<?php echo $response['scoreCard']['0']['scoreDetails']['wickets']?>(<?php echo $response['scoreCard']['0']['scoreDetails']['overs']?>)</p>
      </div>
      <div class="right1" style="margin-left: 130px;width:250px;">
        <p style="font-size:20px;font-weight: bold;"><?php echo $response['scoreCard']['1']['batTeamDetails']['batTeamShortName']?></p>
        <p><?php echo $response['scoreCard']['1']['scoreDetails']['runs']?>/
         <?php echo $response['scoreCard']['1']['scoreDetails']['wickets']?>(<?php echo $response['scoreCard']['1']['scoreDetails']['overs']?>)</p>
       </div>
     </div>
     <hr size="1" width="100%">
     <div class="container">
      <div class="right" style="margin-top:20px">
        <p style="text-align:center;font-stretch: expanded;font-size: 20px;color: yellow;"><?php echo $response['status'] ?></p>
      </div>
      <div class="scorecard">

        <!-- ----- -->
        <h4 style="font-weight:bold;width:auto;background-color:grey;padding:3px"><?php echo $response['scoreCard']['0']['batTeamDetails']['batTeamName']?>  Innings</h5>
          <table class="table table-dark" >
            <thead>
              <tr>
                <th scope="col">batter</th>
                <th scope="col"> </th>
                <th scope="col">Runs</th>
                <th scope="col">Balls</th>
                <th scope="col">4s</th>
                <th scope="col">6s</th>
                <th scope="col">sr</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for($i=0;$i<1;$i++)
              {
                $count1=count($response['scoreCard'][$i] ['batTeamDetails']['batsmenData']);
                for($j=1;$j<=11;$j++)
                {

                  ?>
                  <tr>
                    <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['batName'] ?></td>
                    <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['outDesc'] ?></td>
                    <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['runs'] ?></td>
                    <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['balls'] ?></td>
                    <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['fours'] ?></td>
                    <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['sixes'] ?></td>
                    <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['strikeRate'] ?></td>
                  </tr>
                  <?php
                }
              }
              ?>
              <tr>
                <td>Extras</td>
                <td></td>
                <td><?php echo $response['scoreCard']['0'] ['extrasData']['total']?>(nb  <?php echo $response['scoreCard']['0'] ['extrasData']['noBalls']?>,b  <?php echo $response['scoreCard']['0'] ['extrasData']['byes']?>,lb  <?php echo $response['scoreCard']['0'] ['extrasData']['legByes']?> ,w  <?php echo $response['scoreCard']['0'] ['extrasData']['wides']?> ,p  <?php echo $response['scoreCard']['0'] ['extrasData']['penalty']?>)</td>
              </tr>
            </tbody>  
          </table>
          <hr>
          <h4 style="font-weight:bold;width:auto;background-color:grey;padding:3px">Fall of wickets</h5>
            <?php
            for($i=0;$i<1;$i++)
            {
              $count1=count($response['scoreCard'][$i]['wicketsData']);
              for($j=1;$j<=$count1;$j++)
              {
                ?>
                <p style="float: left;">
                  <?php echo $response['scoreCard'][$i]['wicketsData']['wkt_'.$j]['wktRuns']?>-
                  <?php echo $response['scoreCard'][$i]['wicketsData']['wkt_'.$j]['wktNbr']?>(
                  <?php echo $response['scoreCard'][$i]['wicketsData']['wkt_'.$j]['batName']?>,
                  <?php echo $response['scoreCard'][$i]['wicketsData']['wkt_'.$j]['wktOver']?>)
                </p>
                <?php
              }
            }
            ?>
            <table class="table table-dark"  >
              <thead>
                <tr>
                  <th scope="col">bowler</th>
                  <th scope="col">Over</th>
                  <th scope="col">maiden</th>
                  <th scope="col">runs</th>
                  <th scope="col">wickets</th>
                  <th scope="col">ER rate</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for($i=0;$i<1;$i++)
                {
                  $count1=count($response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']);
                  for($j=1;$j<=$count1;$j++)
                  {

                    ?>
                    <tr>
                      <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['bowlName'] ?></td>
                      <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['overs'] ?></td>
                      <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['maidens'] ?></td>
                      <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['runs'] ?></td>
                      <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['wickets'] ?></td>
                      <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['economy'] ?></td>
                    </tr>
                    <?php
                  }
                }
                ?>

              </tbody>
            </table>
          </div>

          <div class="scorecard">

            <!-- ----- -->
            <h4 style="font-weight:bold;width:auto;background-color:grey;padding:3px"><?php echo $response['scoreCard']['1']['batTeamDetails']['batTeamName']?>  Innings</h5>
              <table class="table table-dark" >
                <thead>
                  <tr>
                    <th scope="col">batter</th>
                    <th scope="col"> </th>
                    <th scope="col">Runs</th>
                    <th scope="col">Balls</th>
                    <th scope="col">4s</th>
                    <th scope="col">6s</th>
                    <th scope="col">sr</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for($i=1;$i<=1;$i++)
                  {
                    $count1=count($response['scoreCard'][$i]['batTeamDetails']['batsmenData']);
                    for($j=1;$j<=$count1;$j++)
                    {
                      ?>
                      <tr>
                        <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['batName'] ?></td>
                        <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['outDesc'] ?></td>
                        <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['runs'] ?></td>
                        <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['balls'] ?></td>
                        <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['fours'] ?></td>
                        <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['sixes'] ?></td>
                        <td><?php echo $response['scoreCard'][$i] ['batTeamDetails']['batsmenData']['bat_'.$j]['strikeRate'] ?></td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
                  <tr>
                    <td>Extras</td>
                    <td></td>
                    <td><?php echo $response['scoreCard']['1'] ['extrasData']['total']?>(nb  <?php echo $response['scoreCard']['1'] ['extrasData']['noBalls']?>,b  <?php echo $response['scoreCard']['1'] ['extrasData']['byes']?>,lb  <?php echo $response['scoreCard']['1'] ['extrasData']['legByes']?> ,w  <?php echo $response['scoreCard']['1'] ['extrasData']['wides']?> ,p  <?php echo $response['scoreCard']['1'] ['extrasData']['penalty']?>)</td>
                  </tr>
                </tbody>
              </table>
              <hr>
              <h4 style="font-weight:bold;width:auto;background-color:grey;padding:3px">Fall of wickets</h5>
                <?php
                for($i=1;$i<=1;$i++)
                {
                  $count1=count($response['scoreCard'][$i]['wicketsData']);
                  for($j=1;$j<=$count1;$j++)
                  {
                    ?>
                    <p style="float: left;">
                      <?php echo $response['scoreCard'][$i]['wicketsData']['wkt_'.$j]['wktRuns']?>-
                      <?php echo $response['scoreCard'][$i]['wicketsData']['wkt_'.$j]['wktNbr']?>(
                      <?php echo $response['scoreCard'][$i]['wicketsData']['wkt_'.$j]['batName']?>,
                      <?php echo $response['scoreCard'][$i]['wicketsData']['wkt_'.$j]['wktOver']?>)
                    </p>
                    <?php
                  }
                }
                ?>

                <table class="table table-dark"  >
                  <thead>
                    <tr>
                      <th scope="col">bowler</th>
                      <th scope="col">Over</th>
                      <th scope="col">maiden</th>
                      <th scope="col">runs</th>
                      <th scope="col">wickets</th>
                      <th scope="col">ER rate</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for($i=1;$i<=1;$i++)
                    {
                      $count1=count($response['scoreCard'][$i]['bowlTeamDetails']['bowlersData']);
                      for($j=1;$j<=$count1;$j++)
                      {
                        ?>
                        <tr>
                          <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['bowlName'] ?></td>
                          <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['overs'] ?></td>
                          <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['maidens'] ?></td>
                          <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['runs'] ?></td>
                          <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['wickets'] ?></td>
                          <td><?php echo $response['scoreCard'][$i] ['bowlTeamDetails']['bowlersData']['bowl_'.$j]['economy'] ?></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>

                  </tbody>
                </table>
<!-- </div>
<h4 style="font-weight:bold;width:auto;background-color:black;color:white;padding:3px">Match Info</h5>
</div> -->
</body>
</html>