<?php
function insert_formateur_paiement(PDO $conn, array $data) {
    $sql = "INSERT INTO formateur_paiement(id_formation ,id_session,id_formateur,date,montant_paye,montant_modifier) 
            VALUES (:id_formation ,:id_session,:id_formateur,:date,:montant_paye,:montant_modifier)";
    $ins = $conn->prepare($sql);
    $ins->execute(prepare_data($data));
}

function liste_formateur_paiements(PDO $conn, int $id_formation,int $id_session,int $id_formateur) {
    $sql = "SELECT fss.id_formation,fss.id_session,fss.id_formateur,
    ft.nom as nom_formateur , sf.nom_session as nom_session ,
    fr.nom as nom_formation , fss.montant_total as mt_tt,
    fp.date as dat , fp.montant_paye as montant_paye ,
    fp.montant_modifier as montant_rembourser
    
    FROM formateur ft , formation fr, formateur_session fss , formateur_paiement fp
    INNER JOIN session_formation sf 
    ON fp.id_session = sf.id_session 
    WHERE fp.id_formateur = ft.id_formateur 
    AND sf.id_formation = fr.id_formation
    AND fp.id_formation = :id_formation
    AND fp.id_session = :id_session
    AND fp.id_formateur = :id_formateur
    GROUP BY fp.date , fp.id_formation ,fp.id_session,fp.id_formateur";
    // $res = $conn->query($sql);
    $res = $conn->prepare($sql);
    $res->execute([':id_formation' => $id_formation,':id_session' => $id_session,':id_formateur' => $id_formateur]);   
    return $res->fetchALL(PDO::FETCH_ASSOC);
}
function paye(PDO $conn, int $id_formation,int $id_session,int $id_formateur, float $montant) {
    $sql = "SELECT distinct(fp.date),(:montant+SUM(fp.montant_modifier))-(SUM(fp.montant_paye)) as reste
    FROM formateur_paiement fp
    WHERE fp.id_formation = :id_formation
    AND fp.id_session = :id_session
    AND fp.id_formateur = :id_formateur";
   
   $res = $conn->prepare($sql);
   $res->execute([':id_formation' => $id_formation,':id_session' => $id_session,':id_formateur' => $id_formateur, ':montant'=>$montant]);
   
   return $res->fetch(PDO::FETCH_ASSOC);
}
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