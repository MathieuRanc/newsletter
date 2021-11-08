var express = require('express');
var router = express.Router();
var mysql = require('mysql');

function validateEmail(email) {
	const re =
		/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}

router.get('/', function (req, res, next) {
	try {
		if (!req.query.email && !req.query.list) throw new Error('paramètres `email` et `liste` manquants');
		else if (!req.query.email) throw new Error('paramètre `email` manquant');
		else if (!req.query.list) throw new Error('paramètre `list` manquant');
		else if (!validateEmail(req.query.email)) throw new Error('Invalid email');

		// add email to db
		let connection = mysql.createConnection({
			host: process.env.DB_HOST,
			user: process.env.DB_USERNAME,
			password: process.env.DB_PASSWORD,
			database: process.env.DB_NAME,
		});
		connection.connect();
		connection.query('SELECT id FROM lists WHERE name=?', [req.query.list], (err, result, fields) => {
			if (!result) res.status(200).json({ success: true, email: req.query.email, list: req.query.list });
			req.id = result[0].id;
			next();
		});
		connection.end();
	} catch (error) {
		res.status(422).json({ success: false, error: error.message });
	}
});

/* GET users listing. */
router.get('/', function (req, res, next) {
	try {
		let connection = mysql.createConnection({
			host: process.env.DB_HOST,
			user: process.env.DB_USERNAME,
			password: process.env.DB_PASSWORD,
			database: process.env.DB_NAME,
		});
		connection.connect();
		connection.query('SELECT id_lists FROM emails WHERE email=?', [req.query.email], (err, result, fields) => {
			if (!result[0]) throw new Error('Bad resuest');
			req.id_lists = result[0].id_lists
				.slice(1, -1)
				.split(', ')
				.map((id) => parseInt(id))
				.filter((id) => id !== req.id);
			connection.end();
			next();
		});
	} catch (error) {
		res.json({ success: false, error: error.message });
	}
});

router.get('/', (req, res) => {
	try {
		let connection = mysql.createConnection({
			host: process.env.DB_HOST,
			user: process.env.DB_USERNAME,
			password: process.env.DB_PASSWORD,
			database: process.env.DB_NAME,
		});
		connection.connect();
		connection.query('UPDATE emails SET id_lists=? WHERE email=?', [JSON.stringify(req.id_lists), req.query.email]);
		connection.end();

		res.json({ success: true, email: req.query.email, list: req.query.list });
	} catch (err) {
		res.json({ success: false, error: error.message });
	}
});

module.exports = router;
// connection.query(`DELETE FROM ${req.query.list} WHERE email=?`, [req.query.email]);
