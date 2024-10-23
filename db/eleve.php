<?php
function liste_eleves(PDO $conn) {
    $sql = "SELECT * FROM eleve ORDER BY nom";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function eleve_fetch_id(PDO $conn, int $id_eleve) {
    $sql = "SELECT * FROM eleve WHERE id_eleve = :id_eleve";
    $res = $conn->prepare($sql);
    $res->execute([':id_eleve' => $id_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function eleve_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%' ; 
    // $sql = 'SELECT * FROM patient WHERE where date_naiss like :ch or nom like :ch prenom like :ch ' ;
    $sql = 'SELECT * FROM eleve WHERE date_naiss like :ch or nom like :ch or prenom like :ch
            or nat_id like :ch or tel like :ch' ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    // $res->execute([':date_naiss' => $ch , ':nom' => $ch , ':prenom' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function insert_eleve(PDO $conn, array $data) {
    $sql = "INSERT INTO eleve(type_eleve ,nom, prenom, tel ,date_naiss, email, num_id,nat_id) 
            VALUES (:type_eleve,:nom, :prenom, :tel ,:date_naiss, :email, :num_id, :nat_id)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}
function insert_tp_eleve(PDO $conn , array $data){
    $sql = "INSERT INTO tp_eleve(id_eleve ,id_societe,id_scolaire) 
            VALUES (:id_eleve ,:id_societe,:id_scolaire)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}
function update_eleve(PDO $conn, array $data) {
    $sql = "UPDATE eleve SET 
            type_eleve = :type_eleve,
            nom = :nom, 
            prenom = :prenom, 
            tel = :tel,
            date_naiss = :date_naiss,
            email = :email,
            num_id = :num_id,
            nat_id = :nat_id
            where id_eleve = :id_eleve";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function update_tp_eleve(PDO $conn , array $data){
    $sql = "UPDATE tp_eleve 
            INNER JOIN eleve 
            ON eleve.id_eleve=tp_eleve.id_eleve 
            SET 
            id_societe = :id_societe,
            id_scolaire = :id_scolaire
            where tp_eleve.id_eleve = :id_eleve";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function update_num_id(PDO $conn, array $data) {
    $sql = "UPDATE idt_eleve SET 
            id_eleve = :id_eleve, 
            num_id = :num_id
            where id_eleve = :id_eleve";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function liste_types(PDO $conn) {
    $sql = "SELECT * FROM idt ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function liste_scolaire(PDO $conn) {
    $sql = "SELECT * FROM nv_scolaire ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function liste_societe(PDO $conn) {
    $sql = "SELECT * FROM societe ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function liste_type_eleve(PDO $conn) {
    $sql = "SELECT * FROM type_eleve ORDER BY libelle";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function insert_idt_eleve(PDO $conn, array $data) {
    $sql = "INSERT INTO idt_eleve(id_eleve,num_id) 
            VALUES (:id_eleve,:num_id)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function num_id_fetch(PDO $conn, int $id_eleve) {
    // $sql = "SELECT sp.libelle FROM specialite sp,formateur f WHERE f.id_specialite = :sp.id_specialite";
    // $sql = "SELECT * FROM idt i, eleve e,idt_eleve ie
    //         WHERE ie.num_id=i.num_id
    //         AND   e.id_eleve=ie.id_eleve
    //         AND   ie.id_eleve=:id_eleve";
    $sql = "SELECT * FROM idt i
            INNER JOIN idt_eleve ie ON ie.num_id=i.num_id
            INNER JOIN eleve e ON e.id_eleve=ie.id_eleve
            WHERE ie.id_eleve=:id_eleve";
    $res = $conn->prepare($sql);
    $res->execute([':id_eleve' => $id_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function scolaire_fetch(PDO $conn, int $id_eleve) {
    // $sql = "SELECT sp.libelle FROM specialite sp,formateur f WHERE f.id_specialite = :sp.id_specialite";
    $sql = "SELECT * FROM nv_scolaire sc
            INNER JOIN tp_eleve tp ON tp.id_scolaire = sc.id_scolaire
            INNER JOIN eleve e ON e.id_eleve = tp.id_eleve
            WHERE    tp.id_eleve=:id_eleve";
    $res = $conn->prepare($sql);
    $res->execute([':id_eleve' => $id_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function societe_fetch(PDO $conn, int $id_eleve) {
    // $sql = "SELECT sp.libelle FROM specialite sp,formateur f WHERE f.id_specialite = :sp.id_specialite";
    $sql = "SELECT * FROM societe sc
            INNER JOIN tp_eleve tp ON tp.id_societe = sc.id_societe
            INNER JOIN eleve e ON e.id_eleve = tp.id_eleve
            WHERE    tp.id_eleve=:id_eleve";
    $res = $conn->prepare($sql);
    $res->execute([':id_eleve' => $id_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function type_eleve_fetch(PDO $conn, int $id_eleve) {
    // $sql = "SELECT sp.libelle FROM specialite sp,formateur f WHERE f.id_specialite = :sp.id_specialite";
    $sql = "SELECT * FROM type_eleve te
            INNER JOIN eleve e ON e.type_eleve = te.type_eleve
            WHERE    e.id_eleve=:id_eleve";
    $res = $conn->prepare($sql);
    $res->execute([':id_eleve' => $id_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function exsist(PDO $conn, int $id_eleve){
    $sql = "SELECT * FROM eleve_session ess 
    INNER JOIN eleve e ON e.id_eleve = ess.id_eleve
    INNER JOIN formateur_session sf ON ess.id_formation=sf.id_formation AND ess.id_session=sf.id_session AND ess.id_formateur=sf.id_formateur
    INNER JOIN session_formation fs ON fs.id_formation=ess.id_formation AND fs.id_session=ess.id_session
    WHERE NOW() BETWEEN fs.date_deb AND fs.date_fin
    AND ess.id_eleve = :id_eleve";
    $res = $conn->prepare($sql);
    $res->execute([':id_eleve' => $id_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
