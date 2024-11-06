'use strict'

function Node (value, tag) {
    this.value = value
    this.left = null
    this.right = null
    this.tag = tag
    this.position = {x:0, y:0}
    this.r = 25
}

Node.prototype.search = function (val) {
    if (this.value === val) {
        return this
    } else if (val < this.value && this.left !== null) {
        return this.left.search(val)
    } else if (val > this.value && this.right !== null) {
        return this.right.search(val)
    }

    return null
}

Node.prototype.visit = function () {

    if (this.left != null) {
        this.left.visit();
    }
    
    console.log(this.value);
    

    if (this.right != null) {
        this.right.visit()
    }
}


Node.prototype.addNode = function (node, root) {
    // let root = this.root 
    console.log(node, root);

    // if (node.value < this.value) {
    //     if (this.left == null) {
    //         node.position = root.getPosition(root.position, true)
    //         this.left = node
    //         cb({leg: 'left'})
    //     } else {

    //         this.left.addNode(node)
    //     }
        

    // } else if (node.value > this.value) {
    //     if  (this.right == null) {
    //         node.position = root.getPosition(root.position)
    //         this.right = node

    //     } else {
    //         this.right.addNode(node)
    //     }
    // } 
}


module.exports = Node;