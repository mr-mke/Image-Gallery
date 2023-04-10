<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
if(isset($_POST['submitted'])){
    session_start();
    foreach($_POST as $key => $value){
        $$key=$value;
    }
    $_SESSION['useDemoValues']=$useDemoValues;
    $_SESSION['imageTypes']=$imageTypes;
    $_SESSION['submitted']=$submitted;
    $_SESSION['pageTitle']=$pageTitle;
    $_SESSION['pageMainTitle']=$pageMainTitle;
    $_SESSION['pageSubtitle']=$pageSubtitle;
    $_SESSION['pageDiscription']=$pageDiscription;
    $_SESSION['returnLink']=$returnLink;
    $_SESSION['returnLabel']=$returnLabel;
    $_SESSION['color']=$color;
    $_SESSION['bgColor']=$bgColor;
    $_SESSION['imagePath']=$imagePath;
    header("Location: gallery.php");
    die();
}else{
    session_unset();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Gallery Call Demo</title>
        <meta charset="utf8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }

            h2{
                text-align: center;
            }
            
            input[type=text], select, textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }

            label {
                padding: 12px 12px 12px 0;
                display: inline-block;
            }

            button {
                background-color: #04AA6D;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
            }

            button:hover {
                background-color: #45a049;
            }

            .container {
                width: 80%;
                margin: auto;
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }

            .col-15 {
                float: right;
                width: 15%;
                margin-top: 6px;
            }

            .col-25 {
                float: left;
                width: 25%;
                margin-top: 6px;
            }

            .col-75 {
                float: left;
                width: 75%;
                margin-top: 6px;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
                .col-25, .col-75, input[type=submit] {
                    width: 100%;
                    margin-top: 0;
                }
            }
        </style>
    </head>
    <body>
        <h2>Gallery Call Demo</h2>
        <div class="container">
            <form method="post">

                <div class="row">
                    <div class="col-25">
                        <label for="pageTitle">Page title</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="pageTitle" placeholder="Page Title.." value="Responsive Gallery">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pageMainTitle">Page Main Title</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="pageMainTitle" placeholder="Page Main Title.." value="Responsive Gallery">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pageSubtitle">Page Subtitle</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="pageSubtitle" placeholder="Page Subtitle.."  value="By mr_mke">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="pageDiscription">Page Discription</label>
                    </div>
                    <div class="col-75">
                        <textarea name="pageDiscription" placeholder="Write something.." style="height:200px">Click on a picture to view, click on download icon to download and click on close icon to return</textarea>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-25">
                        <label for="country">Colors</label>
                    </div>
                    <div class="col-75">
                        Text: <input type="color" name="color" value="#000000"> Background: <input type="color" id="bgColor" name="bgColor" value="#ffffff">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="imagePath">Image Path</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="imagePath" placeholder="Image Path.." value=".">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="imageTypes">Image Types</label>
                    </div>
                    <div class="col-75">
                    jpg: <input type="checkbox" name="imageTypes[1]" value="JPG" checked> 
                    png: <input type="checkbox" name="imageTypes[2]" value="PNG" checked> 
                    gif: <input type="checkbox" name="imageTypes[3]" value="GIF">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="returnLink">Show Return</label>
                    </div>
                    <div class="col-75">
                        <input type="hidden" name="showReturnLink" value="no">
                        <input type="checkbox" name="showReturnLink" value="yes" checked> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="returnLink">Return Link</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="returnLink" placeholder="Return Link.." value="index.php">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="returnLabel">Return Label</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="returnLabel" placeholder="Return Label.." value=" Return ">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="returnLink">Use Demo Values</label>
                    </div>
                    <div class="col-75">
                        <input type="hidden" name="useDemoValues" value="no">
                        <input type="checkbox" name="useDemoValues" value="yes"> 
                    </div>
                </div>

                <input type="hidden" name="submitted" value="1">

                <div class="row">
                    <div class="col-15">
                        <button type="submit">Send Via Session..</button>
                    </div>
                    <div class="col-15">
                        <button type="submit" formaction="gallery.php" formmethod="post">Send Via Post..</button> 
                    </div>
                    <div class="col-15">
                        <button type="submit" formaction="gallery.php" formmethod="get">Send Via get..</button> 
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>