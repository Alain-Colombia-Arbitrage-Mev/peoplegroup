<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');


require_once 'request-tree-get.php';
require_once 'count.php';

$my_id = $root = null;


if (isset($_GET['root'])) {
    $my_id = $_GET['root'];
    $root =  $my_id; 
}

function find($id, $data) {
    $result = null;
    
    foreach($data as $node) {
        if ($node->tag === $id) {
            $result = $node;
        }
    }

    return $result;
}

if (isset($_POST['submit']) ) {
    $search = $_POST['search'];
    global $source_tree;
    
    $find =  find($search, $source_tree->data); 
    if (count($find) > 0) {
        header('location: http://oxigeno.local/binary/visor/index.php?root='.$find->_id);
    }
}

$endpoint = "http://oxigeno.local/binary/visor/index.php?root=";

function fetch_info($userid) {

    global $source_tree;
    
    $tree = $source_tree->data; 

    $result = null;
    foreach ($tree as $k => $node) {
        if ($node->id == $userid) {
            $result = $node; 
        }
    }

  return $result;
}


$binaryCount =  new BinaryCount($source_tree->data);

$total = $binaryCount->getTotalLeg($root);
$totalLeft = $binaryCount->getTotalLeft($root);
$totalRight = $binaryCount->getTotalRight($root);

$lastNodeEmptyRight =   $binaryCount->getLastNodeRight($root);
$lastNodeEmptyLeft = $binaryCount->getLastNodeLeft($root);
$volumen = $binaryCount->getByVolumen();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/metropolis" type="text/css"/>
    <title>Binary network</title>
    <style>
    body {
        background: white;
        color:black;
        font-family: 'MetropolisRegular';
        font-weight: normal;
        font-style: normal;
        position: relative;
    }

    a {
        text-decoration: none;
        color: orange;
        font-size: 1.3em;
    }

    .actions {
        background: blue;
        text-align:center;
        padding-top: 1.4em;
        clear: both;
        position: relative;
        height: 100px;
        margin-top: 20vh;
    }
    </style>
  </head>
  <body>

  <h1><?php // print_r($volumen);?></h1>

  </div>
    <div class="card-body">
        <?php 
            $id = [$my_id];

            // die(var_dump($id));
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
                   
                <?php  $print_id =  $id[$d]; ?>
                    <?php if (null !== $print_id): ?>   
                         
                <img src="user.png" alt="" srcset="" class="img-fluid" style="width:70px">    
                <p> <a href="<?php echo $endpoint; ?><?php echo $print_id?>"><?php echo fetch_info($print_id)->tag; ?></a>  / <?php echo fetch_info($print_id)->value;?> vol</p>
                    <?php endif;?>
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

            // var_dump($result);
            return $result->$position;
        }
        ?>
    </div>

    <?php 
    $root =  $my_id; //$_GET['root']; //'61ae8165a7d82e44282d34f0'; // root origin '61ae8165a7d82e44282d34f0';
    $binaryCount =  new BinaryCount($source_tree->data);

    $total = $binaryCount->getTotalLeg($root);
    $totalLeft = $binaryCount->getTotalLeft($root);
    $totalRight = $binaryCount->getTotalRight($root);

    $lastNodeEmptyRight =   $binaryCount->getLastNodeRight($root);
    $lastNodeEmptyLeft = $binaryCount->getLastNodeLeft($root);
    ?>
    
</div>

<div class="row actions">
    <div class="col-md-4">
    <a href="<?php echo $endpoint; ?><?php echo $lastNodeEmptyLeft?>" class="btn btn-warning">  Last left</a></p>
    </div>


    <div class="col-md-4">
    <ul>
        <!-- <li>Izquierda: <?php echo ($totalLeft);?></li>
        <li>Derecha: <?php echo ($totalRight);?></li>
        <li>Total: <?php echo ($total);?></li> -->
        <li>
        <!-- <form action="/" method="POST">
        <input type="text" name="search" placeholder="buscar inversor">
        <input type="submit" name="submit" value="Buscar">
    </form> -->
        </li>
    </ul>

    
    </div>

    <div class="col-md-4">
    <a href="<?php echo $endpoint; ?><?php echo $lastNodeEmptyRight?>" class="btn btn-warning"> Last Right</a></p>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>