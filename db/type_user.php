<?php
function liste_type_users(PDO $conn) {
    $sql = "SELECT * FROM type_user ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function type_user_fetch_id(PDO $conn, int $type_user) {
    $sql = "SELECT * FROM type_user WHERE type_user = :type_user";
    $res = $conn->prepare($sql);
    $res->execute([':type_user' => $type_user]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_type_user(PDO $conn, array $data) {
    $sql = "INSERT INTO type_user(libelle) 
            VALUES (:libelle)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}

function update_type_user(PDO $conn, array $data) {
    $sql = "UPDATE type_user SET 
            libelle = :libelle
            where type_user = :type_user";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function type_user_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM type_user WHERE libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
/*function exsist(PDO $conn, int $type_user){
    $sql = "SELECT * FROM login WHERE type_user=:type_user";
    $res = $conn->prepare($sql);
    $res->execute([':type_user' => $type_user]);
    return $res->fetch(PDO::FETCH_ASSOC);
}*/