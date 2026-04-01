const User = require('../models/userModel');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

class AuthController {
    async renderLogin(req, res) {
        res.render('login', { csrfToken: req.csrfToken() });
    }

    async renderRegister(req, res) {
        res.render('register', { csrfToken: req.csrfToken() });
    }

    async register(req, res) {
        try {
            const { name, email, password } = req.body;
            const hashedPassword = await bcrypt.hash(password, 10);
            await User.createUser({ name, email, password: hashedPassword });
            
            res.redirect('/api/auth/login');
        } catch (error) {
            res.status(500).send(`Registration error: ${error.message}`);
        }
    }

    async loginUser(req, res) {
        const { email, password } = req.body;
        try {
            const user = await User.findByEmail(email);
            if (!user) return res.status(400).send('User not found');

            const isMatch = await bcrypt.compare(password, user.password);
            if (!isMatch) return res.status(400).send('Invalid credentials');

            req.session.userId = user.id;

            // JWT (Modern Token Authentication)
            const token = jwt.sign({ id: user.id }, 'your_jwt_secret', { expiresIn: '1h' });

            res.json({ 
                msg: "Login successful", 
                token, 
                user: { id: user.id, email: user.email } 
            });
        } catch (error) {
            res.status(500).send(`Login error: ${error.message}`);
        }
    }
}

module.exports = new AuthController();