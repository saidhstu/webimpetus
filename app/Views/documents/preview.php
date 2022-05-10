<?php if (strlen(trim(@$document->file)) > 0) { ?>
    <div class="row form-group h_iframe">
        <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= @$document->file?>" width="960" height="1200"></iframe>

    </div><br><br>
<?php } ?>


<style>
    html, body {
    height:100%;
    width:100%;
    margin:0;
}
.h_iframe iframe {
    width:100%;
    height:100%;
}
.h_iframe {
    height: 100%;
    width:100%;
}
</style>