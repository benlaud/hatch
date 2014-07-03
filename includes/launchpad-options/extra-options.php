<div id="extra-options">
  <h3><?php _e('Extra Options', 'launchpad'); ?></h3>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row"><?php _e('Cleanup Menu Output', 'launchpad'); ?></th>
        <td>
          <label class="screen-reader-text"><span><?php _e('Cleanup Menu Output', 'launchpad'); ?></span></label>
          <select name="launchpad_theme_options[clean_menu]" id="launchpad_theme_options[clean_menu]">
            <option value="yes" <?php selected($launchpad_options['clean_menu'], true); ?>><?php echo _e('Yes', 'launchpad'); ?></option>
            <option value="no" <?php selected($launchpad_options['clean_menu'], false); ?>><?php echo _e('No', 'launchpad'); ?></option>
          </select>
        </td>
      </tr>
      <tr valign="top"><th scope="row"><?php _e('Cleanup Dashboard Output', 'launchpad'); ?></th>
        <td>
          <fieldset><legend class="screen-reader-text"><span><?php _e('Cleanup Dashboard Output', 'launchpad'); ?></span></legend>
            <select name="launchpad_theme_options[clean_dashboard]" id="launchpad_theme_options[clean_dashboard]">
              <option value="yes" <?php selected($launchpad_options['clean_dashboard'], true); ?>><?php echo _e('Yes', 'launchpad'); ?></option>
              <option value="no" <?php selected($launchpad_options['clean_dashboard'], false); ?>><?php echo _e('No', 'launchpad'); ?></option>
            </select>
          </fieldset>
        </td>
      </tr>
    </tbody>
  </table>
</div>