<?php
include "database.php";

// Assuming your db.php file contains something like this:
// $host = "your_database_host";
// $username = "your_database_username";
// $password = "your_database_password";
// $database = "your_database_name";

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$DB_SERVER;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// $sql_graph = "SELECT *, (c.consumption_value) as emission_dss 
// FROM facility_data_source_subcategory as fdss 
// JOIN data_source_subcategory as dss ON fdss.data_source_subcategory_id = dss.data_source_subcategory_id 
// JOIN data_source as ds ON dss.data_source_id = ds.data_source_id 
// JOIN consumption as c ON dss.data_source_subcategory_id = c.data_source_subcategory_id 
// JOIN emission_factors as ef ON dss.data_source_subcategory_id = ef.data_source_subcategory_id 
// WHERE fdss.facility_id IN (1001) 
// AND ef.year = 2022
// AND ef.country_id = 101 
// AND c.consumption_year = 2022 
// AND ds.data_source_name = 'Waste' 
// AND fdss.facility_id = c.facility_id 
// AND dss.data_source_group_id = 5
// GROUP BY dss.data_source_subcategory_id";
// $sql_graph = "SELECT DISTINCT c.consumption_value as total, dsg.data_source_group_name, dss.data_source_subcategory_name, ds.data_source_name, dss.data_source_subcategory_unit 
// FROM data_source_subcategory as dss
// JOIN data_source as ds ON dss.data_source_id = ds.data_source_id
// JOIN data_source_group as dsg ON dsg.data_source_group_id = dss.data_source_group_id
// JOIN consumption as c ON dss.data_source_subcategory_id = c.data_source_subcategory_id
// JOIN dash_config as dc ON dss.data_source_subcategory_id = dc.data_source_subcategory_id
// JOIN facility_data_source_subcategory as fdss ON fdss.data_source_subcategory_id = dss.data_source_subcategory_id
// WHERE c.consumption_year = 2022 AND ds.data_source_name = 'Waste' AND c.facility_id IN (1001) 
// GROUP BY dss.data_source_subcategory_id";

// $sql_graph = "select c.consumption_year,dss.data_source_subcategory_name,sum(c.consumption_value) as p_total from consumption as c join data_source_subcategory as dss ON c.data_source_subcategory_id=dss.data_source_subcategory_id join emission_factors as ef ON ef.data_source_subcategory_id=dss.data_source_subcategory_id
// where c.consumption_year in (2020,2021,2022) and c.facility_id in (1001,1016) and dss.data_source_subcategory_name='Petrol' and ef.country_id=101 GROUP BY c.consumption_year";
// $sql_graph = "SELECT * ,SUM(c.consumption_value) as total_consumption, dsg.data_source_group_name
// FROM facility_data_source_subcategory as fdss
// JOIN data_source_subcategory as dss ON fdss.data_source_subcategory_id = dss.data_source_subcategory_id
// JOIN data_source as ds ON dss.data_source_id = ds.data_source_id
// JOIN data_source_group as dsg ON dsg.data_source_group_id = dss.data_source_group_id
// JOIN consumption as c ON dss.data_source_subcategory_id = c.data_source_subcategory_id
// WHERE fdss.facility_id IN (1001) AND fdss.facility_id = c.facility_id AND c.consumption_year = 2022 AND ds.data_source_name = 'Energy' AND dsg.data_source_group_id = 1
// GROUP BY dsg.data_source_group_id";

// $sql_graph = "SELECT * FROM  consumption WHERE consumption_year=2022 and consumption_month = 'February' and facility_id= 1001 and data_source_subcategory_id in (37,36,35,34,33,32,31,30,29,28,27,26,5)" ;
// $sql_graph = "select * from facility_data_source_subcategory as fdss
// join data_source_subcategory as dss on fdss.data_source_subcategory_id= dss.data_source_subcategory_id
// where  fdss.facility_id = 1001 and fdss.data_source_id = 1 and fdss.data_source_group_id= 6";


$sql_graph="SELECT *, SUM(c.consumption_value *ef.emission_factors_value * CASE WHEN c.consumption_value2 = 0 THEN 1 ELSE c.consumption_value2 END) as emission_value FROM tbl_month_consumption_sub as c
join emission_factors as ef on c.data_source_subcategory_id=ef.data_source_subcategory_id
join data_source_subcategory as dss on c.data_source_subcategory_id=dss.data_source_subcategory_id
join data_source as ds on dss.data_source_id = ds.data_source_id
where c.month in ('$month_name') and c.year in ($year_name) and ef.year in ($year_name) and dss.is_reduction='yes';";
try {
    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql_graph);

    // Execute the statement
    $stmt->execute();

    // Fetch all rows as an associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Print the results
    echo "<pre>";
    foreach ($result as $row) {
        print_r($row);
    }
    echo "</pre>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>
