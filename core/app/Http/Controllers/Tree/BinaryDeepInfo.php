<?php


namespace App\Http\Controllers\Tree;

class BinaryDeepInfo {
    private $tree;

    public function __construct($tree) {
        $this->tree = $tree;
    }

    public function getNode($id) {
        $node = null;

        foreach ($this->tree as $n) {
            if ($n->id == strval($id)) {
                $node = $n;
                break;
            }
        }

        return $node;
    }

    public function getLastNodeLeft($id) {
        $last = null;
        $node = $this->getNode($id);

        if ($node->left != null) {
            return $this->getLastNodeLeft($node->left);
        } else {
            $last = $node;
        }

        return $last;
    }

    public function getLastNodeRight($id) {
        $last = null;
        $node = $this->getNode($id);

        if ($node->right != null) {
            return $this->getLastNodeRight($node->right);
        } else {
            $last = $node;
        }

        return $last;
    }
}