const express = require('express');
const router = express.Router();
const path = require('path');

const PDFS = {
  'Notulen': 'notulen.pdf',
  'Groep Presentatie': 'GroepspresentatieINF1B.pdf',
  'titel3': 'CafeOUI.pdf',
  'titel4': 'CafeOUI.pdf',
  'titel5': 'CafeOUI.pdf',
  'titel6': 'CafeOUI.pdf',
  'titel7': 'CafeOUI.pdf',
  'titel8': 'CafeOUI.pdf'
};

router.get('/', (req, res) => {
  if (!req.session.name) {
    return res.redirect('/login');
  }

  const currentpdf = PDFS[req.query.pdf] || 'notulen.pdf';
  res.sendFile(path.join(__dirname, '../public/projects.html'));
});

module.exports = router;