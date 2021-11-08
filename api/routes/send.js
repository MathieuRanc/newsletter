var express = require('express');
var router = express.Router();
const jwt = require('jsonwebtoken');
const nodemailer = require('nodemailer');

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

const mail = async (req, res, emails) => {
	let result = { success: [], fail: [] };

	const unsubscribe = req.protocol + '://' + req.get('host') + process.env.API_PATH + '/desinscription?list=' + req.body.list + '&email=';

	for (const to of emails) {
		let info = await req.transporter.sendMail(
			{
				from: `"${req.body.name}" <${process.env.MAIL_USER}>`,
				to,
				subject: req.body.subject,
				text: req.body.description,
				html: `<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Document</title></head><body><img src="${
					req.body.image
				}"><img class="hidden" src="http://localhost:8000/api/count?id=2"><p class="hidden">${req.body.description}</p><a href="${
					unsubscribe + to
				}">Se désinscrire</a></body></html><style>img{width:100%;}.hidden{display:none;}</style>`,
			},
			(err, res) => {
				if (err) result.fail.push({ email: to, type: 'err' });
				else result.success.push(to);
			}
		);

		// result.fail.push({ email: to, type: 'try' });
	}
	return result;
};

router.post('/', async (req, res, next) => {
	req.transporter = nodemailer.createTransport({
		host: process.env.MAIL_HOST,
		port: process.env.MAIL_PORT,
		secure: process.env.MAIL_SECURE,
		auth: {
			user: process.env.MAIL_USER,
			pass: process.env.MAIL_PASS,
		},
	});

	if (!req.body.list || !req.body.name || !req.body.subject || !req.body.description || !req.body.image)
		res.status(422).json({ error: 'Missing parameters' }).end();

	next();
});

router.post('/', async (req, res) => {
	const emails = [
		'dev@mathieuranc.fr',
		'exemple@mathieuranc.fr',
		'exemple@mathieuranc.fr',
		'exemple@mathieuranc.fr',
		'exemple@mathieuranc.fr',
		'exemple@mathieuranc.fr',
		'exemple@mathieuranc.fr',
		'exemple@mathieuranc.fr',
		'exemple@mathieuranc.fr',
	];

	mail(req, res, emails).catch(console.error);

	res.json({ sended: true });
});

module.exports = router;
