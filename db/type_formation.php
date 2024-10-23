<?php
function liste_type_formations(PDO $conn) {
    $sql = "SELECT * FROM type_formation ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function type_formation_fetch_id(PDO $conn, int $type_formation) {
    $sql = "SELECT * FROM type_formation WHERE type_formation = :type_formation";
    $res = $conn->prepare($sql);
    $res->execute([':type_formation' => $type_formation]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_type_formation(PDO $conn, array $data) {
    $sql = "INSERT INTO type_formation(libelle) 
            VALUES (:libelle)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}

function update_type_formation(PDO $conn, array $data) {
    $sql = "UPDATE type_formation SET 
            libelle = :libelle
            where type_formation = :type_formation";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function type_formation_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM type_formation WHERE libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function exsist(PDO $conn, int $type_formation){
    $sql = "SELECT * FROM formation WHERE type_formation = :type_formation";
    $res = $conn->prepare($sql);
    $res->execute([':type_formation' => $type_formation]);
    return $res->fetch(PDO::FETCH_ASSOC);
}