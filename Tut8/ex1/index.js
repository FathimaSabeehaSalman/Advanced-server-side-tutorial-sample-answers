const express = require('express');
const session = require('express-session');
const cookieParser = require('cookie-parser');
const authRoutes = require('./routes/authRoutes');

const app = express();

app.set('view engine', 'ejs');

app.use(express.urlencoded({ extended: false })); 
app.use(express.json());

app.use(cookieParser());

app.use(session({
    secret: 'session_secret',
    resave: false,
    saveUninitialized: true
}));

app.use('/api/auth', authRoutes);

app.listen(3000, () => console.log("Server running on port 3000"));