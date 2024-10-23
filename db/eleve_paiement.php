<?php
function insert_eleve_paiement(PDO $conn, array $data) {
    $sql = "INSERT INTO eleve_paiement(id_formation ,id_session,id_eleve,date,montant_paye,montant_modifier) 
            VALUES (:id_formation ,:id_session,:id_eleve,:date,:montant_paye,:montant_modifier)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function liste_eleve_paiements(PDO $conn, int $id_formation,int $id_session,int $id_eleve) {
    $sql = "SELECT es.id_session,es.id_formation,es.id_eleve,
    ft.nom as nom_formateur , sf.nom_session as nom_session ,
    fr.nom as nom_formation , sf.prix as mt_tt ,
    e.nom as nom_eleve, ep.date as dat , ep.montant_paye as montant_paye ,
    ep.montant_modifier as montant_rembourser
    FROM eleve_session es
    INNER JOIN formateur_session fss 
    ON fss.id_session = es.id_session 
    and fss.id_formation = es.id_formation and fss.id_formateur = es.id_formateur
    INNER JOIN session_formation sf 
    ON  sf.id_session = es.id_session and sf.id_formation = es.id_formation
    INNER JOIN eleve e ON e.id_eleve=es.id_eleve
    INNER JOIN formateur ft ON ft.id_formateur=es.id_formateur
    INNER JOIN formation fr ON fr.id_formation=es.id_formation
    INNER JOIN eleve_paiement ep ON ep.id_formation=es.id_formation and ep.id_session=es.id_session
    AND ep.id_eleve=es.id_eleve
    AND ep.id_formation = :id_formation
    AND ep.id_session = :id_session
    AND ep.id_eleve = :id_eleve
    GROUP BY ep.date , ep.id_formation ,ep.id_session,ep.id_eleve
    ";
    // $res = $conn->query($sql);
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation,':id_session' => $id_session,':id_eleve' => $id_eleve]);   
    return $res->fetchALL(PDO::FETCH_ASSOC);
}
function paye(PDO $conn, int $id_formation,int $id_session,int $id_eleve, float $montant) {
    $sql = "SELECT distinct(ep.date),(:montant+SUM(ep.montant_modifier))-(SUM(ep.montant_paye)) as reste
    FROM eleve_paiement ep
    WHERE ep.id_formation = :id_formation
    AND ep.id_session = :id_session
    AND ep.id_eleve = :id_eleve";
   
   $res = $conn->prepare($sql);
   $res->execute([':id_formation' => $id_formation,':id_session' => $id_session,':id_eleve' => $id_eleve, ':montant'=>$montant]);
   
   return $res->fetch(PDO::FETCH_ASSOC);
}
/*
function total(PDO $conn, int $id_formation,int $id_session,int $id_formateur){
    $sql = "SELECT fss.montant_total as reste1
    FROM formateur_session fss
    WHERE fss.id_formation = :id_formation
    AND fss.id_session = :id_session
    AND fss.id_formateur = :id_formateur";
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation,':id_session' => $id_session,':id_formateur' => $id_formateur]);
    return $res->fetch(PDO::FETCH_ASSOC);
}
*/
