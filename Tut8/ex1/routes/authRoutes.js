const express = require('express');
const router = express.Router();
const authController = require('../controllers/authController');
const csrf = require('csurf');

const csrfProtection = csrf({ cookie: true });

router.get('/login', csrfProtection, (req, res) => authController.renderLogin(req, res));
router.get('/register', csrfProtection, (req, res) => authController.renderRegister(req, res));

router.post('/register', csrfProtection, (req, res) => authController.register(req, res));
router.post('/login', csrfProtection, (req, res) => authController.loginUser(req, res));

module.exports = router;