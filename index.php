<!DOCTYPE HTML>
<html lang='en'/>
    <head>
        <meta charset = 'utf-8'>
        <title>Arvind's masterpiece</title>
        <link rel = 'stylesheet' href = 'styles.css'/>
        <link rel = 'stylesheet' href = 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'/>
        <!--link rel=stylesheet href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /-->
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <img src = "images/YO.png"/>
            <img id = "logo" src = "images/You Logo.png"/>
        </header>
        <hr id="divider">
        <div class = 'container'>
            
            <!--div class = 'answer-question'>
                <button>Answer question</button>
            </div>
            <div class = 'new-question'>
                <button>Ask question</button>
            </div-->
            
            
            <div class = 'dropdown'></div>
    <?php
    include "functions/sql.php";
    function fnPost($db, $postId) {
        $query = "select p.Title, p.Content, p.DateCreated, u.userWho, u.userWhere
        from Posts p
        join Users u on u.id = p.userId
        where p.id=$postId";
       // $query = trim(preg_replace('/\s+/', ' ', $query));
        $result = mysqli_query($db, $query);
         $posts = array();
        if ($result)
          {
              //var_dump($result);
             
          // Fetch one and one row
          while ($row=mysqli_fetch_row($result))
            {
                $post = array("title" => $row[0], "content" => $row[1], "dateCreated" => $row[2],
                            "userWho" => $row[3], "userWhere" => $row[4]);
            }
            
          // Free result set
          mysqli_free_result($result);
        }
        else {
            echo mysqli_error($db);
        }
        include "templates/post.php";
        return $post;
        }
    function fnAnswers($db, $postId) {
        $query = "select '', answer.Content, answer.DateCreated, u.userWho, u.userWhere
        from Comments answer
        join Users u on u.id = answer.userId
        where answer.postId=$postId";
       // $query = trim(preg_replace('/\s+/', ' ', $query));
        $result = mysqli_query($db, $query);
        $posts = array();
        if ($result)
          {
              //var_dump($result);
             
          // Fetch one and one row
          while ($row=mysqli_fetch_row($result))
            {
                $post = array("" => $row[0], "content" => $row[1], "dateCreated" => $row[2],
                            "userWho" => $row[3], "userWhere" => $row[4]);
                include "templates/answer.php";
            }
            
          // Free result set
          mysqli_free_result($result);
        }
        else {
            echo mysqli_error($db);
        }
        
    }
    ?>
    <?php
    //$questionId = isset($_GET["id"]) ? $_GET["id"] : 1;
    if (isset($_GET["id"])) {
        $questionId = $_GET["id"];  
    }
    else {
        $questionId = 8;
        echo "<script>(function() {
            var loc = location.href;        
            loc += loc.indexOf(\"?\") === -1 ? \"?\" : \"&\";
            
            location.href = loc + \"id=$questionId\";
        })();</script>";
    }
    
    fnPost($db, $questionId);
    fnAnswers($db, $questionId);
    ?>
    </div>
    
  <div id = 'new-question-dialog' class="hidden" title="Add new post">
     <form action="api.php" method="post">
         <input type="hidden" name="query" value="newPost">
         Who? <input type="text" name="userWho" required /><br>
         Where? <input type="text" name="userWhere" required /><br><br>
         Question:<br><input type="text" name="title" required /><br>
         <!--Content <textarea name="content" required></textarea><br>-->
         <input type=hidden name="content" value=""><br>
         <input type="Submit">
     </form>
  </div>
  <div id = 'answer-question-dialog' class = "hidden" title = "Answer question">
      <form action="api.php" method="post">
          <input type="hidden" name="postId" value="<?php echo $questionId; ?>">
          <input type="hidden" name="query" value="newComment">
          Who? <input type = "text" name = "userWho" required /><br>
          Where? <input type = "text" name = "userWhere" required /><br><br>
          <input type=hidden name=content value="" />
          Answer:<br>
          <section id="answerContent" contenteditable="true">
            <ul>
                <li></li>
          </ul>

</section><br>
          <input type = "Submit">
      </form>
  </div>
  <div id="loadingDiv"></div>

        <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
  <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
  <script src="main.js"></script>

</body>
</html>
<?php
mysqli_close($db);
