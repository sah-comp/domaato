<?php
/**
 * Cinnebar.
 *
 * @package Domaato
 * @subpackage Model
 * @author $Author$
 * @version $Id$
 */

/**
 * Locus model.
 *
 * This model is used to store user searches after certain places in certain locations.
 *
 * @package Domaato
 * @subpackage Model
 * @version $Id$
 */
class Model_Locus extends Model
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
                'name' => 'searchtext',
                'sort' => array(
                    'name' => 'searchtext'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'place',
                'sort' => array(
                    'name' => 'place'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
    }
    
    /**
     * Update.
     */
    public function update()
    {
        if ( ! $this->bean->getId()) {
            $this->bean->stamp = time();
        }
        parent::update();
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('searchtext', array(
            new Validator_HasValue()
        ));
    }
}
