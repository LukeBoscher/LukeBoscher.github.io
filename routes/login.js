const express = require('express');
const router = express.Router();
const fs = require('fs');
const path = require('path');

const PASSWORD = 'dasfq1f42rg3rrwg324@#@FFQ!';
const ATTEMPTS_FILE = path.join(__dirname, '../content/loginattempts.txt');

router.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, '../public/login.html'));
});

router.post('/', (req, res) => {
  const { name, password } = req.body;
  let attempts = fs.readFileSync(ATTEMPTS_FILE, 'utf-8').split('\n').filter(Boolean);

  if (!name) {
    return res.send('<h4 class="foutmelding">Please enter your name</h4>');
  }

  if (!attempts.includes(name)) {
    fs.appendFileSync(ATTEMPTS_FILE, `${name}\n`);
  }

  if (!password) {
    return res.send('<h4 class="foutmelding">Please enter a password</h4>');
  }

  if (password === PASSWORD) {
    req.session.name = name;
    return res.redirect('/projects');
  } else {
    return res.send('<h4 class="foutmelding">Incorrect password</h4>');
  }
});

module.exports = router;