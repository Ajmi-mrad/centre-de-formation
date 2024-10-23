<?php
function liste_nv_scolaires(PDO $conn) {
    $sql = "SELECT * FROM nv_scolaire ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function nv_scolaire_fetch_id(PDO $conn, int $id_scolaire) {
    $sql = "SELECT * FROM nv_scolaire WHERE id_scolaire = :id_scolaire";
    $res = $conn->prepare($sql);
    $res->execute([':id_scolaire' => $id_scolaire]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_nv_scolaire(PDO $conn, array $data) {
    $sql = "INSERT INTO nv_scolaire(libelle) 
            VALUES (:libelle)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}

function update_nv_scolaire(PDO $conn, array $data) {
    $sql = "UPDATE nv_scolaire SET 
            libelle = :libelle
            where id_scolaire = :id_scolaire";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function nv_scolaire_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM nv_scolaire WHERE libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function exsist(PDO $conn, int $id_scolaire){
    $sql = "SELECT * FROM tp_eleve WHERE id_scolaire=:id_scolaire";
    $res = $conn->prepare($sql);
    $res->execute([':id_scolaire' => $id_scolaire]);
    return $res->fetch(PDO::FETCH_ASSOC);
}