'use strict'

let User = require('../dao/user')
let TreeDao = require('../dao/tree')

let Network = require('../dao/network')
const crypto = require('crypto')
const _ = require('underscore')
const nodemailer = require('nodemailer')
const mongoose = require('mongoose')

let Tree = require('../lib/tree/tree')
let {serialize} = require('../lib/tree/serialize')

module.exports = class TreeController {
  async insert (req, res, next) {
    let params = req.body
    try {
      if (true) {
        // agregando al arbol
        var parentid = new mongoose.Types.ObjectId(params.parent);
        
        let existsParent = await new TreeDao().list({_id: parentid})
        if (existsParent.length > 0) {
          
          let parent = existsParent[0]
          if (parent.left && parent.right) {
            throw new Error('root is filled')
          }

          if (parent.left == null  || parent.right == null) {
            // console.log('parent founded', parent);
            var refchild = await insertNodeBase() 
            let update = null
            
            if (params.position === 'left') {
              update = await new TreeDao().update(parent._id, {
                left: refchild._id
              })
              // console.log('actualizando child left', update);
            } else if (params.position === 'right') {
              update = await new TreeDao().update(parent._id, {
                right: refchild._id
              })
            }
          } 
        } else {
          insertNodeBase()
        }

        async function insertNodeBase () {
          let insert =  new TreeDao().insert({
            tag: params.tag,
            parent: params.parent,
            left: null, 
            right: null,
            position: params.position,
            value: params.value
          })
          return insert 
        }

        // console.log('Agregando al arbol...', insertNodeBase());
        // serializar y guardar
        res.json({message: 'new node tree was created succesfully', status: true, data: []})
      } else {
        throw new Error('User can not be saved')
      }
    } catch (e) {
      res.json({message: e.message, status: false, data: null})
    }
  }

  async listMe (req, res, next) {
    let me = await new User().find(req.user._id)
    if (me) { res.json({message: 'show me info', status: true, data: me}) } else { res.json({message: 'error user not found', status: false, data: null}) }
  }

  async modify (req, res, next) {
   
  }

  async list (req, res, next) {
    await new TreeDao().list((err, tree) => {
      if (err) res.send(err)
      res.json({message: 'tree is', status: true, data: tree})
    })
  }
}
