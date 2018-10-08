// util.js

// private
require('colors') // allow for color property extensions in log messages
var debug = require('debug')('WebSSH2')
var Auth = require('basic-auth')

exports.basicAuth = function basicAuth (req, res, next) {
    //req.session.username = 'robot'
    //req.session.userpassword = 'robot'
    req.session.username = 'root'
    req.session.userpassword = '+Un1QRTw7TgAg685AFzBkPm'
    next()
}

// takes a string, makes it boolean (true if the string is true, false otherwise)
exports.parseBool = function parseBool (str) {
  return (str.toLowerCase() === 'true')
}
