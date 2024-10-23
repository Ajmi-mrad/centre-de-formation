<?php
function liste_idts(PDO $conn) {
    $sql = "SELECT * FROM idt ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function idt_fetch_id(PDO $conn, int $num_id) {
    $sql = "SELECT * FROM idt WHERE num_id = :num_id";
    $res = $conn->prepare($sql);
    $res->execute([':num_id' => $num_id]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_idt(PDO $conn, array $data) {
    $sql = "INSERT INTO idt(libelle) 
            VALUES (:libelle)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}

function update_idt(PDO $conn, array $data) {
    $sql = "UPDATE idt SET 
            libelle = :libelle
            where num_id = :num_id";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function idt_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM idt WHERE libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function exsist(PDO $conn, int $num_id){
    $sql = "SELECT * FROM eleve e, formateur f WHERE e.num_id = :num_id OR f.num_id = :num_id";
    $res = $conn->prepare($sql);
    $res->execute([':num_id' => $num_id]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

