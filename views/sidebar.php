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
    <div class="cs-sidebar-box">
        <h3><?php _e('Donate!', $this->plugin_slug); ?></h3>
        <div class="cs-sidebar-box-inner">
            <p>Any donations are appreciated!</p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHNwYJKoZIhvcNAQcEoIIHKDCCByQCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCpNpoGrIq370bt5SDFjqcQBEQW/eB3fsDkN1ErPkdCjdNdnCkUSf1ciXj3uxneunk0xnCb1s4VjSwo8LFcOO7Wm0NYFuCngOQhWFCc6WfbOys46JAqn2KQC9vbBwr2e4zuS+EUu2n9J+9gIIfP0ER/5ffWd6RSPtlHVUvlOme1BTELMAkGBSsOAwIaBQAwgbQGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIHVtcNby2O7eAgZDv4opzUgn4LiYmnWW5/OFGuJhb2tbYjfphBAcsQDsYfJtGifAetNf3DCUORDgwGv9as+aen9JwuBFT/9s4Z0J45AOEL57glceUMlzjncYg2tIIvfHaKPElH/SGhKYjZ1DTMF9H28zN1OYS0cvjDBdgvsFRtEDnhlLTQ7kyI6MrHeGIRnQwePAd7oPKKamUlNOgggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xODA2MTQwMDU0NDNaMCMGCSqGSIb3DQEJBDEWBBQMV63VbejauAC30ZClzb2sG+a81DANBgkqhkiG9w0BAQEFAASBgBKjRZrpUrLbv/3Wo+ln/vAx3Ku1QMZHDLjcY4wwvGFBze3MJqXaWOZnriHV7ZQah6lAgr5/8469t5yY1KxFAgm5ggNzbvzqyu5X5aqlzorTxEjpMS5t+cz3kVhrumaYiUaILLwakhiHFTqix4Kryw6fGu2uMLgLx8we2XbF52SX-----END PKCS7-----
                       ">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
    </div>
</div>