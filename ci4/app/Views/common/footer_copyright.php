<!-- footer div part -->
<div class="footer_part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <?php

                    function auto_copyright($year = 'auto')
                    {
                        if($year == 'auto'){ $year = date('Y');}
                        if(intval($year) == date('Y')){ echo "<!--" . intval($year) . "-->";}
                        if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y');}
                        if(intval($year) > date('Y')){ echo "<!--" . date('Y') . "-->";}
                    }
 
                    $appReleaseNotesDocURL = getenv('APP_RELEASE_NOTES_DOC_URL') ?: "https://webimpetus.cloud/";
                    $appEnvironment = getenv('APP_ENVIRONMENT') ?: "dev";
                    $targetCluster = getenv('APP_TARGET_CLUSTER') ?: "k3s-rancher-desktop";
                    $hostName = getenv('HOSTNAME') ?: "hostname-env-var-not-set";

                    $webImpetusCopyRight = "© " . auto_copyright() . " All rights reserved.&nbsp;";
                    $webImpetusCopyRight .= "<br />";
                    $webImpetusCopyRight .= "Cluster: " . ucfirst($targetCluster) . ".";
                    if ($appEnvironment == "prod" || $appEnvironment == "Prod") {
                        // Do not add prod env for final production environment
                    } else {
                        $webImpetusCopyRight .= " Environment: " . ucfirst($appEnvironment) . ".";
                    }
                    $webImpetusCopyRight .= " Hostname: " . $hostName . ".";
                    ?>
                    <p><?php auto_copyright("2009"); ?>&nbsp;&copy;&nbsp;Workstation&nbsp;-&nbsp;Powered&nbsp;by&nbsp;<a href="https://webimpetus.cloud/"> <i class="ti-heart"></i>&nbsp;Webimpetus</a>&nbsp;<?php echo $webImpetusCopyRight; ?></p>
                    <p><a target="_blank" href="<?php echo $appReleaseNotesDocURL; ?>"> WebImpetus Version: <?php echo getenv('APP_DEPLOYED_AT'); ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer div part -->