'use strict'

const mongoose = require('mongoose')
const Schema = mongoose.Schema

let TreeSchema = new mongoose.Schema({
    value: {type: Number, default: 0},
    position: {
        type: String,
        enum: ['left', 'right', 'root']
    },
    parent: Schema.Types.ObjectId,
    left: Schema.Types.ObjectId,
    right: Schema.Types.ObjectId,
    tag: String,
    directOwner: {
        type: Schema.Types.ObjectId,
        required: true,
        ref: 'Tree'
    },
    created: {
        type: Date,
        required: true,
        default: Date.now()
    }
})

module.exports = mongoose.model('Tree', TreeSchema)