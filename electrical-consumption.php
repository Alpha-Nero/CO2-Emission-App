<?php 
include 'auth.php';
include('../layout/header.php');
$tableName = "tbl_monthly_consumption";
$tablename_emission ="tbl_emission_factor";
?>
      <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Electrical Consumption <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
          
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Electrical Consumption</h4>
                    <table id="example22" class=""  cellspacing="0" width="100%">
                        <thead>
                	    <tr>
                		<th style="width:1%">S.no</th>
                		<th>Month</th>
                		<th style="width:10%">Electrical Energy Consumption (in kWh)</th>
                		<th style="width:15%">GHG Emission in (tCO2)</th>
                		<th style="width:15%">Average Daily Emission  in tCO2e</th>
                		<th style="width:15%">Average Daily Emission per Project in tCO2e	</th>
                		<th>No of Projects</th>
                        </tr>
                        </thead>
                        <tbody>
                		<?php
                  //Select records
                	$manquery ="SELECT * FROM `tbl_monthly_consumption` WHERE `e_year`=2022 AND `data_source`='Electricity'";
                  //$entriesList =  $data->select($tableName); ;
                    $entriesList = $data->select_Query($manquery);
                  //print_r();
                  //echo'<pre>'; print_r($entriesList);
                	if(count($entriesList) > 0){
                		$count = 1;
                		foreach($entriesList as $entry){
                		    $mName =$entry['e_month'];
                		    $sql="SELECT pe.*, UPPER(LEFT( (MONTHNAME(pe.startDate)), 3)) AS m,YEAR(pe.startDate) AS y,DATEDIFF(pe.endDate,pe.startDate) AS days FROM tbl_project_emission AS pe where dataSourceName='Electricity' AND monthName='$mName' ";
                		   echo  $sql;
                		    $res = $data->select_Query($sql);
                		    if( !empty($res)){
                		   echo '<pre>';print_r($res);
                		    foreach($res as $rq){
                		        $m_q = $rq['m'];
                		        
                		        if( $m_q==$e_month){
                		            $totaldays= $rq['days'];
                		            echo  $totaldays.'<br>'.$m_q ;
                		        }
                		    }
                		    }
                		    $entry['e_month'];
                		    $id = $entry['id'];
                		    $name = $entry['data_source'];
                		    $e_year = $entry['e_year'];
                		    $where = "data_source='$name' AND e_year=$e_year";
                		    $results = $data->select_where($tablename_emission,$where);
                		    $data_value = $entry['monthly_consumption_value'];
                		    $e_month = $entry['e_month'];
                		    $emission_value= $data_value*$results[0]['data_value'];
                		   // echo $emission_value.'</br>';
                		    $daly_emisson = $emission_value/$totaldays;
                		 
                		    $Query_pp="SELECT YEAR(startDate) AS y, MONTH(startDate) AS m, COUNT(DISTINCT id) as totalProjects FROM tbl_project_emission GROUP BY y, m";
                		    $resp = $data->select_Query($Query_pp);
                		    $total_project = $resp[0]['totalProjects'];
                		    $pp_em_c=  $daly_emisson/$total_project;
                		    echo "<tr>
                		    	<td>".$count."</td>
                		    	<td>".$e_month."</td>
                		    	<td>".$data_value."</td>
                		    	<td>".$emission_value."</td>
                		    	<td>".$daly_emisson."</td>
                		    	<td>".$pp_em_c."</td>
                		    	<td>".$total_project."</td>
                		    </tr>
                		    ";
                		    $count++;
                		}
                	}else{
                		echo "<tr><td colspan='5'>No record found</td></tr>";
                	}
                	
                
                	?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © Alpha Nero 2023</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Created By <a href="https://yantrikas.com/" target="_blank">Yantrikas Technologies</a></span>
            </div>
          </footer>
          
        </div>
      
      </div>
     
    </div>
<?php include "../layout/footer.php";?>