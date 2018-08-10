<?php

////limpa string numerica
//function limpa($string){
//    return $resp = preg_replace('/[^0-9]/', '', $string);
//}
//
//echo limpa("3254 -98.67");

//echo getenv("HOMEDRIVE") . getenv("HOMEPATH") . '\Documents' ;

class BinaryNode
{
    public $value;    // contains the node item
    public $left;     // the left child BinaryNode
    public $right;     // the right child BinaryNode
    public $resp = array();

    public function __construct($item) {
        $this->value = $item;
        // new nodes are leaf nodes
        $this->left = null;
        $this->right = null;
    }
    
    // perform an in-order traversal of the current node
    public function dump() {
        if ($this->left !== null) {
            $this->left->dump();
        }
        var_dump($this->value);
        if ($this->right !== null) {
            $this->right->dump();
        }
    }
    
}


class BinaryTree
{
    protected $root; // the root node of our tree

    public function __construct() {
        $this->root = null;
    }

    public function isEmpty() {
        return $this->root === null;
    }
    
    public function insert($item) {
        $node = new BinaryNode($item);
        if ($this->isEmpty()) {
            // special case if tree is empty
            $this->root = $node;
        }
        else {
            // insert the node somewhere in the tree starting at the root
            $this->insertNode($node, $this->root);
        }
    }
  
    protected function insertNode($node, &$subtree) {
        if ($subtree === null) {
            // insert node here if subtree is empty
            $subtree = $node;
        }
        else {
            if ($node->value > $subtree->value) {
                // keep trying to insert right
                $this->insertNode($node, $subtree->right);
            }
            else if ($node->value < $subtree->value) {
                // keep trying to insert left
                $this->insertNode($node, $subtree->left);
            }
            else {
                // reject duplicates
            }
        }
    }
    
    public function traverse() {
        // dump the tree rooted at "root"
        return $this->root->dump();
    }
    
}

$arvore = new BinaryTree();
$arvore->insert(20);
$arvore->insert(5);
$arvore->insert(10);
$arvore->insert(2);
$arvore->insert(1.5);
$arvore->insert(3);
$arvore->insert(11);
$arvore->traverse();
