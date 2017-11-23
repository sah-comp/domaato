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
 * Person model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Person extends Model
{
    /**
     * Constructor.
     *
     * Set actions for list views.
     */
    public function __construct()
    {
        $this->setAction('index', array('idle', 'toggleEnabled', 'expunge'));
    }

    /**
     * Lookup a searchterm and returns the resultset as an array.
     *
     * @param string $term The searchterm
     * @param string (optional) $query The prepared query or SQL to use for search
     * @return array
     */
    public function clairvoyant($term, $query = 'default')
    {
        switch ( $query ) {
            default:
                $sql = <<<SQL
                    SELECT
                        person.id AS id,
                        person.name AS label,
                        person.name AS value
                    FROM
                        person
                    WHERE
                        person.name LIKE :searchtext OR
                        person.nickname LIKE :searchtext OR
                        person.lastname LIKE :searchtext OR
                        person.firstname LIKE :searchtext OR
                        person.organization LIKE :searchtext
                    ORDER BY
                        person.name
SQL;
        }
        $result = R::getAll($sql, array(':searchtext' => $term . '%' ) );
        return $result;
    }

    /**
     * Toggle the enabled attribute and store the bean.
     *
     * @return void
     */
    public function toggleEnabled()
    {
        $this->bean->enabled = ! $this->bean->enabled;
        R::store($this->bean);
    }

    /**
     * Returns an array with person beans near by the given location.
     *
     * @see http://www.movable-type.co.uk/scripts/latlong.html
     * @param float $latitude
     * @param float $longitude
     * @param int $range the distance in which locations are looked up
     * @param int $radius the approximate radius of earth in kilometers or miles
     * @return array $places
     */
    public static function nearBy($lat, $lon, $range = 25, $radius = 6371)
    {
        $sql = <<<SQL
            SELECT
                person.id AS person_id,
                ( :radius * acos( cos( radians(:lat) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(:lon) ) + sin( radians(:lat) ) * sin( radians( lat ) ) ) ) AS distance
            FROM
                address
            LEFT JOIN
                person ON person_id = person.id
            WHERE
                person_id IS NOT NULL
            ORDER BY
                distance
SQL;
        $rows = R::getAssoc( $sql, array(
            ':radius' => $radius,
            ':lat' => $lat,
            ':lon' => $lon
        ) );
        return R::batch( 'person', array_keys($rows) );
    }

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
                'name' => 'nickname',
                'sort' => array(
                    'name' => 'person.nickname'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'lastname',
                'sort' => array(
                    'name' => 'person.lastname'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'firstname',
                'sort' => array(
                    'name' => 'person.firstname'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'organization',
                'sort' => array(
                    'name' => 'person.organization'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'email',
                'sort' => array(
                    'name' => 'person.email'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'phone',
                'sort' => array(
                    'name' => 'person.phone'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'enabled',
                'sort' => array(
                    'name' => 'person.enabled'
                ),
                'callback' => array(
                    'name' => 'boolean'
                ),
                'filter' => array(
                    'tag' => 'bool'
                )
            )
        );
    }

    /**
     * Returns an address bean of this person with a given label.
     *
     * @param string $label defaults to 'default'
     * @return RedBeanPHP\OODBBean $address
     */
    public function getAddress($label = 'default')
    {
        return R::findOne('address', 'label = ? AND person_id = ?', array($label, $this->bean->getId()));
    }

    /**
     * Returns keywords from this bean for tagging.
     *
     * @var array
     */
    public function keywords()
    {
        return array(
            $this->bean->email,
            $this->bean->phone,
            $this->bean->fax,
            $this->bean->account,
            $this->bean->vatid,
            $this->bean->firstname,
            $this->bean->lastname,
            $this->bean->organization,
            $this->bean->nickname,
            $this->bean->phoneticfirstname,
            $this->bean->phoneticlastname
        );
    }

    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->autoTag(true);
        $this->addValidator('nickname', array(
            new Validator_HasValue(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'nickname'))
        ));
    }

    /**
     * Sets the Wilson score and the positive and negative votes on this person.
     *
     * @see http://www.evanmiller.org/how-not-to-sort-by-average-rating.html
     *
     * @param bool $vote True (1) will count as positive, false (0) will count as negative vote
     * @return float $score The Wilson score for this person
     */
    public function setWilsonScore( $vote )
    {
        $positive = R::getCell( "SELECT count(id) FROM report WHERE person_id = :pid AND vote = 1",
            array( ':pid' => $this->bean->getId() )
        );
        $negative = R::getCell( "SELECT count(id) FROM report WHERE person_id = :pid AND vote = 0",
            array( ':pid' => $this->bean->getId() )
        );
        if ( $vote ) {
            $positive++;
        } else {
            $negative++;
        }
        $score = (($positive + 1.9208) / ($positive + $negative) - 1.96 * sqrt(($positive * $negative) /
               ($positive + $negative) + 0.9604) / ($positive + $negative)) /
               (1 + 3.8416 / ($positive + $negative));
        $this->bean->positive = $positive;
        $this->bean->negative = $negative;
        return $this->bean->score = $score;
    }

    /**
     * Returns an user bean.
     *
     * @return RedBeanPHP\OODBBean $owner
     */
    public function owner()
    {
        if ( ! $owner = $this->bean->fetchAs( 'user' )->owner ) {
            $owner = R::dispense( 'user' );
        }
        return $owner;
    }

    /**
     * Update.
     *
     * @todo Implement a switch to decide wether to use first/last or last/first name order
     */
    public function update()
    {
      if ( ! $this->bean->owner_id ) {
        unset( $this->bean->owner );
      }

        if ($this->bean->email) {
            $this->addValidator('email', array(
                new Validator_IsEmail(),
                new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'email'))
            ));
        }

		// set the phonetic names
		$this->bean->phoneticlastname = soundex($this->bean->lastname);
		$this->bean->phoneticfirstname = soundex($this->bean->firstname);
		// set the name according to sort rule
		$this->bean->name = implode(' ', array($this->bean->firstname, $this->bean->lastname));
		// company name
		if (trim($this->bean->name) == '' && $this->bean->organization || $this->bean->company) {
			$this->bean->name = $this->bean->organization;
		}
		if (trim($this->bean->name) == '') {
			$this->bean->name = $this->bean->nickname;
		}
		parent::update();
    }
}
