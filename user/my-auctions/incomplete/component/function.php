<?php
        function uploadVideo($auctionId){
        $uploadComponent = "
                <div id=\"videoUploadDiv\" calss=\"\">
                <form action=\"component/uploadVideo.php\" method=\"POST\" enctype=\"multipart/form-data\">
                        <lablel for=\"file\" class=\"\" name=\"lblUploadVideo\" id=\"lblUploadVideo\">Upload Your Livestock Video</label><br> 
                        <input type=\"file\" name=\"file\" id=\"file\">
                        <input type=\"hidden\" name=\"auctionID\" value=\"$auctionId\">
                        <input type=\"submit\" name=\"submitVideo\" value=\"Submit\">
                </div>";
        return $uploadComponent;
        }