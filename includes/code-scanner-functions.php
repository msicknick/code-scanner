<?php

/**
 *  Class file to keep all the functions used throughout the plugin
 */

class Code_Scanner_Functions {

    /**
     * Get plugin info
     *
     * @since 1.0.0
     * @param string $plugin_slug
     * @return array
     */
    public static function plugin_info($plugin_slug) {
        add_filter('extra_plugin_headers', create_function('', 'return array("GitHub Plugin URI","Twitter");'));
        $plugin_data = get_plugin_data(CS_MS_PATH . $plugin_slug . '.php');

        return $plugin_data;
    }

    /**
     * 
     * @param type $dir_type
     * @return type
     */
    public static function get_edit_link($dir_type, $directory, $filename) {

        switch ($dir_type) {
            case "theme":
                $edit_link = admin_url('theme-editor.php?file=' . $filename . '&theme=' . $directory);
                break;
            case "plugin":
                $edit_link = admin_url('plugin-editor.php?file=' . $directory . '%2F' . $filename . '&plugin=' . $directory . "%2Facf.php");
                break;
        }

        return $edit_link;
    }

    /**
     * Find all php files within directory
     * 
     * @since 1.0.0
     * @param string $path
     * @return array
     */
    public static function find_recursive_php_files($path) {
        $files = array();
        $fileNameArr = array();
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($iterator as $path) {
            if ($path->isDir()) {
                continue;
            } else {
                $fileNameArr = explode(".", $path);
                if ('php' == end($fileNameArr)) {
                    $files[] = $path->__toString();
                }
            }
        }
        return $files;
    }

    /**
     * Scan directory for code injections
     * 
     * @since 1.0.0
     * @param string $root_dir
     * @param array $code_injections
     * @return array
     */
    public static function scan_directory($root_dir, $code_injections) {

        $directories = array();
        $filenames = array();

        foreach (new DirectoryIterator($root_dir) as $file) {
            if ($file->isDir() && !$file->isDot()) {
                $filenames[] = $file->getFilename();
            }
        }

        foreach ($filenames as $k => $d) {
            // Ignore self
            if ($d == 'code-scanner') {
                unset($filenames[$k]);
            }
            // Ignore scanning wp-content twice (Core files scan)
            if ($d == basename(content_url())) {
                unset($filenames[$k]);
            }
        }

        if (count($filenames) > 0) {
            foreach ($filenames as $dir) {
                $directories[$dir] = self::find_recursive_php_files($root_dir . "/" . $dir);
            }
            foreach ($directories as $key => $files) {

                if (is_array($files)) {
                    foreach ($files as $file) {
                        $lines = file($file, FILE_IGNORE_NEW_LINES);
                        $line_index = 1;

                        foreach ($lines as $line) {

                            foreach ($code_injections AS $injection) {
                                if (stristr($line, $injection)) {
                                    $directories[$key][$file][] = array(
                                        "line" => $line
                                        , "injection" => $injection
                                        , "line_index" => $line_index
                                    );
                                }
                            }
                            $line_index++;
                        }

                        if (($key2 = array_search($file, $directories[$key])) !== false) {
                            // Remove sub-directories without any errors
                            unset($directories[$key][$key2]);
                        }
                    }
                }

                if (empty($directories[$key])) {
                    // Remove root directories without any errors
                    unset($directories[$key]);
                }

                $file_error_count += count($directories[$key]);
            }
        }

        return array("directories" => $directories, "file_error_count" => $file_error_count, "dir_error_count" => count($directories));
    }

}
