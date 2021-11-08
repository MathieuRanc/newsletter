var express = require('express');
var router = express.Router();
var mysql = require('mysql');

router.get('/', (req, res) => {
	console.log(req.query.id);
	res.end(req.query.id);
});

module.exports = router;
