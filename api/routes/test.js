'use strict';
const nodemailer = require('nodemailer');

const emails = require('../list.json');

// async..await is not allowed in global scope, must use a wrapper
async function main() {
	// Generate test SMTP service account from ethereal.email
	// Only needed if you don't have a real mail account for testing
	let testAccount = await nodemailer.createTestAccount();

	// create reusable transporter object using the default SMTP transport
	// MAIL_HOST = 'lmlccommunication.fr';
	// MAIL_USER = 'newsletter@lmlccommunication.fr';
	// MAIL_PASS = 'RW{(szaV3[7p';
	// MAIL_PORT = 465;
	// MAIL_SECURE = true;
	let transporter = nodemailer.createTransport({
		host: 'lmlccommunication.fr',
		port: 465,
		secure: true, // true for 465, false for other ports
		auth: {
			user: 'newsletter@lmlccommunication.fr', // generated ethereal user
			pass: 'RW{(szaV3[7p', // generated ethereal password
		},
	});

	let bcc = emails.join(', ');
	console.log(bcc);

	// emails.forEach(async (email) => {
	// send mail with defined transport object
	try {
		await transporter.sendMail({
			from: '"Aubrun Homme" <newsletter@lmlccommunication.fr>', // sender address
			to: 'newsletter@lmlccommunication.fr', // list of receivers
			bcc: bcc,
			subject: 'Joyeux anniversaire', // Subject line
			text: "Aubrun a le plaisir de vous offrir -25% sur l'article de votre choix.", // plain text body
			html: `<!DOCTYPE html>
      <html lang="fr">
      
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aubrun Homme</title>
      </head>
      
      <body>
        <img src="https://backoffice.lmlccommunication.fr/wp-content/uploads/2022/05/Newsletter-Aubrun.png" />
        <p>
					Aubrun a le plaisir de vous offrir -25% sur l'article de votre choix.
        </p>
      </body>
      <style>
        img {
          width: 100%;
        }
      
        p {
          position: absolute;
          opacity: 0;
        }
      </style>
      
      </html>`, // html body
		});
	} catch (error) {
		console.log(error.message);
	}
	// });

	// console.log('Message sent: %s', info.messageId);
	// // Message sent: <b658f8ca-6296-ccf4-8306-87d57a0b4321@example.com>

	// // Preview only available when sending through an Ethereal account
	// console.log('Preview URL: %s', nodemailer.getTestMessageUrl(info));
	// // Preview URL: https://ethereal.email/message/WaQKMgKddxQDoou...
}

main().catch(console.error);
