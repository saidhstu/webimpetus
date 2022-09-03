<!-- footer div part -->
<div class="footer_part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <?php

                    function auto_copyright($year = 'auto')
                    {
                        if(intval($year) == 'auto'){ $year = date('Y');}
                        if(intval($year) == date('Y')){ echo intval($year);}
                        if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y');}
                        if(intval($year) > date('Y')){ echo date('Y');}
                    }
 
                    $appReleaseNotesDocURL = getenv('APP_RELEASE_NOTES_DOC_URL') ?: "https://webimpetus.cloud/";
                    //$appReleaseNotesDocURL = getenv('APP_RELEASE_NOTES_DOC_URL') ?: "https://webimpetus.dev/";
                    ?>
                    <p><?php auto_copyright("2009"); ?>&copy; Workstation - Powered by <a href="https://webimpetus.cloud/"> <i class="ti-heart"></i> </a><a href="https://webimpetus.cloud/"> WebImpetus <?php echo getenv('APP_DEPLOYED_AT');?></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer div part -->