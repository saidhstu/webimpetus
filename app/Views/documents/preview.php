
<head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="iframeContainer"></div>
</body>
<script>
    
    var URL = "https://docs.google.com/viewer?url=<?= trim($document->file)?>&embedded=true";
    var count = 0;
        var iframe = ` <iframe id = "myIframe" src = "${URL}" style = "width:100%; height:100%;"  frameborder = "0"></iframe>`;
            
        $(`#iframeContainer`).html(iframe);
        $('#myIframe').on('load', function(){ 
            count++;
            if(count>0){
                clearInterval(ref)
            }
        });

        var ref = setInterval(()=>{
        $(`#iframeContainer`).html(iframe);
        $('#myIframe').on('load', function() {
            count++;
            if (count > 0) {
                clearInterval(ref)
            }
        });
    }, 2000)
</script>
