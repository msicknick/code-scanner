<div class="cs-wrapper">
    <div id="scan-results" class="wrapper-cell">
        <h2>Scan results:</h2>
        <div id="scan-results-inner">
            <h3 class='dashicons-before dashicons-admin-plugins'>  Plugins:</h3>
            <?php
            $this->dir_type = 'plugin';
            $this->scan_results = Code_Scanner_Functions::scan_directory($this->plugins_root_dir, $this->code_injections);
            require(CS_MS_VIEWS_PATH . 'scan-result.php');
            ?>

            <h3 class='dashicons-before dashicons-admin-appearance'>  Themes:</h3>
            <?php
            $this->dir_type = 'theme';
            $this->scan_results = Code_Scanner_Functions::scan_directory($this->themes_root_dir, $this->code_injections);            
            require(CS_MS_VIEWS_PATH . 'scan-result.php');
            ?>

            <h3 class='dashicons-before dashicons-wordpress'>  Core files:</h3>
            <?php 
            $this->dir_type = 'code';
            $this->scan_results = Code_Scanner_Functions::scan_directory($this->wp_root_dir, $this->code_injections);
            require(CS_MS_VIEWS_PATH . 'scan-result.php');
            ?>
        </div>
    </div>
</div>