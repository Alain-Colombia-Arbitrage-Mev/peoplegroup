<?php 

require_once 'request-tree-get.php';
require_once 'count.php';
$my_id = $_GET['root'];
$packs = [500, 1000, 3000];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Binario</title>
  </head>
  <body>
    <h1>Binary</h1>

    <div class="card-body">
        <?php 
            $id = [$my_id];

            $i = 0;
            for ($i; $i <= 2; $i++) {
                $temp_id_index = 0;
                $divide = pow(2, $i);
        ?>
            <div class="row p-3">
            <?php  
            for ($d = 0; $d < $divide; $d++) {
            ?>
                <div class="col-<?php echo 12/$divide?> p-3 text-center">
                    <img src="user.png" alt="" srcset="" class="img-fluid" style="width:50px">    
                    <p><?php echo $print_id =  $id[$d]; ?> / $<?php echo $packs[$i]?>;</p>
                </div>

                <?php
                for ($p = 0; $p <2; $p++) {
                    $temp_id[$temp_id_index] = fetch_left_right($p, $print_id);
                    $temp_id_index++;
                }
            }

            $id = $temp_id;
            
            ?>
            </div>
        <?php 
        } 

        function fetch_left_right($side, $userid) {
            global $source_tree;

            $tree = $source_tree->data;
            if ($side == 0) {
                $position = 'left';
            } else {
                $position = 'right';
            }

            $result = null;
            foreach ($tree as $k => $node) {
                if ($node->id == $userid) {
                    $result = $node; 
                }
            }

            return $result->$position;
        }
        ?>
    </div>


    <?php 
    $binaryCount =  new BinaryCount($source_tree->data);
    $root =  $_GET['root'];
    $total = $binaryCount->getTotalLeg($root);
    $totalLeft = $binaryCount->getTotalLeft($root);
    $totalRight = $binaryCount->getTotalRight($root);
    ?>

    <div class="container">
  <div class="row">
    <div class="col">
      Total izquierdo:
    <?php  echo $totalLeft;?>
    </div>
    <div class="col">
        Total:
        <?php echo $total; ?>
    </div>
    <div class="col">
      Total derecho:
      <?php echo $totalRight; ?> 
    </div>
  </div>
</div>


<div class="row actions">
    <div class="col-md-4">
    <a href="<?php echo $endpoint; ?><?php echo $lastNodeEmptyLeft?>" class="btn btn-info">  Ultimo izquierda</a></p>
    </div>


    <div class="col-md-4">
    <ul>
        <!-- <li>Izquierda: <?php echo ($totalLeft);?></li>
        <li>Derecha: <?php echo ($totalRight);?></li>
        <li>Total: <?php echo ($total);?></li> -->
        <li>
        <form action="/" method="POST">
        <input type="text" name="search" placeholder="buscar inversor">
        <input type="submit" name="submit" value="Buscar">
    </form>
        </li>
    </ul>

    
    </div>

    <div class="col-md-4">
    <a href="<?php echo $endpoint; ?><?php echo $lastNodeEmptyRight?>" class="btn btn-info"> Ultimo derecha</a></p>
    </div>
</div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>