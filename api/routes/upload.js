var express = require('express');
var router = express.Router();
const multer = require('multer');
const path = require('path');
const fs = require('fs');
const jwt = require('jsonwebtoken');

router.post('/', (req, res, next) => {
	try {
		const authHeader = req.headers.authorization;

		if (authHeader) {
			const token = authHeader.split(' ')[1];

			jwt.verify(token, process.env.JWT_SECRET, (err, user) => {
				if (err || user.role !== 'ADMIN') {
					return res.status(403).json({ message: 'forbidden' });
				} else {
					req.user = user;
					next();
				}
			});
		} else {
			res.status(401).json({ message: 'undefined jwt token' });
		}
	} catch (err) {
		res.status(500).json({ message: 'jwt token error' });
	}
});

const upload = multer({ dest: './tmp/' });

router.post('/', upload.single('image'), (req, res) => {
	if (!req.file.path) res.status(422).json({ message: 'Image not sended' });
	const tempPath = req.file.path;
	const id = fs.readdirSync('./public/uploads/').length;
	const name = id + '_' + req.file.originalname;
	const targetPath = path.join(__dirname, '../public/uploads/' + name);

	if (['.png', '.jpg', '.jpeg', '.svg'].includes(path.extname(req.file.originalname).toLowerCase())) {
		fs.rename(tempPath, targetPath, (err) => {
			if (err) return res.status(500).json({ message: 'Oops! Something went wrong!' });

			res.status(200).json({ message: 'File uploaded!', url: req.protocol + '://' + req.get('host') + '/uploads/' + name });
		});
	} else {
		fs.unlink(tempPath, (err) => {
			if (err) return res.status(500).json({ message: 'Oops! Something went wrong!' });

			res.status(403).json({ message: 'Only .png files are allowed!' });
		});
	}
});

module.exports = router;
