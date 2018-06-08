<div id="sidebar" class="cs-wrapper-cell">
    <div class="cs-sidebar-box">
        <h3><?php _e('Plugin Info', $this->plugin_slug); ?></h3>
        <div class="cs-sidebar-box-inner">
            <?php $plugin_data = Code_Scanner_Functions::plugin_info($this->plugin_slug); ?>
            <table class="cs-table">
                <tr>
                    <td>
                        <i class="fa fa-plug" aria-hidden="true"></i>
                    </td>
                    <th>
                        Name: 
                    </th>
                    <td>
                        <?php
                        echo!empty($plugin_data['PluginURI']) ? '<a href="' . $plugin_data['PluginURI'] . '" target="_blank">' : "";
                        echo!empty($plugin_data['Name']) ? $plugin_data['Name'] : '';
                        echo!empty($plugin_data['Version']) ? ' v' . $plugin_data['Version'] : '';
                        echo!empty($plugin_data['PluginURI']) ? '</a>' : "";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </td>
                    <th>
                        Author: 
                    </th>
                    <td>
                        <?php echo!empty($plugin_data['AuthorURI']) ? '<a href="' . $plugin_data['AuthorURI'] . '" target="_blank">' . $plugin_data['AuthorName'] . '</a>' : ''; ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <i class="fa fa-github" aria-hidden="true"></i>
                    </td>
                    <th>
                        GitHub: 
                    </th>
                    <td>
                        <?php echo '<a href="' . CODE_SCANNER_GITHUB_URL . basename($plugin_data['PluginURI']) . '" target="_blank">' . $this->plugin_slug . '</a>'; ?>
                    </td>
                </tr>
            </table>        
        </div>
    </div>
</div>