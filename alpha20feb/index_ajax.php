<?php
            include "database.php";

            if(isset( $_POST['itemname'])){
                $itemname=$_POST['itemname'];
                $emissiontype=$_POST['emissiontype'];
                $generate_pro_id=$_POST['proid'];

                
                $sql_chart = "SELECT it.item_code,it.item_description, 
                            SUM(ip.add_Item_to_project_item_quantity * it.item_emission_factor * COALESCE(NULLIF(ip.add_Item_to_project_item_quantity2, 0), 1)) as actual_emission, 
                            SUM(ip.add_Item_to_project_item_quantity * it.ideal_emission_factor * COALESCE(NULLIF(ip.add_Item_to_project_item_quantity2, 0), 1)) as ideal_emission
                            FROM project_master as pm
                            JOIN add_item_to_project as ip ON pm.project_master_id = ip.add_Item_to_project_assign_id
                            JOIN item as it ON ip.add_Item_to_project_item_id = it.item_id
                            JOIN item_category as ic ON ic.item_category_id = it.item_category_id
                            WHERE pm.project_master_id = $generate_pro_id and ic.item_category_name='$itemname'
                            GROUP BY it.item_code;
                            ";

                            $result_chart = mysqli_query($conn, $sql_chart);

                            $item_emission = array();
                            while ($row_chart = mysqli_fetch_assoc($result_chart)) {
                                $item_emission[] = $row_chart;
                                
                            }

                            echo json_encode($item_emission);

                        

            }

?>