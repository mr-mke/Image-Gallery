<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
if(isset($_POST['submitted'])){
    foreach($_POST as $key => $value){
        $$key=$value;
    }
}elseif(isset($GET['submitted'])){
    foreach($GET as $key => $value){
        $$key=$value;
    }
}elseif(isset($_SESSION['submitted'])){
    foreach($_SESSION as $key => $value){
        $$key=$value;
    }
}else{
    die("No data set for gallery to display...");
}
if($useDemoValues == "yes"){
    if($pageTitle==""){
        $pageTitle="Responsive Gallery";
    }
    if($pageMainTitle==""){
        $pageMainTitle="Responsive Gallery";
    }
    if($pageSubtitle==""){
        $pageSubtitle="By mr_mke";
    }
    if($pageDiscription == ""){
        $pageDiscription="Click on a picture to view, click on download icon to download and click on close icon to return";
    }
    if($returnLink==""){
        $returnLink="index.php";
    }
    if($returnLabel==""){
        $returnLabel="Return...";
    }
    if($imagePath == ""){
        $imagePath=".";
    }
    if($bgColor == ""){
        $bgColor="white";   
    }
    if($color == ""){
        $color="black";
    }                                        
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $pageTitle ?></title>
        <meta charset="utf8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }
            body {
                margin: 0;
                font-family: Arial;
                color:<?php echo $color;?>;
                background-color: <?php echo $bgColor; ?>;
            }
            a{
                color: white;
            }
            button {
                background-color: #04AA6D;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover {
                background-color: #45a049;
            }
            .header {
                text-align: center;
                padding: 32px;
            }
            .row {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                padding: 0 4px;
            }
            .column {
                -ms-flex: 25%;
                flex: 25%;
                max-width: 25%;
                padding: 0 4px;
            }
            .column img {
                margin-top: 8px;
                vertical-align: middle;
                width: 100%;
            }
            @media screen and (max-width: 800px) {
                .column {
                    -ms-flex: 50%;
                    flex: 50%;
                    max-width: 50%;
                }
            }
            @media screen and (max-width: 600px) {
                .column {
                    -ms-flex: 100%;
                    flex: 100%;
                    max-width: 100%;
                }
            }
            .galleryImage{
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }
            .galleryImage:hover{
                opacity: 0.7;
            }
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.9);
            }
            .modal-content {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 800px;
            }
            #caption {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
                text-align: center;
                color: #ccc;
                padding: 10px 0;
                height: 150px;
            }
            .modal-content, #caption {
                -webkit-animation-name: zoom;
                -webkit-animation-duration: 0.6s;
                animation-name: zoom;
                animation-duration: 0.6s;
            }
            @-webkit-keyframes zoom {
                from {-webkit-transform:scale(0)}
                to {-webkit-transform:scale(1)}
            }
            @keyframes zoom {
                from {transform:scale(0)}
                to {transform:scale(1)}
            }
            .close {
                position: absolute;
                top: 15px;
                right: 35px;
                color: #f1f1f1;
                font-size: 40px;
                font-weight: bold;
                transition: 0.3s;
            }
            .close:hover,
            .close:focus {
                color: #bbb;
                text-decoration: none;
                cursor: pointer;
            }
            @media only screen and (max-width: 700px){
                .modal-content {
                    width: 100%;
                }
            }
            .returnButton{
                text-align: center;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1><?php echo $pageMainTitle; ?></h1>
            <h2><?php echo $pageSubtitle; ?></h2>
            <h3><?php echo $pageDiscription; ?></h3>
        </div>
<?php
$fileList=scandir($imagePath);
$picList=array();
foreach($fileList as $key => $value){
    if(in_array(strtoupper(substr($value,-3)),$imageTypes)){
        $picList[]=$value;
    }
}

$colCount=4;
$picCount=count($picList);
$colSize=intval($picCount / $colCount);
$extras=$picCount % $colCount;
$cols=array();

for($i=0;$i<$colCount;$i++){
    $cols[$i]=$colSize;
    if($extras != 0){
        $cols[$i]++;
        $extras--;
    }
}
echo "<div class=\"row\">\n";
$n=0;
for($i=0;$i<$colCount;$i++){
    echo "<div class=\"column\">\n";
    for($j=0;$j<$cols[$i];$j++){
        echo "<img src=\"$imagePath/$picList[$n]\" onclick=\"show(this);\" alt=\"$picList[$n]\" class=\"galleryImage\">\n";
        $n++;
    }
    echo "</div>\n";
}
echo "</div><br><br>";

if($returnLink != ""){
    echo "<div class=\"returnButton\">";
    echo "<button type=\"button\" onclick=\"window.location='$returnLink';\">$returnLabel</button>";
    echo "</div><br><br>";
}
?>
        <div id="myModal" class="modal">
            <span class="close" onclick="hide();">&times;</span>
            <img class="modal-content" id="img01" onclick="hide();">
            <div id="caption"></div>
        </div>
        <script>
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            var span = document.getElementsByClassName("close")[0];
            function hide(){
                modal.style.display = "none";
            }
            function show(img){
                modal.style.display = "block";
                modalImg.src = img.src;
                captionText.innerHTML = "<a href='" + img.src + "' download><img src='download.png' width='20px'></a>";
            }
        </script>
    </body>
</html>