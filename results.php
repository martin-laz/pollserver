<?php
//include and initialize Poll class
include './pollClass.php';
$poll = new Poll;

//get poll result data
$pollResult = $poll->getResult($_GET['pollID']);
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="css/indexStyle.css" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</head>
<body>
  <div class="phone">
    <div class="pollContent">
      <div class="form">
        <div class="heading">
          <a id="close">+</a>
          <span><?php echo $pollResult['poll']; ?></span>
        </div>

        <div class="message">Благодаря, че гласувахте!</div>
        <div class="wrapper">
            <ul class="results">
            <?php
            if(!empty($pollResult['options'])){ $i=0;
              //Option bar color class array

              //Generate option bars with votes count
              foreach($pollResult['options'] as $opt=>$vote){
                //Calculate vote percent
                $votePercent = round(($vote/$pollResult['total_votes'])*100);
                $votePercent = !empty($votePercent)?$votePercent.'%':'0%';

                echo '<li><div class="percentage">' . $votePercent . '</div><div class="label">'.$opt.'</div><div class="progressbar" data-percentage="' . $votePercent . '"></div></li>';

              $i++; } } ?>
            </ul>
        </div>
        <div class="total_votes">Всички Гласове: <?php echo $pollResult['total_votes']; ?></div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="index.js"></script>
</body>
</html>
