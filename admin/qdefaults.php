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
 * Allows the admin to manage question default settings.
 *
 * @package    moodlecore
 * @subpackage questionbank
 * @copyright  2008 Thanh Le
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/../question/engine/lib.php');

if ($hassiteconfig) {
    $settings = new admin_settingpage('qdefaultsetting',
        get_string('manageqdefaults', 'admin'),
        'moodle/question:config');
    $ADMIN->add('qtypesettings', $settings);

    $settings->add(new admin_setting_heading('qdefaultsetting_preview_options',
        get_string('manageqdefaultspreviewoptions', 'admin'), ''));

    $hiddenofvisible = array(
        question_display_options::HIDDEN => get_string('notshown', 'question'),
        question_display_options::VISIBLE => get_string('shown', 'question'),
    );

    $behaviours = question_engine::get_behaviour_options('deferredfeedback');
    $settings->add(new admin_setting_configselect('question/behaviour',
        get_string('howquestionsbehave', 'question'), '',
        'adaptive', $behaviours));

    $settings->add(new admin_setting_configselect('question/correctness',
        get_string('whethercorrect', 'question'), '',
        question_display_options::HIDDEN, $hiddenofvisible));
        
    $marksoptions = array(
        question_display_options::HIDDEN => get_string('notshown', 'question'),
        question_display_options::MAX_ONLY => get_string('showmaxmarkonly', 'question'),
        question_display_options::MARK_AND_MAX => get_string('showmarkandmax', 'question'),
    );
    $settings->add(new admin_setting_configselect('question/marks',
        get_string('marks', 'question'), '', question_display_options::HIDDEN, $marksoptions));
        
    $settings->add(new admin_setting_configselect('question/feedback',
        get_string('specificfeedback', 'question'), '',
        question_display_options::HIDDEN, $hiddenofvisible));

    $settings->add(new admin_setting_configselect('question/generalfeedback',
        get_string('generalfeedback', 'question'), '',
        question_display_options::HIDDEN, $hiddenofvisible));

    $settings->add(new admin_setting_configselect('question/rightanswer',
        get_string('rightanswer', 'question'), '',
        question_display_options::HIDDEN, $hiddenofvisible));

    $settings->add(new admin_setting_configselect('question/history',
        get_string('responsehistory', 'question'), '',
        question_display_options::HIDDEN, $hiddenofvisible));
}
