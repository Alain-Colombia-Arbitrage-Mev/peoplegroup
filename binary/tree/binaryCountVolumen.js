'use strict'

module.exports = class BinaryCountVolumen {
    
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
  
    getTotalLeft (id) {
     let node = this.getNode(id)
     var volumen = 0
     
     if (node.left != null) {
        volumen = this.getTotalLeg(node.left)
     }
  
     return volumen
    }
  
    getTotalRight (id) {
      let node = this.getNode(id)
      var volumen = 0
      
      if (node.right != null) {
        volumen = this.getTotalLeg(node.right)
      }
   
      return volumen
    }
  
    getTotalLeg (id, data = []) {
      var tmp = this.getNode(id)

      if ( Number(tmp.value) >= 500) {
        data.push({tag: tmp.tag, volumen: tmp.value })
      }

      if (tmp.left != null) {
        this.getTotalLeg(tmp.left, data)
      } 
      
      if (tmp.right != null) {
        this.getTotalLeg(tmp.right, data)
      } 

      return data;
    }
}
  