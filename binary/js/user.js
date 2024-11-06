'use strict'

let User = require('../dao/user')
let TreeDao = require('../dao/tree')

let Network = require('../dao/network')
let TrustDao = require('../dao/trust')
let AccountDao = require('../dao/account')
var bcrypt = require('bcrypt-nodejs')
const moment =  require('moment')

const crypto = require('crypto')
const _ = require('underscore')
const nodemailer = require('nodemailer')
const mongoose = require('mongoose')
const WewayClient =  require('../lib/core/client')


let Tree = require('../lib/tree/tree')
let {serialize} = require('../lib/tree/serialize')

module.exports = class UserController {
  async insert (req, res, next) {
    let params = req.body
    params.roles = params.roles ? params.roles : ['user']

    try {

      var formatsponsor = mongoose.Types.ObjectId.isValid(params.sponsor)
      // validate sponsor
      if (!formatsponsor) {
        throw new Error('Please send a valid sponsor!')
      }
      
      if (params.idsponsor) {
        var idsponsor = new mongoose.Types.ObjectId(params.sponsor);
        
        let sponsorResult  = await new User().sponsor(params.sponsor)
        if (!sponsorResult) {
          throw new Error('Sponsor not found!')
        }
      }      

      params.account = String(Date.now() + Math.random())
      let user = await new User().insert(params)
      console.log('user registrado', user);
      
      if (user) {
        let datatree = {
          "_id" : user._id,
          "tag" : user.username,
          "parent" : params.sponsor,
          "position" : params.position,
          "directOwner": params.directOwner,
          // "value" : exist.balance
        }
        
        let nodeIsAssigned = await new TreeDao().assignPosition(datatree)
        if (nodeIsAssigned.status == true) {
          console.log(user._id, ' fue un nodo asignado', nodeIsAssigned)
        } else {
          console.log(user._id, ' NO FUE ASIGNADO', nodeIsAssigned)
        }

        var sendemail = await (new WewayClient()).sendEmail({name: user.name, email: user.email, sendflag: 'welcome', token: null})
        console.log('send email', sendemail, user.email, user.name);
        
        res.json({message: 'new user investor was created', status: true, data: _.omit(user.toObject(), 'password')})
      } else {
        throw new Error('User can not be saved')
      }
    } catch (e) {
      res.json({message: e.message, status: false, data: null})
    }
  }

  async listMe (req, res, next) {
    let id = req.user._id
    let subscription =  new User().find(id)
    var expiresAt = moment(subscription.createdAt).add(2, 'days')
    var statusSusbcription = true

    if (moment() > expiresAt && !subscription.isActive) {
      statusSusbcription = false
    }

    let me = await new User().find(req.user._id)
    me = me.toObject();

    me.subscription = {
      status: statusSusbcription
    }

    if (me) { res.json({message: 'show me info', status: true, data: me}) } else { 
    res.json({message: 'error user not found', status: false, data: null}) }
  }

  async forgot (req, res, next) {
    // forgot password
    if (req.params.remember) {
      
      // console.log('forgot password', req.params);
      var email = req.params.remember
      let user = await new User().findGeneral({email:email})
      if (user) {
        // var token = crypto.randomBytes(10).toString('hex')

        bcrypt.genSalt(5, (err, salt) => {
          if (err) return

          var token =  Date.now() + 86400000
          bcrypt.hash( token, salt, null, async (err, hash) => {
            if (err) return

            let userUpdatePassword = await new User().update(user._id, {
              password: hash 
            })

            if (userUpdatePassword) {
              var sendemail = await (new WewayClient()).sendEmail({token: token, email: email, sendflag:'recover', name: user.name})
              console.log('send email forgot', sendemail, user.email, user.name);
            }
          })
        })
        res.json({message: 'update password successfully', status: true, data: null})
      }
    } else {
      // update
      res.json({message: 'please send an email to recover', status: false, data: null})
    }
  }

  async modify (req, res, next) {
    let params = req.body
    let account = params.account
    let me = req.user._id
    
    try {
      if (account) {
        let existAccount = await new User().findGeneral({account: account})

        if (existAccount != null && existAccount._id) {
          if ( String(req.user._id) !==  String(existAccount._id)) {
            throw new Error('the account exists, please update by other') 
          }
        }
      }

      let updateUserResult  = await new User().update(me, params)
      if (updateUserResult) {
        res.json({message: 'updating successfully', status: true, data: params})
      }
    

    } catch (error) {
      res.json({message: error.message, status: false, data: []})
    }
  }

  async active (req, res, next) {
    let params = req.body
    let id =  req.params.id
    
    try {
        let updateUserResult  = await new User().update(id, {isActive: params.isActive})
        if (updateUserResult) {
          res.json({message: 'updating successfully', status: true, data: updateUserResult})
        }
    } catch (error) {
      res.json({message: error.message, status: false, data: []})
    }
  }

  async list (req, res, next) {
    let users = await new User().list({})
    res.json({message: 'list of users', status: true, data: users})
  }
}
