<?php
/**
 * League.Url (http://url.thephpleague.com)
 *
 * @link      https://github.com/thephpleague/url/
 * @copyright Copyright (c) 2013-2015 Ignace Nyamagana Butera
 * @license   https://github.com/thephpleague/url/blob/master/LICENSE (MIT License)
 * @version   4.0.0
 * @package   League.url
 */
namespace League\Url;

use InvalidArgumentException;

/**
 * Value object representing a URL port component.
 *
 * @package League.url
 * @since   1.0.0
 */
class Port extends AbstractComponent implements Interfaces\Port
{
    /**
     * New Instance
     *
     * @param int $data
     */
    public function __construct($data = null)
    {
        if (!is_null($data)) {
            $this->data = $this->validate($data);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function validate($data)
    {
        $data = filter_var($data, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 65535]]);
        if (false === $data) {
            throw new InvalidArgumentException('The submitted port is invalid');
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getUriComponent()
    {
        $data = $this->__toString();
        if (empty($data)) {
            return $data;
        }
        return ':'.$data;
    }

    /**
     * {@inheritdoc}
     */
    public function toInt()
    {
        return $this->data;
    }
}
