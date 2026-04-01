const jwt = require('jsonwebtoken');

exports.issueToken = (req, res) => {
    const user = { id: 123, email: 'user@example.com' };
    const token = jwt.sign(user, 'your_jwt_secret', { expiresIn: '1h' });
    res.json({ token });
};