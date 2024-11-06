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
  
    getTotalLeg (id) {
      var tmp = this.getNode(id)
      
      var info = {
        volumen: tmp.value,
        owner: tmp.tag
      }


      console.log(info);
      
      
      if (tmp.left != null) {
        var voltmp = this.getNode(tmp.left).value
        if (voltmp >= 500) {
          info.volumen += voltmp 
        } 
        this.getTotalLeg(tmp.left)
      }
  
      if (tmp.right != null) {
        var voltmp = this.getNode(tmp.right).value 
        info.volumen += voltmp 
        this.getTotalLeg(tmp.right)
      }
        
      return info
    }
}
  