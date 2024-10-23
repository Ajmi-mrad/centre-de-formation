<?php
function liste_societes(PDO $conn) {
    $sql = "SELECT * FROM societe ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function societe_fetch_id(PDO $conn, int $id_societe) {
    $sql = "SELECT * FROM societe WHERE id_societe = :id_societe";
    $res = $conn->prepare($sql);
    $res->execute([':id_societe' => $id_societe]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_societe(PDO $conn, array $data) {
    $sql = "INSERT INTO societe(libelle, email) 
            VALUES (:libelle, :email)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}
function update_societe(PDO $conn, array $data) {
    $sql = "UPDATE societe SET 
            libelle = :libelle,
            email = :email
            where id_societe = :id_societe";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function societe_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM societe WHERE libelle like :ch or email like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function exsist(PDO $conn, int $id_societe){
    $sql = "SELECT * FROM tp_eleve WHERE id_societe = :id_societe";
    $res = $conn->prepare($sql);
    $res->execute([':id_societe' => $id_societe]);
    return $res->fetch(PDO::FETCH_ASSOC);
}