<?php
function insert_formateur_session(PDO $conn, array $data) {
    $sql = "INSERT INTO formateur_session(id_formation ,id_session,id_formateur,id_paiement,montant_total) 
            VALUES (:id_formation ,:id_session,:id_formateur,:id_paiement,:montant_total)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}
function liste_formateur_sessions(PDO $conn){
    $sql = "SELECT fss.id_formation,fss.id_session,fss.id_formateur,
    ft.nom as nom_formateur , sf.nom_session as nom_session ,
    fr.nom as nom_formation , fss.montant_total as mt_tt 
    FROM formateur_session fss
    INNER JOIN session_formation sf ON fss.id_session = sf.id_session 
    AND fss.id_formation = sf.id_formation 
    INNER JOIN formateur ft ON fss.id_formateur = ft.id_formateur 
    INNER JOIN formation fr ON fss.id_formation = fr.id_formation";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
function formateur_session_fetch_id(PDO $conn, int $id_formation,int $id_session,int $id_formateur ) {
    $sql = "SELECT fss.id_formation,fss.id_session,fss.id_formateur,
    ft.nom as nom_formateur , sf.nom_session as nom_session ,
    fr.nom as nom_formation , fss.montant_total as mt_tt, 
    fss.id_paiement ,mp.libelle
    FROM formateur ft , formation fr, modalite_paiement mp,formateur_session fss
    INNER JOIN session_formation sf 
    ON fss.id_session = sf.id_session WHERE fss.id_formateur = ft.id_formateur 
    AND fss.id_paiement = mp.id_paiement
    AND sf.id_formation = fr.id_formation
    AND fss.id_formation = sf.id_formation
    AND fss.id_formation = :id_formation
    AND fss.id_session = :id_session
    AND fss.id_formateur = :id_formateur";
    // $sql = "SELECT ";
    
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation,':id_session' => $id_session,':id_formateur' => $id_formateur]);
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
