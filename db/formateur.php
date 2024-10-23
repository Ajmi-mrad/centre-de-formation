<?php
function liste_formateurs(PDO $conn) {
    $sql = "SELECT * FROM formateur ORDER BY nom";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function formateur_fetch_id(PDO $conn, int $id_formateur) {
    $sql = "SELECT * FROM formateur WHERE id_formateur = :id_formateur";
    $res = $conn->prepare($sql);
    $res->execute([':id_formateur' => $id_formateur]);
    return $res->fetch(PDO::FETCH_ASSOC);
}

function insert_formateur(PDO $conn, array $data) {
    $sql = "INSERT INTO formateur(nom, prenom ,tel ,date_naiss, num_id ,nat_id ,cv ,id_specialite,email) 
            VALUES (:nom, :prenom, :tel, :date_naiss, :num_id , :nat_id, :cv, :id_specialite,:email)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}
function exsist_formateur(PDO $conn, int $id_formateur){
    $sql = "SELECT * FROM formateur_session WHERE id_formateur = :id_formateur";
    $res = $conn->prepare($sql);
    $res->execute([':id_formateur' => $id_formateur]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function update_formateur(PDO $conn, array $data) {
    $sql = "UPDATE formateur SET 
            nom = :nom, 
            prenom = :prenom, 
            tel= :tel,
            date_naiss = :date_naiss,
            num_id = :num_id,
            nat_id = :nat_id,
            cv = :cv,
            id_specialite = :id_specialite, 
            email = :email
            
            where id_formateur = :id_formateur";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function formateur_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = 'SELECT * FROM formateur WHERE date_naiss like :ch or nom like :ch or prenom like :ch or nat_id like :ch or tel like :ch' ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function specialite_fetch(PDO $conn, int $id_formateur) {
    // $sql = "SELECT sp.libelle FROM specialite sp,formateur f WHERE f.id_specialite = :sp.id_specialite";
    $sql = "SELECT * FROM specialite sp, formateur f, formateur_specialite fsp
            WHERE fsp.id_specialite=sp.id_specialite
            AND   f.id_formateur=fsp.id_formateur
            AND   fsp.id_formateur=:id_formateur";
    $res = $conn->prepare($sql);
    $res->execute([':id_formateur' => $id_formateur]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function num_id_fetch(PDO $conn, int $id_formateur) {
    // $sql = "SELECT sp.libelle FROM specialite sp,formateur f WHERE f.id_specialite = :sp.id_specialite";
    $sql = "SELECT * FROM idt i
            INNER JOIN idt_formateur ifr ON ifr.num_id=i.num_id
            INNER JOIN formateur f ON f.id_formateur=ifr.id_formateur AND f.num_id=ifr.num_id
            WHERE ifr.id_formateur=:id_formateur";

    // $sql = "SELECT * FROM formateur f,idt_formateur ifr, idt i
    //         WHERE ifr.num_id=f.num_id
    //         AND   ifr.id_formateur=f.id_formateur
    //         AND   i.num_id=f.num_id
    //         AND   ifr.id_formateur=:id_formateur";
    $res = $conn->prepare($sql);
    $res->execute([':id_formateur' => $id_formateur]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function insert_formateur_specialite(PDO $conn, array $data) {
    $sql = "INSERT INTO formateur_specialite(id_specialite,id_formateur) 
            VALUES (:id_specialite,:id_formateur)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function insert_idt_formateur(PDO $conn, array $data) {
    $sql = "INSERT INTO idt_formateur(id_formateur,num_id) 
            VALUES (:id_formateur,:num_id)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function liste_types(PDO $conn) {
    $sql = "SELECT * FROM idt ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function liste_specialites(PDO $conn) {
    $sql = "SELECT * FROM specialite ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function update_num_id(PDO $conn, array $data) {
    $sql = "UPDATE idt_formateur SET 
            num_id = :num_id
            where id_formateur = :id_formateur";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}