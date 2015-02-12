<!doctype HTML>
<html>
    <head>
        <title>PHP Upload File</title>
    </head>
    <body>
        <?php 
        if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
            $uploadDir = './uploads/';
            $maxFileSize = 1 * 1024;
            $allowTypes = array('jpg', 'jpeg', 'gif');
            $uploadData = $_FILES['image'];
            $fileSize = $uploadData['size'] / 1024;
            $tmpFile = $uploadData['tmp_name'];
            
            $fileName = $uploadData['name'];
            
            $explodeFileName = explode('.', $fileName);
            $extention = end($explodeFileName);
            
            if(!in_array($extention, $allowTypes)){
                echo "Upload file Error, file not allowed";
            } elseif($fileSize > $maxFileSize){
                echo "File size too large, max size {$maxFileSize} Kb";
            } else {
                if(move_uploaded_file($tmpFile, $uploadDir . $fileName)){
                    echo "File success uploaded";
                } else {
                    echo "Failed uploaded";
                }
            }
        }
        ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" /><br/>
            <button type="submit">Upload</button>
        </form>
    </body>
</html>