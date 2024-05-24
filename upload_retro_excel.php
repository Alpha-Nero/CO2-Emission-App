<?php
// Check if the form is submitted
if(isset($_POST["save"])) {
    $targetDir = "retro_plan_excel/"; // Specify the target directory where the file will be stored
    
    

    // Check if a file was uploaded without errors
    if(isset($_FILES["retro_file"]) && $_FILES["retro_file"]["error"] == 0) {
        // Get file extension
        $fileExtension = pathinfo($_FILES["retro_file"]["name"], PATHINFO_EXTENSION);
        
        // Check if the uploaded file is an Excel file (XLSX or XLS)
        if(strtolower($fileExtension) == "xlsx" || strtolower($fileExtension) == "xls") {

            // Delete all files from the directory
    $files = glob($targetDir . "*"); // Get an array of all files in the directory
    foreach($files as $file) { // Iterate over each file
        if(is_file($file)) { // Check if it's a file (not a directory)
            unlink($file); // Delete the file
        }
    }
            // Specify the desired filename
            $desiredFilename = "Alpha_Nero_Emission_sheet.xlsx";
            
            // Specify the path of the file on the server with the desired filename
            $targetFile = $targetDir . $desiredFilename;
            
            // Try to move the uploaded file to the specified directory with the desired filename
            if(move_uploaded_file($_FILES["retro_file"]["tmp_name"], $targetFile)) {
                $success="File Uploaded Successfully";
                header("location:retro_plan.php?success=".$success);
            } else {
                $error="File not Uploaded";
                header("location:retro_plan.php?error=".$error);
            }
        } else {
            // Invalid file type, throw an error
            $error="Only Excel files (XLSX or XLS) are allowed.";
            header("location:retro_plan.php?error=".$error);
        }
    } else {
        echo "No file uploaded or an error occurred during upload.";
    }
}
?>
