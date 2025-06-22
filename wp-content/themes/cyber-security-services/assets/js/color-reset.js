(function($) {
    function resetColorsToDefault() {
        // Define default values for your color settings
        const defaultColors = {
            'background_color': '#ffffff',
            'cyber_security_services_primary_color': '#0fa6c0',
            'cyber_security_services_secondary_color': '#2dc8dc',
            'cyber_security_services_heading_color': '#222222',
            'cyber_security_services_text_color': '#63646d',
            'cyber_security_services_primary_fade' :'#f2fafb',
            'cyber_security_services_footer_bg': '#222222',
            'cyber_security_services_post_bg': '#ffffff',
        };

        // Iterate over each setting and set it to its default value
        for (let settingId in defaultColors) {
            wp.customize(settingId).set(defaultColors[settingId]);
        }

        // Optionally refresh the preview
        wp.customize.previewer.refresh();
    }

    // Attach reset function to global scope
    window.resetColorsToDefault = resetColorsToDefault;

    $(document).ready(function() {
        $('.color-reset-btn').val('RESET'); // This adds the 'RESET' text inside the button
    });
})(jQuery);