var express = require('express');
var router = express.Router();
var mysql = require('mysql');
const jwt = require('jsonwebtoken');

/* GET users listing. */
router.get('/', function (req, res, next) {
	try {
		const authHeader = req.headers.authorization;

		if (authHeader) {
			const token = authHeader.split(' ')[1];

			jwt.verify(token, process.env.JWT_SECRET, (err, user) => {
				if (err || user.role !== 'ADMIN') {
					return res.status(403).json('forbidden');
				}
				req.user = user;
				next();
			});
		} else {
			res.status(401).json('undefined jwt token');
		}
	} catch (err) {
		res.status(500).json('error');
	}
});

router.get('/', function (req, res, next) {
	try {
		if (!req.query.list) throw Error('paramètre `list` manquant');

		var connection = mysql.createConnection({
			host: process.env.DB_HOST,
			user: process.env.DB_USERNAME,
			password: process.env.DB_PASSWORD,
			database: process.env.DB_NAME,
		});
		connection.connect();
		connection.query('SELECT id FROM lists WHERE name=?', [req.query.list], (err, result, fields) => {
			req.id = result[0].id;
			next();
		});
	} catch (error) {
		connection.end();
		res.json({ success: false, error: error.message });
	}
});

router.get('/', function (req, res, next) {
	try {
		var connection = mysql.createConnection({
			host: process.env.DB_HOST,
			user: process.env.DB_USERNAME,
			password: process.env.DB_PASSWORD,
			database: process.env.DB_NAME,
		});
		connection.connect();

		var mail_list = [];
		const query = `SELECT email FROM emails WHERE id_lists LIKE '%\[${req.id},%' OR id_lists LIKE '% ${req.id},%' OR id_lists LIKE '% ${req.id}\]%' OR id_lists LIKE '%\[${req.id}\]%' UNION SELECT count(*) FROM emails WHERE id_lists LIKE '%\[${req.id},%' OR id_lists LIKE '% ${req.id},%' OR id_lists LIKE '% ${req.id}\]%' OR id_lists LIKE '%\[${req.id}\]%'`;
		connection.query(query, (err, result, fields) => {
			mail_list = [...result].map((item) => item.email);
			count = parseInt(mail_list.pop());
			res.json({
				success: true,
				database: req.query.list,
				emails: mail_list,
				count,
			});
		});
		connection.end();
	} catch (error) {
		connection.end();
		res.json({ success: false, error: error.message });
	}
});

module.exports = router;
