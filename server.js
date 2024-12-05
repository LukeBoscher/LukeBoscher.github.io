const express = require('express');
const session = require('express-session');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = 3000;

app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(session({
  secret: 'your_secret_key',
  resave: false,
  saveUninitialized: true
}));

app.use(express.static(path.join(__dirname, 'public')));

// Routes
// app.use('/login', require('./routes/login'));
app.use('/projects', require('./routes/projects'));

app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});