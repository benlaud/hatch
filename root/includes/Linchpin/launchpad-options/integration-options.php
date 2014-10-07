<div id="integration-options">
    <h3><?php _e('Integration Options', 'launchpad'); ?></h3>

    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><?php _e('Typekit ID', 'launchpad'); ?></th>

                <td>
                    <div>
                        <label class="screen-reader-text" for="typekit_id"><span><?php _e('Typekit ID', 'launchpad'); ?></span></label> <input type="text" name="launchpad_theme_options[typekit_id]" class="regular-text" id="typekit_id" value="<?php echo esc_attr($launchpad_options['typekit_id']); ?>"> <label class="screen-reader-text" for="typekit_async"><span><?php _e('Load TypeKit Asyncronously', 'launchpad'); ?></span></label> <select name="launchpad_theme_options[typekit_async]" id="launchpad_theme_options[typekit_async]">
                            <option value="true" <?php selected($launchpad_options['typekit_async'], true); ?>>
                                <?php echo _e('Yes', 'launchpad'); ?>
                            </option>

                            <option value="false" <?php selected($launchpad_options['typekit_async'], false); ?>>
                                <?php echo _e('No', 'launchpad'); ?>
                            </option>
                        </select>

                        <p class="description"><?php printf(__('Enter your Typekit ID. You can get the Kit ID from the "Embed Options" of your kit within typekit.com. If you would like to load typekit asyncronously you can select that as well. There are some additional styles that need to be applied manually if you select asyncronously load the font', 'launchpad')); ?></p>
                    </div>
                </td>
            </tr>

            <tr valign="top">
                <td colspan="2">
                    <div id="additional-scripts">

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Additional Header Scripts', 'launchpad'); ?></th>
                                    <td>
                                        <div>
                                            <label class="screen-reader-text" for="additional_header_scripts"><span><?php _e('Additional Head Scripts', 'launchpad'); ?></span></label>
                                            <textarea name="launchpad_theme_options[additional_header_scripts]" class="html-textarea" id="additional_header_scripts">
<?php echo esc_attr($launchpad_options['additional_header_scripts']); ?>
</textarea>
                                            <p class="description"><?php printf(__('This area will include scripts within the <strong>&lt;HEAD&gt;</strong> tag of your website. In most cases you can use the footer scripts below. Through some scripts require being loaded within the <strong>&lt;HEAD&gt;</strong> tag.', 'launchpad')); ?></p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Additional Footer Scripts', 'launchpad'); ?></th>

                                    <td>
                                        <div>
                                            <label class="screen-reader-text" for="additional_footer_scripts"><span><?php _e('Additional Footer Scripts', 'launchpad'); ?></span></label>
                                            <textarea name="launchpad_theme_options[additional_footer_scripts]" class="html-textarea" id="additional_footer_scripts">
<?php echo esc_attr($launchpad_options['additional_footer_scripts']); ?>
</textarea>
                                            <p class="description"><?php printf(__('Within this area you can include any additional 3rd party scripts. Examples would include javascript needed for Twitter, HubSpot and other features not included by default with the Linchpin Launchpad or your theme', 'launchpad')); ?></p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>