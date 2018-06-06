<div class="cs-wrapper">
    <div id="scan-results" class="wrapper-cell">
        <h2>Scan results:</h2>
        <div id="scan-results-inner">
            <h3 class='dashicons-before dashicons-admin-plugins'>  Plugins:</h3>
            <?php echo Code_Scanner::load_result('plugin'); ?>

            <h3 class='dashicons-before dashicons-admin-plugins'>  Themes:</h3>
            <?php echo Code_Scanner::load_result('theme'); ?>

            <h3 class='dashicons-before dashicons-admin-plugins'>  Core files:</h3>
            <?php echo Code_Scanner::load_result('core'); ?>
        </div>
    </div>
</div>