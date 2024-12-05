<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (empty($_SESSION['name'])) {
  header('Location: login.php');
  exit;
}
$pdfs = array(
  'Notulen' => 'notulen.pdf',
  'Groep Presentatie' => 'GroepspresentatieINF1B.pdf',
  'titel3' => 'CafeOUI.pdf',
  'titel4' => 'CafeOUI.pdf',
  'titel5' => 'CafeOUI.pdf',
  'titel6' => 'CafeOUI.pdf',
  'titel7' => 'CafeOUI.pdf',
  'titel8' => 'CafeOUI.pdf'
);

$currentpdf = 'notulen.pdf';

if (!empty($_GET['pdf']) && array_key_exists($_GET['pdf'], $pdfs)) {
  $currentpdf = $pdfs[$_GET['pdf']];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/60e1a8883b.js" crossorigin="anonymous"></script>   
    <link rel="stylesheet" href="css/projects.css">
</head>
<body>
    <aside>
      <div class="inner">
        <h3>PDF List</h3>
        <?php foreach ($pdfs as $title => $file): ?>
            <a href="?pdf=<?php echo urlencode($title); ?>" class="<?php echo ($currentpdf == $file) ? 'selected' : ''; ?>"><?php echo $title; ?></a>
        <?php endforeach; ?>
      </div>
    </aside>
    
    <main>
      <div class="top">
        <a href="pdf/CafeOUI.pdf" target="_blank">moi</a> !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        <h2 id='pdftitle'>Assignments</h2>
        <div class="dropdown">
          <i class="fa-solid fa-bars"></i>
          <div class="dropdown-content">
              <a href="landingpage.php">Portfolio</a>
              <a href="projects.php">Projects</a>
              <a href="https://github.com/LukeBoscher">Github</a>
          </div>
        </div>
      </div>
      <div class="pdfviewer">
          <?php
          echo '<embed id="pdf-embed" src="pdf/'.$currentpdf.'">';
          ?>
      </div>
    </main>
</body>
</html>

