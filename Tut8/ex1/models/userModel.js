const db = require('../configs/db');

class UserModel {
    async findByEmail(email) {
        const [rows] = await db.execute('SELECT * FROM users WHERE email = ?', [email]);
        return rows[0];
    }

    async createUser(userData) {
        const { name, email, password } = userData;
        return await db.execute(
            'INSERT INTO users (name, email, password) VALUES (?, ?, ?)',
            [name, email, password]
        );
    }
}

module.exports = new UserModel();