
<?php
    
    // Funktionen sorterar in personerna under deras respektive profession
    // Funktionen använder sig av $peo_result som är arrayen med personer
    // från sökningen. $profession är det andra värdet som används när man
    // kör funktionen.
    
    function peo_table ($peo_result,$profession) {
	// Arrayen loopas igenom där namnen från respektive
	// kolumn läggs in i varsin variabel.
	foreach ($peo_result as $peo_row) {
	    $firstname=$peo_row['peo_firstname'];
	    $lastname=$peo_row['peo_lastname']; 
	    
	    // Här skrivs namnen ut om columnen från tabellen matchar table-headern
	    // Om det matchar så skrivs för och eftenamn in i tabellen under tableheadern
	    // i respektive td.
	    if ($peo_row['profession']==$profession) {
		echo "<tr>";
		    echo "<td>" . $firstname . "</td>";
		    echo "<td>" . $lastname . "</td>";
		echo "</tr>";
	    }
	}
    }

?>
