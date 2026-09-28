<?php

/*==================== FUNZIONI PER GESTIONE SUBSCRIBERS ================== */

function getListOFSubscribers() {
    global $database;
    $resour = $database->db_query("SELECT * FROM  newsletter_emails ORDER BY ID DESC");
    $subscribers = $database->db_fetch_allrows($resour);
    return $subscribers;
}

function SubscribersToExcel() {
    
    $newsletterSubscribers = getListOfNewsletter();
    
    $myfile = fopen("docs/excel-users/SubscribersExcel.xls", "w");
         
            $header = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
            $header .= '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">';
            fwrite($myfile,$header);
            $worksheet = '<Worksheet ss:Name="Subscribers">'."\n".'<Table>'."\n";
            fwrite($myfile,$worksheet);
            $setColumns = '<Column ss:AutoFitWidth="0" ss:Width="193.5"/>'."\n".'<Column ss:AutoFitWidth="0" ss:Width="321.75"/>'."\n".'<Column ss:AutoFitWidth="0" ss:Width="569.25"/>'."\n";
            fwrite($myfile,$setColumns);
            fwrite($myfile,'<Row>\n');
            fwrite($myfile,'<Cell ss:Style="Bold"><Data ss:Type="String">NAME</Data></Cell>\n');
            fwrite($myfile,'<Cell ss:Style="Bold"><Data ss:Type="String">EMAIL</Data></Cell>\n');
            fwrite($myfile,'<Cell ss:Style="Bold"><Data ss:Type="String">TOKEN</Data></Cell>\n');
            fwrite($myfile,"</Row>\n");
            foreach ($newsletterSubscribers as $ns) {
                if ($ns["NEWSLETTER"] == 'Y') {
                    fwrite($myfile,"<Row>\n");
                    fwrite($myfile,'<Cell><Data ss:Type="String">'.$ns["NAME"]."</Data></Cell>\n");
                    fwrite($myfile,'<Cell><Data ss:Type="String">'.$ns["EMAIL"]."</Data></Cell>\n");
                    fwrite($myfile,'<Cell><Data ss:Type="String">'.$ns["TOKEN"]."</Data></Cell>\n");
                    fwrite($myfile,"</Row>\n");
                }
            }
            
            $endsheet = '</Table>'."\n".'</Worksheet>'."\n";
            fwrite($myfile,$endsheet);
    
            $worksheet2 = '<Worksheet ss:Name="Non Subscribers">'."\n".'<Table>'."\n";
            fwrite($myfile,$worksheet2);
            $setColumns = '<Column ss:AutoFitWidth="0" ss:Width="193.5"/>'."\n".'<Column ss:AutoFitWidth="0" ss:Width="321.75"/>'."\n".'<Column ss:AutoFitWidth="0" ss:Width="569.25"/>'."\n";
            fwrite($myfile,$setColumns);
            fwrite($myfile,'<Row ss:Style="Bold">\n');
            fwrite($myfile,'<Cell><Data ss:Type="String">NAME</Data></Cell>\n');
            fwrite($myfile,'<Cell><Data ss:Type="String">EMAIL</Data></Cell>\n');
            fwrite($myfile,'<Cell><Data ss:Type="String">TOKEN</Data></Cell>\n');
            fwrite($myfile,"</Row>\n");
            foreach ($newsletterSubscribers as $ns) {
                if ($ns["NEWSLETTER"] != 'Y') {
                    fwrite($myfile,"<Row>\n");
                    fwrite($myfile,'<Cell><Data ss:Type="String">'.$ns["NAME"]."</Data></Cell>\n");
                    fwrite($myfile,'<Cell><Data ss:Type="String">'.$ns["EMAIL"]."</Data></Cell>\n");
                    fwrite($myfile,'<Cell><Data ss:Type="String">'.$ns["TOKEN"]."</Data></Cell>\n");
                    fwrite($myfile,"</Row>\n");
                }
            }
            $endsheet = '</Table>'."\n".'</Worksheet>'."\n".'</Workbook>';
            fwrite($myfile,$endsheet);
    
    fclose($myfile); 
    
}

function  getListOfNewsletter() {
    global $database;
    $resour = $database->db_query("SELECT * FROM  newsletter_emails WHERE TOKEN != '' ORDER BY ID DESC");
    $subscribers = $database->db_fetch_allrows($resour);
    return $subscribers;    
}

function DeleteSubscriber($ID) {
    global $database;
    $ID = (int)$ID;
    $query = "delete from newsletter_emails WHERE ID=".$ID;
    $result=$database->db_query($query);
    return $result;
}

?>