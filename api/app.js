var createError = require('http-errors');
var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');
const cors = require('cors');
require('dotenv').config();

// create reusable transporter object using the default SMTP transport

var indexRouter = require('./routes/index');
var countRouter = require('./routes/count');
var inscriptionRouter = require('./routes/inscription');
var desinscriptionRouter = require('./routes/desinscription');
var newsletterRouter = require('./routes/newsletter');
var creationRouter = require('./routes/creation');
var listesRouter = require('./routes/listes');
var loginRouter = require('./routes/login');
var sendRouter = require('./routes/send');
var signupRouter = require('./routes/signup');
var uploadRouter = require('./routes/upload');

var app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

/* CORS */
// const corsOpts = {
// 	origin: ['https://newsletter-client.mathieuranc.fr', 'http://localhost:3000'],
// 	methods: ['GET', 'POST'],
// 	allowedHeaders: ['Content-Type'],
// };
// app.use(cors(corsOpts));
app.use(cors());
app.options(['https://newsletter-client.mathieuranc.fr', 'http://localhost:3000'], cors());

const urlPath = process.env.API_PATH;
console.log(urlPath);
app.use(urlPath + '/', indexRouter);
app.use(urlPath + '/count', countRouter);
app.use(urlPath + '/inscription', inscriptionRouter);
app.use(urlPath + '/desinscription', desinscriptionRouter);
app.use(urlPath + '/newsletter', newsletterRouter);
app.use(urlPath + '/creation', creationRouter);
app.use(urlPath + '/listes', listesRouter);
app.use(urlPath + '/login', loginRouter);
app.use(urlPath + '/send', sendRouter);
app.use(urlPath + '/signup', signupRouter);
app.use(urlPath + '/upload', uploadRouter);

// catch 404 and forward to error handler
app.use(function (req, res, next) {
	next(createError(404));
});

// error handler
app.use(function (err, req, res, next) {
	// set locals, only providing error in development
	res.locals.message = err.message;
	res.locals.error = req.app.get('env') === 'development' ? err : {};

	// render the error page
	res.status(err.status || 500);
	res.render('error');
});

module.exports = app;
