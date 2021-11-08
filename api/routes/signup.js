var express = require('express');
var router = express.Router();
var mysql = require('mysql');
const bcrypt = require('bcrypt');

router.post('/', async (req, res) => {
	// generate salt to hash password
	const salt = await bcrypt.genSalt(10);
	// now we set user password to hashed password
	const password = await bcrypt.hash(req.body.password, salt);

	var connection = mysql.createConnection({
		host: process.env.DB_HOST,
		user: process.env.DB_USERNAME,
		password: process.env.DB_PASSWORD,
		database: process.env.DB_NAME,
	});

	// console.log(req.body.username, password);
	connection.connect();
	connection.query('INSERT INTO users (username, password) VALUES (?,?);', [req.body.username, password], (err, result) => {
		if (result) {
			res.status(201).json('created successfuly');
		} else {
			res.status(401).json({ error: "Une erreur s'est produite" });
		}
	});
	connection.end();

	// // Read username and password from request body
	// const { username, password } = req.body;

	// // Filter user from the users array by username and password
	// const user = users.find(u => { return u.username === username && u.password === password });

	// if (user) {
	//     // Generate an access token
	//     const access_token = jwt.sign({ username: user.username,  role: user.role }, access_tokenSecret);

	//     res.json({
	//         access_token
	//     });
	// } else {
	//     res.send('Username or password incorrect');
	// }
});

module.exports = router;
