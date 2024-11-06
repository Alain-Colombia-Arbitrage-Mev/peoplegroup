
'use strict'
const Node = require('./node')

function Tree () {
    this.root = null
    this.count = 0
    this.axisX = 200
    this.axisY = 80
    this.startPosition = {x: 600, y:44}
}

Tree.prototype.dfsInOrder = function  (root) {
    var result = [] // {left: [], right: []}

    const traverse = node => {
        if (node.left) {
            traverse(node.left)
        }  
        
        result.push(node.value)
        // if (node.value == cutRoot) return 
        
        if (node.right)  {
            traverse(node.right)
            // result.right.push(node.value)
        }
    }

    traverse(this.root)

    return result     
}


Tree.prototype.left = function  (root) {
    var result = [] // {left: [], right: []}

    const traverse = node => {
        if (node.left) {
            traverse(node.left)
        }  
        
        if (node.value == root) return 
        result.push(node.value)
        
        if (node.right)  {
            traverse(node.right)
        }
    }

    traverse(this.root)

    return result     
}

Tree.prototype.right = function  (root) {
    var result = [] // {left: [], right: []}

    const traverse = node => {
        if (node.right)  {
            traverse(node.right)
        }
        
        if (node.value == root) return
        result.push(node.value)

        if (node.left) {
            traverse(node.left)
        }  
    }

    traverse(this.root)

    return result     
}


Tree.prototype.dfsPreOrder = function  () {
    var result = []

    const traverse = node => {
        result.push(node.value)
        
        if (node.left) traverse(node.left)
        
        if (node.right) traverse(node.right)
    }

    traverse(this.root)
    
    return result 
}

Tree.prototype.min = function () {
    let current = this.root
    while (current.left) {
        console.log('en brazo menor', current.value);
        current = current.left
    }

    return current
}

Tree.prototype.max = function () {
    let current = this.root
    while (current.right) {
        current = current.right
    }

    return current.value
}

Tree.prototype.size = function () {
    return this.count
}

Tree.prototype.traverse = function () {
    this.root.visit() 
}

Tree.prototype.getPosition = function ({x, y}, isLeft = false) {
    return {x: isLeft ? x - this.axisX  + y : x + this.axisX - y, y: y+ this.axisY}
}

Tree.prototype.addValue = function (value, tag) {
    this.count++

    var node = new Node(value, tag)

    if (this.root === null) {
        node.position = this.startPosition
        this.root = node
    } else {
        var  root = this.root 
        // new 
        while (root) {
            
            if (root.value == value) 
            break;
            
            if (node.value > root.value) {
                if  (root.right == null) {
                    node.position = this.getPosition(root.position)
                    root.right = node
                    break;
                }
                root = root.right

            } else {
                if (root.left == null) {
                    node.position = this.getPosition(root.position, true)
                    root.left = node
                    break;
                }
                root = root.left
            }
        }
    }
}

Tree.prototype.search = function (val) {
    var found = this.root.search(val)
    return found 
}

// Tree.prototype.draw = function (node, ctx) {
//     const color = '#'+ ( (1<<24)* Math.random() | 0).toString(16)
//     var pos = node.position
//     ctx.beginPath()
//     ctx.arc(pos.x, pos.y, node.r, 0, 2 * Math.PI);
//     ctx.fillStyle = color
//     ctx.fill()
//     ctx.stroke()
//     ctx.closePath()
//     ctx.strokeText(node.value, pos.x, pos.y)
// }


// var Line =  function (ctx) {

//     this.draw =  function (x, y, toX, toY, r) {
//         var moveToX = x
//         var moveToY = y + r 
//         var lineToX = toX
//         var lineToY =  toY - r

//         ctx.beginPath()
//         ctx.moveTo(moveToX, moveToY)
//         ctx.lineTo(lineToX, lineToY)
//         ctx.stroke()
//     }
// }

// Tree.prototype.bfs = function (ctx) {
//     const queue = []
//     const black = '#000'
//     var line = new Line(ctx)

//     queue.push(this.root)

//     const traverse = node => {
        
//         console.log('queue pushed', node);
//         // const pos = node.position
        
//         if (node.left) {
//             traverse(node.left)
//             // queue.push(node)
//         }  

//         return node
//     }

    
//     while (queue.length !== 0) {
//         // current>
//         const node = queue.shift() 
//         var _x =  node.position.x 
//         var _y =  node.position.y  

//         const color = '#'+ ( (1<<24)* Math.random() | 0).toString(16)
                
//         this.draw(node, ctx)
//         if (node.left) {
//             var child = node.left 
//             const {x, y} = node.left.position
            
//             ctx.beginPath()
//             ctx.moveTo(_x, _y + child.radius)
//             ctx.lineTo(x, y - child.radius)
//             ctx.stroke()
//             // add line    
//             line.draw(_x, _y, x, y, node.r)

//             queue.push(child)
//         }

//         if (node.right) {
//             var child = node.right 
//             const {x, y} = node.right.position

//             ctx.beginPath()
//             ctx.moveTo(x, y + child.radius)
//             ctx.lineTo(x, y + child.radius)
//             ctx.stroke()    
//             // add line
//             line.draw(_x, _y, x, y, node.r)
//             queue.push(child)
//         }
//     }
// }

module.exports = Tree