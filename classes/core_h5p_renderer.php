<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Moove theme.
 *
 * @package     theme_moove
 * @copyright   2023 Matheus Matias
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

global $CFG;
if (file_exists($CFG->dirroot.'/h5p/classes/output/renderer.php')) {
    if (method_exists(\core_h5p\output\renderer::class, 'h5p_alter_styles')) {
        /**
         * Class theme_moove_core_h5p_renderer.
         *
         * See: https://tracker.moodle.org/browse/MDL-69087.
         *
         * @package     theme_moove
         */
        class theme_moove_core_h5p_renderer extends \core_h5p\output\renderer {
            /**
             * Get style URL when an H5P is displayed.
             *
             * @param string $content Content.
             *
             * @return moodle_url the URL.
             */
            protected function get_style_url($content) {
                global $CFG;

                $syscontext = \context_system::instance();
                $itemid = md5($content);
                return \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php", "/$syscontext->id/theme_moove/hvp/$itemid/themehvp.css");
            }

            /**
             * Add styles when an H5P is displayed.
             *
             * @param array $styles Styles that will be applied.
             * @param array $libraries Libraries that will be shown.
             * @param string $embedtype How the H5P is displayed.
             */
            public function h5p_alter_styles(&$styles, $libraries, $embedtype) {
                $content = get_config('theme_moove', 'scssh5p');
                if (!empty($content)) {
                    $styles[] = (object) ['path' => $this->get_style_url($content), 'version' => ''];
                }
            }

            /**
             * Alter which scripts are loaded for H5P.
             * This is useful for adding custom scripts or replacing existing ones.
             *
             * @param array|object $scripts List of JavaScripts that will be loaded
             * @param array $libraries Array of libraries indexed by the library's machineName
             * @param string $embedtype Possible values: div, iframe, external, editor
             */
            public function h5p_alter_scripts(&$scripts, $libraries, $embedtype) {
                global $CFG;

                $scripts[] = (object) ['path' => $CFG->httpswwwroot . '/theme/moove/amd/src/customJSh5p.js', 'version' => '']; 
            }
            
        }
    }
}