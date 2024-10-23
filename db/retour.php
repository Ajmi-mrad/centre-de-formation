<?php
function liste_retours(PDO $conn) {
    $sql = "SELECT es.id_session,es.id_formation,es.id_eleve,
    ft.nom as nom_formateur , sf.nom_session as nom_session ,
    fr.nom as nom_formation , fss.montant_total as salaire ,
    e.nom as nom_eleve, SUM(ep.montant_paye)-SUM(ep.montant_modifier) as retour
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
    -- AND ep.id_formation = :id_formation
    -- AND ep.id_session = :id_session
    -- AND ep.id_eleve = :id_eleve
    GROUP BY fss.id_formation ,fss.id_session,fss.id_formateur
    ";
    $res = $conn->query($sql);
    return $res->fetchAll(PDO::FETCH_ASSOC);
}