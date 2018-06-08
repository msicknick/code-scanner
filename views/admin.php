<div class='wrap'>    
    <h1>
        <img style="width: 30px;height: 30px;vertical-align: middle;" src="<?php echo CS_MS_IMAGES_URL . "cs-icon.png"; ?>">
        <div style="display:inline-block;vertical-align:text-bottom;">Code Scanner</div>
        <p class='description'> Scans your plugin, theme, and core directories for suspicious code.</p>
    </h1>
    
    <div class="cs-wrapper">
        
            <?php include_once(CS_MS_VIEWS_PATH . "description.php"); ?>
     
        
            <?php include_once(CS_MS_VIEWS_PATH . "sidebar.php"); ?>
        
    </div>  

    <?php include_once(CS_MS_VIEWS_PATH . "scan-results.php"); ?>

</div>