
<!DOCTYPE html>
<?php

include "config.php";



session_start();

if(!isset($_SESSION['nick']))
{
    msg("login please");
}
?>
<html lang="ko">
<head>
    <meta charset="utf-8" />
    <title>ch4n3 world - Probs</title>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="./probs_offcanvas.css" rel="stylesheet">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">ch4n3 world</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>ch4n3's Problems</h1>
            <p>You can solve a variety of interesting hacking problems.</p>
            <p>
                Nick : <?php echo($_SESSION['nick']) ?><br />
                Rank :
                <?php

                //load $mysqli
                include('./dbconfig.php');

                //query to load user's point and rank.
                $query = "SELECT point ,(SELECT COUNT(*) FROM login as t2 WHERE t2.point >= t1.point) rank FROM login t1 WHERE id=('".$_SESSION['id']."') ORDER BY point";
                $result = mysqli_fetch_array($mysqli->query($query));

                echo($result['rank'] . " ( ".$result['point']."point ) ");

                ?>
				 </p>
				 <hr>
				 <h3>Problem info</h3>
				 <p>
					 <!-- Information for probs -->
					 Total probs :
					 <?php
					 $query = "SELECT COUNT(*) AS su FROM probs";
					 $result = mysqli_fetch_array($mysqli->query($query));

					 echo($result['su'] . "<br /><br />");


					 //Category
					 $query = "SELECT category, COUNT(no) AS su FROM `probs` GROUP BY category";
					 $result = $mysqli->query($query);

					 while($rows = $result->fetch_array()) { ?>
						 <?php echo($rows['category']) ?> : <?php echo($rows['su']) ?><br />
					 <?php } ?>
            </p>
          </div>
              <div class="row">
                  <?php

                  //Loading probs

                  //query to crawl probs
                  $query = "SELECT * FROM probs WHERE 1 ORDER BY point";
                  $result = $mysqli->query($query);

                  //printing probs
                  while($rows = $result->fetch_array()) {

                      //Code to verify that it has already been solved
                      $query = "SELECT * FROM solvers WHERE no=({$rows['no']}) AND id='{$_SESSION['id']}'";
                      $re = mysqli_fetch_array($mysqli->query($query));
                      if(isset($re)) {
                          $solved = 1;
                      } else {
                          $solved = 0;
                      }

                      ?>
                      <div class="col-xs-6 col-lg-4" style="color: <?php if($solved){echo("#b2b2b2");}else{echo("black");} ?>">
                          <h3><?php echo($rows['prob']); ?></h3>
                          <p>
                              <?php
                                echo("Category : <b>" . $rows['category'] . "</b> ({$rows['point']}point)<br />");
                                echo("Authored by <b>{$rows['author']}</b>");
                              ?>
                          </p>
                          <p>
                              <?php

                              //query to count solvers
                              $query = "SELECT COUNT(*) AS solvers FROM solvers WHERE no={$rows['no']}";
                              $re = mysqli_fetch_array($mysqli->query($query));

                              echo("Solvers : " . $re['solvers']);

                              //query to load first blood
                              $query = "SELECT nick, date FROM `solvers` WHERE no={$rows['no']} ORDER BY date ASC LIMIT 1";
                              $re = mysqli_fetch_array($mysqli->query($query));
                              echo(" ( First Blood : " . $re['nick'] . ")");

                              ?>
                          </p>
                          <p>
                              <a class="btn btn-default" href="./solve.php?no=<?php echo($rows['no']) ?>" role="button">
                        <?php

                        if($solved) {
                            echo("Already Solved");
                        } else {
                            echo("Go!");
                        }

                        ?>
                        &raquo;
                    </a>
                </p>
              </div><!--/.col-xs-6.col-lg-4-->
          <?php } ?>

          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="#" class="list-group-item active">administrators</a>
            <a href="http://han3l.tistory.com" class="list-group-item">han3l</a>
            <a href="https://www.facebook.com/profile.php?id=100006588631657" class="list-group-item">키드</a>
            <a href="http://chaneyoon.tistory.com" class="list-group-item">ch4n3</a>
          </div>
        </div><!--/.sidebar-offcanvas-->
        <br /><br />
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="#" class="list-group-item active">Real-time authentication</a>
            <?php
            include('./dbconfig.php');  //$mysqli is here

            $query = "SELECT * FROM solvers WHERE 1 ORDER BY date DESC LIMIT 17";
            $result = $mysqli->query($query);

            while($rows = $result->fetch_array()) { ?>
                <?php
                //get prob's name
                $query = "SELECT prob FROM probs WHERE no=({$rows['no']})";
                $re = mysqli_fetch_array($mysqli->query($query));
                ?>
                <a class="list-group-item"><?php echo("<b>{$rows['nick']}</b> solved [{$re['prob']}]<br />{$re['date']}") ?></a>
            <?php } ?>
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>
            Front Web Designed by 함종현(WP 16)<br />
            Backend Web Designed by 정윤서(HD 15), 윤석찬(HD 16)<br />
            <br />
            @dimigo
        </p>
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="offcanvas.js"></script>
  </body>
</html>
