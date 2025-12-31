<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
if (isset($_POST["nom"]) && !empty($_POST["nom"]) &&
    isset($_POST["prénom"]) && !empty($_POST["prénom"]) &&
    isset($_POST["email"]) && !empty($_POST["email"]) &&
    isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"]) &&
    isset($_POST["numéro_de_téléphone"]) && !empty($_POST["numéro_de_téléphone"]) &&
    isset($_POST["image"]) && !empty($_POST["image"]) &&
    isset($_POST["prix"]) && !empty($_POST["prix"])) {

    $user = "root"; // اسم المستخدم في XAMPP
    $pwd = "";      // كلمة مرور XAMPP 
    $db = "mysql:host=localhost;dbname=shopping_sports"; // قاعدة البيانات

    try {
        $cx = new PDO($db, $user, $pwd);
        $cx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Erreur connexion : " . $e->getMessage() . "</p>";
        exit;
    }

    try {
        $nom = $_POST["nom"];
        $prénom = $_POST["prénom"];
        $email = $_POST["email"];
        $mot_de_passe = $_POST["mot_de_passe"];
        $numéro_de_téléphone = $_POST["numéro_de_téléphone"];
        $image = $_POST["image"];
        $prix = $_POST["prix"];

        $sql = "INSERT INTO user (nom, prénom, email, mot_de_passe, numéro_de_téléphone, image, prix) 
                VALUES (:nom, :prenom, :email, :mot_de_passe, :numéro_de_téléphone, :image, :prix)";

        $stmt = $cx->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prénom' => $prénom,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe,
            ':numéro_de_téléphone' => $numéro_de_téléphone,
            ':image' => $image,
            ':prix' => $prix,
        ]);

        echo "<p style='color: green;'>تم إرسال البيانات بنجاح!</p>";

    } catch (PDOException $e) {
        echo "<p style='color: red;'>Erreur insertion : " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: red;'>الرجاء ملء جميع الحقول.</p>";
}
}
?>





