<?php
function liste_modalite_paiements(PDO $conn) {
    $sql = "SELECT * FROM modalite_paiement ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function modalite_paiement_fetch_id(PDO $conn, int $id_paiement) {
    $sql = "SELECT * FROM modalite_paiement WHERE id_paiement = :id_paiement";
    $res = $conn->prepare($sql);
    $res->execute([':id_paiement' => $id_paiement]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_modalite_paiement(PDO $conn, array $data) {
    $sql = "INSERT INTO modalite_paiement(libelle) 
            VALUES (:libelle)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}

function update_modalite_paiement(PDO $conn, array $data) {
    $sql = "UPDATE modalite_paiement SET 
            libelle = :libelle
            where id_paiement = :id_paiement";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function modalite_paiement_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM modalite_paiement WHERE libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function exsist(PDO $conn, int $id_paiement){
    $sql = "SELECT * FROM formateur_session WHERE id_paiement=:id_paiement";
    $res = $conn->prepare($sql);
    $res->execute([':id_paiement' => $id_paiement]);
    return $res->fetch(PDO::FETCH_ASSOC);
}