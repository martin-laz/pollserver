<?php

    if (isset($_COOKIE['poll_id'])) {
      header('Location: /pollserver/results.php?pollID=' .  $_COOKIE['poll_id']);die();
    }

    //include and initialize Poll class
    include './pollClass.php';
    $poll = new Poll;

    //get poll and options data
    $pollData = $poll->getPolls(2);
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
        <?php echo !empty($statusMsg)?'<p class="stmsg">'.$statusMsg.'</p>':''; ?>
        <form action="" method="post" name="pollFrm">
        <div class="heading">
          <a id="close">+</a>
          <span><?php echo $pollData['poll']['subject']; ?></span>
        </div>
        <div class="wrapper">
          <ul>
              <?php foreach($pollData['options'] as $opt){
                  echo '<li><label><input type="radio" name="voteOpt" value="'.$opt['id'].'" >'.$opt['name'].'</label></li>';
              } ?>
          </ul>
          <input type="hidden" name="pollID" value="<?php echo $pollData['poll']['id']; ?>">
          <button type="submit" name="voteSubmit" class="button">
            <div class="icon">
              <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="30.286px" height="36px" viewBox="0 0 30.286 36" enable-background="new 0 0 30.286 36" xml:space="preserve">
<path fill="#FFFFFF" d="M29.357,19.848c-0.552-0.68-1.337-1.081-2.271-1.159c-1.666-0.138-3.429-0.074-4.824,0.963V5.896
	c0-1.948-1.585-3.533-3.533-3.533c-0.586,0-1.132,0.157-1.619,0.412C16.763,1.191,15.352,0,13.664,0
	c-1.271,0-2.378,0.682-3.001,1.692C10.081,1.269,9.371,1.013,8.6,1.013c-1.948,0-3.533,1.585-3.533,3.533v1.109
	C4.601,5.428,4.085,5.29,3.533,5.29C1.585,5.29,0,6.875,0,8.823l0.001,14.988c0.004,0.089,0.51,8.92,11.806,8.92
	c8.064,0,10.338-2.488,11.997-4.305c0.539-0.59,0.964-1.056,1.492-1.308c2.665-1.275,4.513-2.765,4.59-2.828l0.361-0.652
	C30.277,23.399,30.506,21.264,29.357,19.848z M24.434,25.313c-0.879,0.421-1.476,1.073-2.106,1.764
	c-1.486,1.628-3.337,3.654-10.521,3.654c-9.336,0-9.792-6.723-9.807-6.962V8.823C2,7.978,2.688,7.29,3.533,7.29
	s1.533,0.688,1.533,1.533v6.668v0.277h2v-0.277V8.823V4.546c0-0.845,0.688-1.533,1.533-1.533s1.533,0.688,1.533,1.533v9.932v1.013h2
	v-1.013V4.546V3.533C12.133,2.688,12.82,2,13.665,2c0.846,0,1.533,0.688,1.533,1.533v11.945h2V5.896
	c0-0.845,0.688-1.533,1.533-1.533s1.533,0.688,1.533,1.533v16.945l1.945,0.327c0.725-2.092,1.917-2.719,4.713-2.486
	c0.392,0.033,0.672,0.167,0.881,0.422c0.405,0.496,0.489,1.341,0.482,1.892C27.664,23.457,26.243,24.448,24.434,25.313z"/>
</svg>
            </div>
            <label>Гласувай!</label>
          </button>
        </div>
        </form>
    </div>
  </div>
   <script type="text/javascript" src="index.js"></script>
</body>
</html>

<?php
//if vote is submitted
if(isset($_POST['voteSubmit'])){
    $voteData = array(
        'poll_id' => $_POST['pollID'],
        'poll_option_id' => $_POST['voteOpt']
    );
    //insert vote data
    $voteSubmit = $poll->vote($voteData);
    if($voteSubmit){
        //store in $_COOKIE to signify the user has voted
        setcookie('poll_id', $_POST['pollID'], time()+60*60*24*365);
        header('Location: /pollserver/results.php?pollID=' .  $_POST['pollID']);die();

        $statusMsg = 'Your vote has been submitted successfully.';
    }else{
        $statusMsg = 'Your vote already had submitted.';
    }
}
?>
