<?php
/**
 * Created by PhpStorm.
 * User: aured
 * Date: 17/12/2017
 * Time: 23:40
 */
$tachesParPage=5;
if (isset($list)) {
    $nbTaches=TacheGateway::GetNumberOfTache($list->getId());
    $nombreDePages=ceil($nbTaches/$tachesParPage);
    if(isset($_GET['page'])){
        $pageActuelle=intval($_GET['page']);
        if($pageActuelle>$nombreDePages){
            $pageActuelle=$nombreDePages;
        }
    }
    else{
        $pageActuelle=1;
        $premiereEntree=($pageActuelle-1)*$messagesParPage;
    }
    $res=TacheGateway::findLimitByList($list->getId(),$pageActuelle,$tachesParPage);
}
