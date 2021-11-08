var express = require('express');
var router = express.Router();
var mysql = require('mysql');
const jwt = require('jsonwebtoken');

/* GET users listing. */
router.post('/', (req, res, next) => {
	try {
		const authHeader = req.headers.authorization;

		if (authHeader) {
			const token = authHeader.split(' ')[1];

			jwt.verify(token, process.env.JWT_SECRET, (err, user) => {
				if (err || user.role !== 'ADMIN') {
					return res.status(403).send('forbidden');
				}
				req.user = user;
				next();
			});
		} else {
			res.status(401).send('undefined jwt token');
		}
	} catch (err) {
		res.status(500).send('error');
	}
});

router.post('/', (req, res) => {
	try {
		if (!req.body.list) throw Error('paramètre `list` manquant');
		const table = req.body.list;

		var connection = mysql.createConnection({
			host: process.env.DB_HOST,
			user: process.env.DB_USERNAME,
			password: process.env.DB_PASSWORD,
			database: process.env.DB_NAME,
		});
		connection.connect();
		connection.query('INSERT INTO lists (name) VALUES (?)', [table]);
		connection.end();

		res.json({ success: true, table_name: table });
	} catch (error) {
		res.json({ success: false, error: error.message });
	}
});

module.exports = router;
