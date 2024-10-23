<?php
function liste_sessions(PDO $conn) {
    $sql = "SELECT * FROM session_formation sf
    INNER JOIN formation f ON f.id_formation=sf.id_formation
    ORDER BY date_deb";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function sessions_fetch(PDO $conn, string $input_cher) {
    $ch = '%'.$input_cher.'%' ; 
    $sql = "SELECT * FROM session_formation sf
    INNER JOIN formation f ON f.id_formation=sf.id_formation
    WHERE f.nom LIKE :ch OR sf.nom_session LIKE :ch ";
    $res = $conn->prepare($sql);
    $res->execute([':ch' => $ch]);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function session_fetch_id(PDO $conn, int $id_formation, int $id_session) {
    $sql = "SELECT * FROM session_formation
     WHERE id_formation = :id_formation
     AND id_session = :id_session";
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation,':id_session' => $id_session]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function fab_id_session(PDO $conn , int $id_formation){
    $sql = "SELECT count(fs.id_formation)+1 as id_session FROM session_formation fs
    INNER JOIN formation f ON f.id_formation = fs.id_formation
    WHERE f.id_formation = :id_formation";
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
function insert_session(PDO $conn, array $data) {
    $sql = "INSERT INTO session_formation(id_formation ,id_session,nom_session,date_deb,date_fin ,dure,prix) 
            VALUES (:id_formation ,:id_session ,:nom_session,:date_deb,:date_fin,:dure,:prix)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function update_session(PDO $conn, array $data) {
    $sql = "UPDATE session_formation SET 
            date_deb = :date_deb,
            date_fin = :date_fin, 
            nom_session = :nom_session,
            dure = :dure, 
            prix = :prix
            where id_formation = :id_formation
            AND id_session = :id_session";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
