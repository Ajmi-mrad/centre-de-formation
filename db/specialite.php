<?php
function liste_specialites(PDO $conn) {
    $sql = "SELECT * FROM specialite ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function specialite_fetch_id(PDO $conn, int $id_specialite) {
    $sql = "SELECT * FROM specialite WHERE id_specialite = :id_specialite";
    $res = $conn->prepare($sql);
    $res->execute([':id_specialite' => $id_specialite]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_specialite(PDO $conn, array $data) {
    $sql = "INSERT INTO specialite(libelle) 
            VALUES (:libelle)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}

function update_specialite(PDO $conn, array $data) {
    $sql = "UPDATE specialite SET 
            libelle = :libelle
            where id_specialite = :id_specialite";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function specialite_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM specialite WHERE libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function exsist(PDO $conn, int $id_specialite){
    $sql = "SELECT * FROM formateur WHERE id_specialite = :id_specialite";
    $res = $conn->prepare($sql);
    $res->execute([':id_specialite' => $id_specialite]);
    return $res->fetch(PDO::FETCH_ASSOC);
}