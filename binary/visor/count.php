<?php 
require_once 'request-tree-get.php';

// $memid="61ae73d81e09af398df87909";   // your id

class BinaryCount  {
    private $_data;
    private $total;

    public function __construct ($data) {
        $this->total = 0;
        $this->_data = $data;
    }
    
    //allcount
    public function getChilds ($id) {
        $result = [];

        foreach ($this->_data as $k => $node) {
            if ( $node->id === $id) {
                array_push($result,   $node); 
            }
        }
    
        return $result;
    }

    public function levels () {
        
    } 


    public function getNode ($id) {
        $result = null;
        foreach ($this->_data as $k => $node) {
            if ( $node->id === $id  ) {
                $result = $node; 
            }
        }

        return $result;
    }

    // public function traverse ($node, $count = 0) {
        
    //     if ($node == null) {
    //         return null;
    //     }

    //     if (isset($node->left)) {
    //         echo 'count is left '. $count;
    //         print_r($node);
    //         $count++;
    //         traverse($nodo->left, $count);
    //     } 
    // }

    public function getTotalLeft($id) {
        $node = $this->getNode($id);
        $count = 0;

        if (!empty($node->left)) {
            $count += $this->getTotalLeg($node->left);
        }
                    
        return $count;
    }

    public function getTotalRight($id) {
        $node = $this->getNode($id);
        $count = 0;
        
        if (!empty($node->right)) {
            $count += $this->getTotalLeg($node->right);
        }
                    
        return $count;
    }

    public function getTotalLeg($id) {
        $childs = $this->getChilds($id);
        $count = 1;
        foreach ($childs as $child) {
            if (!empty($child->left)) {
                $count += $this->getTotalLeg($child->left);
            }
            
            if (!empty($child->right)) {
                $count += $this->getTotalLeg($child->right);
            }
        }
        // $totalCount =  $count + 1;
        return $count;
    }

    public function getLastNodeRight ($id) {
        $last = null;
        $node = $this->getNode($id);
        if (!empty($node->right)) {
            return $this->getLastNodeRight($node->right);
        } else {
            $last =  $node->id;
        }

       return $last;
    }

    public function getByVolumen() {
        $result = [];
        foreach ($this->_data as $k => $node) {
            if ( $node->value > 0  ) {
                array_push($result, $node->value . "-". $node->tag . '/' . 'position: '. $node->position ); 
            }
        }

        return $result;
    }

    public function getLastNodeLeft ($id) {
        $last = null;
        $node = $this->getNode($id);

        
        if (!empty($node->left)) {
            return $this->getLastNodeLeft($node->left);
        } else {
            $last =  $node->id;
        }

        
       return $last;
    }

}

