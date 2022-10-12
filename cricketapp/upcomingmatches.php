<?php
$url="https://api.cricapi.com/v1/cricScore?apikey=22a44130-84cf-4a6a-b129-c9ebb35ddb8f";
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$result=curl_exec($ch);
curl_close($ch);
$result=json_decode($result,true);
$result = $result['data'];
    // echo "<pre>";
    // print_r($result);
    //  echo "</pre>";
$count=count($result);
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
      background-color: black;
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
<body style="background-image: url(black.jpg);">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Cricket App</a>
      </div>
      <ul class="nav navbar-nav">
        
        <li><a href="latest.php">Current Matches</a></li>
        <li class="active"><a href="upcomingmatches.php">Upcoming Matches</a></li>
      </ul>
    </div>
  </nav>
  <?php 
  for($i=0;$i<$count;$i++)
  {
    ?>
    <div class="main" style="margin-top: 5rem;">
      <p class="head">Upcoming Matches</p><br>
      <table class="table">
        <tr>
          <td>
            <img class="flag" src="<?php echo $result[$i]['t1img'] ?>" alt="">&emsp;<span><?php echo $result[$i]['t1'] ?></span><br><br>
          </td>
          <td class="right1">
            <span><?php echo $result[$i]['t2'] ?></span>&emsp;<img class="flag" src="<?php echo $result[$i]['t2img'] ?>" alt=""><br><br>
          </td>
        </tr>
      </table>
      <center>
        <p class="target"><u><?php echo $result[$i]['matchType']?></u></p>
        <p class="res"><?php echo $result[$i]['dateTimeGMT'] ?></p>
        <p class="match"><?php echo $result[$i]['status'] ?></p>
      </center>
    </div>

    <?php
  }
  ?>

  