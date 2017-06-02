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
 * Email model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Email extends Model
{
    /**
     * Returns an array with attributes for lists.
     *
     * @param string (optional) $layout
     * @return array
     */
    public function getAttributes($layout = 'table')
    {
        return array(
            array(
                'name' => 'email',
                'sort' => array(
                    'name' => 'email'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('email', array(
            new Validator_HasValue(),
            new Validator_IsEmail(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'email'))
        ));
    }
}
