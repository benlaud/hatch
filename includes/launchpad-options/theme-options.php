<div id="theme-options">
  <h3><?php _e('Theme Options', 'launchpad'); ?></h3>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row"><?php _e('Additional Footer Information', 'launchpad'); ?></th>
        <td>
          <div>
            <label class="screen-reader-text" for="footer_info"><span><?php _e('Additional Footer Information', 'launchpad'); ?></span></label>

            <?php wp_editor(html_entity_decode($launchpad_options['footer_info']), 'footerinfo', array('textarea_name' => "launchpad_theme_options[footer_info]", "textarea_rows" => 8)); ?>

            <p class="description"><?php printf(__('Free area to place additional information in your footer such as address information or extra phone numbers', 'launchpad')); ?></p>
          </div>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('Terms & Conditions', 'launchpad'); ?></th>
        <td>
          <div>
            <label class="screen-reader-text" for="footer_info"><span><?php _e('Terms & Conditions', 'launchpad'); ?></span></label>

            <?php wp_editor( html_entity_decode($launchpad_options['terms_conditions']), 'termsconditions', array('textarea_name' => "launchpad_theme_options[terms_conditions]", "textarea_rows" => 4, "teeny" => true)); ?>

            <p class="description"><?php printf(__('This is an area for simple copyright or other terms. Your &copy; Year and Company name will automatically be added to your site unless you input your own terms above', 'launchpad')); ?></p>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>