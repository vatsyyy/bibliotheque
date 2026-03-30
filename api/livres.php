<?php
    header("Content-Type: application/json");
    require_once '../config/database.php';

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {                                                                                // Recupérer les livres
        $stmt = $pdo->query("SELECT * FROM livres");
        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($livres);
    } elseif ($method == 'POST') {                                                                          // Creer ou ajouter un nouveau livre
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['titre']) || empty($data['auteur'])) {
            http_response_code(400);
            echo json_encode(['erreur' => "Le titre et l'auteur sont obligatoires."]);
            exit;
        }

        $stmt = $pdo-> prepare("INSERT INTO livres (titre, auteur, annee, disponible) VALUES (?,?,?,?)");
        $stmt->execute([
            $data['titre'],
            $data['auteur'],
            $data['annee'] ?? null,
            $data['disponible'] ?? 1
         ]);

        http_response_code(201);
        echo json_encode(['message' => "Livre ajouté avec succès."]);

    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['id'])) {
            http_response_code(400);
            echo json_encode(['erreur' => "L'id est obligatoire"]);
            exit;
        }

        $stmt = $pdo->prepare("UPDATE livres SET titre = ?, auteur = ?, annee = ?, disponible = ? WHERE id = ?");
        $stmt->execute([
            $data['titre'],
            $data['auteur'],
            $data['annee'] ?? null,
            $data['disponible'] ?? 1,
            $data['id']
        ]);

        http_response_code(201);
        echo json_encode(['message' => "Livre modifié avec succès."]);

    } elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['id'])) {
            http_response_code(400);
            echo json_encode(['erreur' => "L'id est obligatoire."]);
            exit;
        }

        $stmt = $pdo->prepare("DELETE FROM livres WHERE id = ?");
        $stmt->execute([$data['id']]);

        http_response_code(200);
        echo json_encode(['message' => "Livre supprimé avec succès."]);
    }
