<div id="extra-options">
  <h3><?php _e('Extra Options', 'hatch'); ?></h3>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row"><?php _e('Cleanup Menu Output', 'hatch'); ?></th>
        <td>
          <label class="screen-reader-text"><span><?php _e('Cleanup Menu Output', 'hatch'); ?></span></label>
          <select name="hatch_theme_options[clean_menu]" id="hatch_theme_options[clean_menu]">
            <option value="yes" <?php selected($hatch_options['clean_menu'], true); ?>><?php echo _e('Yes', 'hatch'); ?></option>
            <option value="no" <?php selected($hatch_options['clean_menu'], false); ?>><?php echo _e('No', 'hatch'); ?></option>
          </select>
        </td>
      </tr>
      <tr valign="top"><th scope="row"><?php _e('Cleanup Dashboard Output', 'hatch'); ?></th>
        <td>
          <fieldset><legend class="screen-reader-text"><span><?php _e('Cleanup Dashboard Output', 'hatch'); ?></span></legend>
            <select name="hatch_theme_options[clean_dashboard]" id="hatch_theme_options[clean_dashboard]">
              <option value="yes" <?php selected($hatch_options['clean_dashboard'], true); ?>><?php echo _e('Yes', 'hatch'); ?></option>
              <option value="no" <?php selected($hatch_options['clean_dashboard'], false); ?>><?php echo _e('No', 'hatch'); ?></option>
            </select>
          </fieldset>
        </td>
      </tr>
    </tbody>
  </table>
</div>