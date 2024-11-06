'use strict'

module.exports = class BinaryDeepInfo {
    
    constructor (tree) {
      this.tree = tree 
    }
    
    getNode (id) {
      let _node = null
  
      this.tree.forEach(node => {
        if (node._id == String(id)) {
          _node = node
        }
      })
      
      return _node
    }
  
    getLastNodeLeft (id) {
      var last = null
      let node = this.getNode(id)

      if (node.left != null) {
        return   this.getLastNodeLeft(node.left)
      } else {
        last = node
      }

      return last
    }

    getLastNodeRight (id) {
      var last = null
      let node = this.getNode(id)
      if (node.right != null) {
          return   this.getLastNodeRight(node.right)
      } else {
        last = node
      }
      return last
    }
}
  