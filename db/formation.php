<?php
function liste_formations(PDO $conn) {
    $sql = "SELECT * FROM formation f
            INNER JOIN type_formation tf ON f.type_formation=tf.type_formation
            INNER JOIN tp_formation tpf ON tpf.type_formation = tf.type_formation
            AND f.id_formation= tpf.id_formation";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
// function liste_données_pat(PDO $conn){
//     $sql = "SELECT * FROM donnees_pat ORDER BY date_cons";
//     $res = $conn->query($sql);
//     return $res->fetchAll(PDO::FETCH_ASSOC);
// }

function formation_fetch_id(PDO $conn, int $id_formation) {
    $sql="SELECT * FROM formation f 
    INNER JOIN type_formation tf ON f.type_formation=tf.type_formation
    WHERE id_formation = :id_formation";
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function insert_tp_formation(PDO $conn, array $data) {
    $sql = "INSERT INTO tp_formation(id_formation,type_formation) 
            VALUES (:id_formation,:type_formation)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function insert_formation(PDO $conn, array $data) {
    $sql = "INSERT INTO formation(nom, description, type_formation) 
            VALUES (:nom, :description, :type_formation)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
    return $conn->lastInsertId();
}
function update_formation(PDO $conn, array $data) {
    $sql = "UPDATE formation SET 
            nom = :nom, 
            description = :description, 
            type_formation = :type_formation
            where id_formation = :id_formation";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function formation_fetch(PDO $conn , string $input_cher) {
    $ch = '%'.$input_cher.'%'; 
    $sql = "SELECT * FROM formation f
    INNER JOIN tp_formation tpf ON f.id_formation= tpf.id_formation
    INNER JOIN type_formation tf ON tf.type_formation = f.type_formation
    WHERE f.nom like :ch or tf.libelle like :ch" ;
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function exsist_formation(PDO $conn, int $id_formation){
    $sql = "SELECT * FROM session_formation sf
    INNER JOIN formation f ON sf.id_formation=f.id_formation
    WHERE NOW() BETWEEN sf.date_deb AND sf.date_fin
    AND sf.id_formation = :id_formation";
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation]);
    return $res->fetch(PDO::FETCH_ASSOC);
}


