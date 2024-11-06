'use strict'

const NetworkDao = require('../dao/network')
const TreeDao = require('../dao/tree')
const User = require('../dao/user')
const BinaryCountVolumen = require('../lib/tree/binaryCountVolumen')
const BinaryDeepInfo =  require('../lib/tree/binaryDeepInfo')
const _ = require('underscore')

const config = require('../config/app')

function NetworkController () {
  return {
    partnersDirects: async (req, res) => {
      let user = req.user._id // ideal : 61b2a8e9f596dd61f9a50dcb
      let meDirects = await new TreeDao().list({directOwner: user})
      let response = []

      if (meDirects.length) {

        response = _.map(meDirects, async function (node) {
          node = node.toObject()
          var user =   await new User().findGeneral({_id: node._id})
          user.toObject()
          node.degree = user.rankDegree
          node.username = user.username
          node.mobile = user.mobile
          node.email = user.email
          return node
        })
      }

      res.json({message: 'listing your partners', response: await Promise.all(response), status: true})

    },
    commissions: async (req, res) => {
      let user = req.user._id 
      let tbl_commissions = []
      
      function Commission (from, to, level, val) {
        this.from = from
        this.to = to
        this.level = level
        this.val = val,
        this.date = new Date()
      }


function Profit (pair, level, blue) {
  this.pair = pair 
  this.level = level
  this.blue = blue

  this.splitProfit = function () {
    var total = this.blue 
    var fifty =  total * .50
    let result = {
      inversor: fifty, 
      company: fifty / 2,
      network: fifty / 2
    }

    return result
  }
}

      var blue = 100 //usd in last trade
      let profit = new Profit('EURUSD', 1, 100)
      var  utility = profit.splitProfit()

      var level = 1 
      if (level == 1) {

        function computedCommision (valor, level) {
          let settingsCommission = [.10, .08, .06, .03, .01, .005]
          return valor * settingsCommission[level-1]
        }

        console.log('utilidad para repartir', utility.network);
        
        let commissionlevel = computedCommision(utility.network, level)

        tbl_commissions.push(
          new Commission('g', 'd', level, commissionlevel)
        )
      }

      var response = tbl_commissions
      // console.log(response);
      
       // 1. tradear el paompany 
      // 2. guardar resultado {pair, lote, risk, entry, earn, loss }
      // 3. si obtuvo beneficio
      // 4. partir el beneficio VALOR $USD entre :
      // ---> 50% inversor 
      // ---> 50% company 
      // ---------> 25% red
      // ---------> 25% c


      res.json({message: 'listing profits of your network', response: response, status: true})
    },

    list: async (req, res) => {
        var response = {};
        let root = req.user._id
        
        let tree = await new TreeDao().list()
  
        let count = new BinaryCountVolumen(tree)
        let left = count.getTotalLeft(root)
        let right = count.getTotalRight(root)

        let total_right = 0
        let total_left  = 0

        for (var i = 0; i< left.length; i++) {
          total_left += left[i].volumen
        }

        for (var i = 0; i< right.length; i++) {
          total_right += right[i].volumen
        }

        // console.log('right is', total_right);
        
        response.left = {volumen: total_left}
        response.right = {volumen: total_right} 
        
        let minor = Math.min(left.volumen, right.volumen)
        let power = Math.max(left.volumen, right.volumen)

        var rate = 0.5
        var total = (minor * rate ) / 100
        // Vol Equipo de poder: (' + power + 'pts ) ---- Vol Equipo de pago: (' + minor + 'pts) 
        var msg = 'Felicitaciones, Tu bono binario [0.5%] es  (' + total + ' pts)';

        response.power = power 
        response.minor = minor
        response.amount = total 
        response.message = msg

        // generate links by deep legs
        let deepBInaryInfo = new BinaryDeepInfo(tree)
        let lastLeftId =  deepBInaryInfo.getLastNodeLeft(root)._id
        let lastRightId = deepBInaryInfo.getLastNodeRight(root)._id
        
        // console.log('last left', lastLeftId )
        // console.log('last right', lastRightId)
        // ref  (past)= req.user._id
        let medirect = req.user._id

        response.links = [
          generatePartnerLink(lastLeftId,  medirect, 'left',), // left 
          generatePartnerLink(lastRightId, medirect, 'right')
        ]

        function generatePartnerLink (parent, direct, leg) {
          return config.endpoint+parent+'&leg='+leg+'&direct='+direct
        }

        res.json({message: 'listing info of your network {'+req.user.name + '}', status: true, data: response})
    }
  }
}

module.exports = NetworkController
