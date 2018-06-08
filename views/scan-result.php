<?php
$directories = $this->scan_results['directories'];

if ($this->scan_results['file_error_count'] > 0) {
    ?>
    <div class="cs-error-count">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Possible malicious code found in <?php echo $this->scan_results['file_error_count']; ?> files (<?php echo $this->scan_results['dir_error_count']; ?> directories).
    </div> 
<?php } else { ?>
    <div class="cs-no-errors">
        <i class="fa fa-check-circle" aria-hidden="true"></i> No errors were found in this directory.
    </div> 
<?php } ?>  

<?php foreach ($directories as $directory => $files) { ?>
    <div class='cs-directory-container'>
        <div class='cs-directory' onclick="cs_showHideSlide('spn-<?php echo $directory; ?>', 'div-<?php echo $directory; ?>');"><i class='fa fa-folder-open-o' aria-hidden='true' style='margin-right:10px;'></i><?php echo $directory; ?>
            <span class='cs-toggle-button dashicons dashicons-arrow-up' id='<?php echo "spn-" . $directory; ?>'></span>
        </div>
        <div style="display:none;" id='div-<?php echo $directory; ?>'>
            <?php
            foreach ($files AS $file => $errors) {
                $filename = substr($file, strrpos($file, '/') + 1);
                ?>
                <div class='cs-file-container'>                    
                    <div class='cs-file' onclick="cs_showHideSlide(<?php echo "'spn-" . $directory . "-" . str_replace(".php", "", $filename) . "', 'div-" . $directory . "-" . str_replace(".php", "", $filename) . "'"; ?>);">
                        <i class='fa fa-file-o' aria-hidden='true' style='margin-right:10px;'></i><b><?php echo $filename; ?></b>
                        <?php if ($this->dir_type != 'core') { ?>
                            <span style='margin-left:5px;font-size:13px;'><a href='#' onclick="window.open('<?php echo Code_Scanner_Functions::get_edit_link($this->dir_type, $directory, $filename); ?>');event.stopPropagation();">Edit</a></span>
                        <?php } ?>
                        <span class='cs-toggle-button dashicons dashicons-arrow-down' id='<?php echo "spn-" . $directory . "-" . str_replace(".php", "", $filename); ?>'></span>
                    </div>
                    <div class='cs-lines-container' id='<?php echo "div-" . $directory . "-" . str_replace(".php", "", $filename); ?>'>
                        <?php foreach ($errors AS $error) { ?>
                            <div class='cs-line-container'>
                                <div class='cs-line-index'><?php echo $error['line_index']; ?></div>
                                <div class='cs-line'><?php echo preg_replace("/(" . preg_quote($error['injection']) . ")/", "<span class=\"cs-line-injection\">$1</span>", $error['line']); ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
} 