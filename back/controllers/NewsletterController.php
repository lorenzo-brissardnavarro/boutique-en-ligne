<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class NewsletterController{

    public function subscribe(){

        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Données invalides']);
            return;
        }

        if (empty($data["email"])) {
            echo json_encode(['success' => false, 'message' => 'Champ requis manquant']);
            return;
        }

        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => "L'adresse mail n'est pas valide."]);
            return;
        }

        try {

            // Création d'une instance de PHPMailer
            $mail = new PHPMailer(true);

            // Utilisation du protocole SMTP
            $mail->isSMTP();
            $mail->SMTPAuth = true;

            // Adresse du serveur SMTP
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;

            // Adresse mail utilisée pour envoyer les emails
            $mail->Username = 'lorenzo.brissard-navarro@laplateforme.io';
            $mail->Password = 'iode webi csnc atac';

            // Méthode chiffrement
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // Encodage caractères
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            // Adresse mail expéditeur
            $mail->setFrom('lorenzo.brissard-navarro@laplateforme.io', 'Sakura Moon Créations');

            // Adresse mail destinataire
            $mail->addAddress($data["email"]);

            // Contenu mail en HTML
            $mail->isHTML(true);

            // Objet du mail
            $mail->Subject = 'Inscription à la newsletter';

            $mail->addEmbeddedImage(__DIR__ . "/../../front/images/logo.webp", "logo");

            // Corps du mail en HTML
            $mail->Body = '
                <div style="text-align:center;">
                    <img src="cid:logo" width="160" alt="Logo">
                </div>

                <h2>Bienvenue !</h2>
                <p>Merci pour votre inscription à notre newsletter.</p>
            ';

            // Version mail si HTML pas supporté
            $mail->AltBody = "Merci pour votre inscription à notre newsletter.";

            // Envoi mail
            $mail->send();

            echo json_encode(['success' => true, 'message' => 'Newsletter envoyée']);

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi du mail.']);
        }
    }
}