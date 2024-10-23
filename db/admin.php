<?php

function liste_compte(PDO $conn) {
    $sql = "SELECT * FROM login l 
    INNER JOIN type_user tp ON l.type_user=tp.type_user
    ORDER BY nom, prenom";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function select_cord(PDO $conn , string $type){
    $sql = "SELECT * FROM login where type = :type ";
    $res = $conn->prepare($sql);
    $res->execute([':type' => $type]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_compte(PDO $conn, array $data) {
    $sql = "INSERT INTO login(pseudo, mp, nom ,prenom,type_user) 
            VALUES (:pseudo, :mp ,:nom ,:prenom,:type_user)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}

function update_compte(PDO $conn, array $data) {
    $sql = "UPDATE login SET
            pseudo = :pseudo, 
            mp = :mp, 
            nom = :nom, 
            prenom = :prenom, 
            type_user = :type_user
            where id_login = :id_login";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function compte_fetch_id(PDO $conn, int $id_login) {
    $sql = "SELECT * FROM login l
    INNER JOIN type_user tp ON l.type_user=tp.type_user 
    WHERE id_login = :id_login";
    $res = $conn->prepare($sql);
    $res->execute([':id_login' => $id_login]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function compte_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM login l
    INNER JOIN type_user tp ON l.type_user=tp.type_user 
    WHERE nom like :ch or prenom like :ch or pseudo like :ch or mp like :ch or tp.libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function login_user(PDO $conn, string $pseudo, string $mp){
    $sql = "SELECT * FROM login l 
    INNER JOIN type_user tp ON l.type_id=tp.type_id
    WHERE pseudo = :pseudo AND mp = :mp";
    $res = $conn->prepare($sql);
    $res->execute([":pseudo" => $pseudo, ":mp" => $mp]);
    return $res->fetch(PDO::FETCH_ASSOC);
}