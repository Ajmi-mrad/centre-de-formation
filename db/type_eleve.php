<?php
function liste_type_eleves(PDO $conn) {
    $sql = "SELECT * FROM type_eleve ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function type_eleve_fetch_id(PDO $conn, int $type_eleve) {
    $sql = "SELECT * FROM type_eleve WHERE type_eleve = :type_eleve";
    $res = $conn->prepare($sql);
    $res->execute([':type_eleve' => $type_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_type_eleve(PDO $conn, array $data) {
    $sql = "INSERT INTO type_eleve(libelle) 
            VALUES (:libelle)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}

function update_type_eleve(PDO $conn, array $data) {
    $sql = "UPDATE type_eleve SET 
            libelle = :libelle
            where type_eleve = :type_eleve";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function type_eleve_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM type_eleve WHERE libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function exsist(PDO $conn, int $type_eleve){
    $sql = "SELECT * FROM eleve WHERE type_eleve = :type_eleve";
    $res = $conn->prepare($sql);
    $res->execute([':type_eleve' => $type_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}