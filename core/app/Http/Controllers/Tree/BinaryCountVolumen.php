<?php

namespace App\Http\Controllers\Tree;


class BinaryCountVolumen {
    
    private $tree;
    
    public function __construct($tree) {
        $this->tree = $tree;
    }
    
    private function getNode($id) {
        $_node = null;
        
        foreach ($this->tree as $node) {
            if ($node->id === intval($id)) {
                $_node = $node;
            }
        }
        
        return $_node;
    }
    
    public function getTotalLeft($id) {
        $node = $this->getNode($id);
        $volumen = 0;
        
        if ($node->left != null) {
            $volumen = $this->getTotalLeg($node->left);
        }
        
        return $volumen;
    }
    
    public function getTotalRight($id) {
        $node = $this->getNode($id);
        $volumen = 0;
        
        if ($node->right != null) {
            $volumen = $this->getTotalLeg($node->right);
        }
        
        return $volumen;
    }
    
    private function getTotalLeg($id, &$data = []) {
        $tmp = $this->getNode($id);
        
        if ($tmp->value >= 0) {
            array_push($data, ['tag' => $tmp->tag, 'volumen' => $tmp->value]);
        }

        if ( !empty($tmp->left)) {
            $this->getTotalLeg($tmp->left, $data);
        }
        
        if (!empty($tmp->right)) {
            $this->getTotalLeg($tmp->right, $data);
        }

        return $data;
    }
}

?>
