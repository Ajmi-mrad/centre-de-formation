<?php
function insert_eleve_session(PDO $conn, array $data) {
    $sql = "INSERT INTO eleve_session(id_formation ,id_session,id_formateur,id_eleve) 
            VALUES (:id_formation ,:id_session,:id_formateur,:id_eleve)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function liste_eleve_sessions(PDO $conn) {
    $sql = "SELECT es.id_session,es.id_formation,es.id_eleve,
    ft.nom as nom_formateur , sf.nom_session as nom_session ,
    fr.nom as nom_formation , sf.prix as mt_tt ,
    e.nom as nom_eleve
    FROM eleve_session es   
    INNER JOIN session_formation sf 
    ON  sf.id_session = es.id_session and sf.id_formation = es.id_formation
    INNER JOIN formateur_session fss ON 
    fss.id_session = es.id_session and fss.id_formation = es.id_formation and fss.id_formateur=es.id_formateur
    INNER JOIN eleve e ON e.id_eleve=es.id_eleve
    INNER JOIN formateur ft ON ft.id_formateur=es.id_formateur
    INNER JOIN formation fr ON fr.id_formation=es.id_formation
    ";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function eleve_session_fetch_id(PDO $conn, int $id_formation,int $id_session,int $id_eleve ) {
    $sql = "SELECT es.id_session,es.id_formation,es.id_eleve,
    ft.nom as nom_formateur , sf.nom_session as nom_session ,
    fr.nom as nom_formation , sf.prix as mt_tt ,
    e.nom as nom_eleve
    FROM eleve_session es
    INNER JOIN session_formation sf 
    ON  sf.id_session = es.id_session and sf.id_formation = es.id_formation
    INNER JOIN eleve e ON e.id_eleve=es.id_eleve
    INNER JOIN formateur ft ON ft.id_formateur=es.id_formateur
    INNER JOIN formation fr ON fr.id_formation=es.id_formation
    AND es.id_formation = :id_formation
    AND es.id_session = :id_session
    AND es.id_eleve = :id_eleve";
    // $sql = "SELECT ";
    
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation,':id_session' => $id_session,':id_eleve' => $id_eleve]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
// function sessions_fetch(PDO $conn, string $input_cher) {
//     $ch = '%'.$input_cher.'%' ; 
//     $sql = "SELECT * FROM session_formation sf, formation f ,type_formation tf
//     WHERE sf.id_formation = f.id_formation 
//     AND tf.type_formation = f.type_formation
//     OR f.nom LIKE :ch OR tf.libelle LIKE :ch ";
//     $res = $conn->prepare($sql);
//     $res->execute([':ch' => $ch]);
//     return $res->fetchAll(PDO::FETCH_ASSOC);
// }
// function session_fetch_id(PDO $conn, int $id_formation, int $id_session) {
//     $sql = "SELECT * FROM session_formation
//      WHERE id_formation = :id_formation
//      AND id_session = :id_session";
//     $res = $conn->prepare($sql);
//     $res->execute([':id_formation' => $id_formation,':id_session' => $id_session]);
//     return $res->fetch(PDO::FETCH_ASSOC);
// }


function update_formateur_session(PDO $conn, array $data) {
    $sql = "UPDATE formateur_session SET 

            id_formation =:id_formation ,
            id_session =:id_session,
            id_formateur =:id_formateur,
            id_paiement =:id_paiement,
            montant_total =:montant_total

            where id_formation = :id_formation
            AND id_session = :id_session ";
            
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function formation_session_fetch_id(PDO $conn, int $id_formation, int $id_session) {
    $sql = "SELECT * FROM session_formation fs , formation f
     WHERE fs.id_formation = f.id_formation
     AND fs.id_formation = :id_formation
     AND fs.id_session = :id_session";
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation,':id_session' => $id_session]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
