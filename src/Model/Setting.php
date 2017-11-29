<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Model
 * @author $Author$
 * @version $Id$
 */

/**
 * Setting model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Setting extends Model
{
    /**
     * Dispense a setting.
     */
    public function dispense()
    {
    }

    /**
     * Update.
     *
     * If newsletter emailaddress attribute is set, it must be a valid email address.
     */
    public function update()
    {
        if ($this->bean->nlemailaddress) {
            $this->addValidator('nlemailaddress', array(
                new Validator_IsEmail()
            ));
        }
    }
}
