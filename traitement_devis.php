<?php
$host = 'localhost';
$dbname = 'atlantique_hygiene';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO demandes_devis (nom, email, telephone, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $email, $telephone, $message]);

    $success = true;

} catch (PDOException $e) {
    $error = $e->getMessage();
    $success = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Confirmation | Atlantique Hygiène</title>
  <link rel="stylesheet" href="accueil.css">
</head>
<body>
  <header>
    <div class="header-container">
      <img src="images/logo.png" alt="Logo Atlantique Hygiène" class="logo" />
      <h1>Atlantique Hygiène</h1>
    </div>
  </header>

  <main>
    <section class="intro">
      <?php if ($success): ?>
        <h2>Merci pour votre demande</h2>
        <p>Votre demande de devis a bien été envoyée.<br>Nous vous contacterons rapidement.</p>
      <?php else: ?>
        <h2>Erreur</h2>
        <p>Une erreur est survenue : <?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </section>
  </main>

  <footer>
    <div class="footer-links">
      <a href="mentions.html">Mentions légales</a> |
      <a href="politique.html">Politique de confidentialité</a>
    </div>
    <p>&copy; 2025 Atlantique Hygiène - Tous droits réservés</p>
  </footer>
</body>
</html>
