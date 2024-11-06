<?php

class BinaryCountVolumen {
    
    private $tree;
    
    public function __construct($tree) {
        $this->tree = $tree;
    }
    
    private function getNode($id) {
        $_node = null;
        
        foreach ($this->tree as $node) {
            if ($node->_id == strval($id)) {
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
    
    private function getTotalLeg($id, $data = []) {
        $tmp = $this->getNode($id);

        if (intval($tmp->value) >= 500) {
            $data[] = ['tag' => $tmp->tag, 'volumen' => $tmp->value];
        }

        if ($tmp->left != null) {
            $this->getTotalLeg($tmp->left, $data);
        }
        
        if ($tmp->right != null) {
            $this->getTotalLeg($tmp->right, $data);
        }

        return $data;
    }
}

?>
