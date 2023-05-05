<?php

function padronizePhoneNumber($telefone){
    $telefone = preg_replace('/(\+\d{1,3})?[ ]?(([(]\d{1,2}[)])|(\d{1,2}))?[ ]?([9]{1}\d{4})[ -]?(\d{4})/', '($2) $5$6', $telefone);
    return preg_replace("/(\(\))(.+)/", "(24)$2", $telefone);
}

