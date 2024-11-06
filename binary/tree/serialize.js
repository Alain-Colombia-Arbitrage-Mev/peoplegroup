let MARKER = Number.MAX_VALUE;
const Node = require('./node')
const Tree = require('./tree')

var data = []
let serialize = function(root) {
    
    if (!root) {
      data.push(MARKER);
      return;
    }
  
    let node = root.root
    // const queue = [root]
    
    data.push(node.value + '/' + JSON.stringify(node.position));
    serialize(node.left, data);
    serialize(node.right, data);
    return data;
    // return JSON.stringify(data)
  };

  // let deserialize = function(stream) {
  //   try {
  //     let data =  stream.shift();
      
  //     if (data === MARKER) {
  //       return null
  //     }
      
  //     // console.log('data',data.split('/'));
  //     const spl = data.split('/')
      
  //     let node = new Node(Number(spl[0]))
  //     node.position = JSON.parse(spl[1])

  //     node.left = deserialize(stream)
  //     node.right = deserialize(stream)

  //     return node
  //   } catch (error) {
  //     return null
  //   }
  // };



  let deserialize = function(stream) {
    try {
      let data =  stream.shift();
      
      if (data === MARKER) {
        return null
      }
      
      // console.log('data',data.split('/'));
      const spl = data.split('/')
      
      var tree = new Tree()

      let node = new Node(Number(spl[0]))
      node.position = JSON.parse(spl[1])

      tree.addValue(Number(spl[0]), 'tag')

      tree.root.left = deserialize(stream)
      tree.root.right = deserialize(stream)

      return tree
    } catch (error) {
      return null
    }
  };

module.exports = {serialize, deserialize}