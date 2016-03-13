<?php

/**
 * Color field
 */
class CustomizableDropdownPart extends DropdownField
{

    /**
     * @var string
     */
    protected $before = '';

    /**
     * @var string
     */
    protected $after = '';

    /**
     * @var string
     */
    protected $beforeVal = '';

    /**
     * @var string
     */
    protected $afterVal = '';

    /**
     * @var string
     */
    protected $whitespaces = 1;


    public function __construct($name = '', $title=null, $source=array(), $value='', $form=null, $emptyString=null)
    {
        parent::__construct($name, $title, $source, $value, $form, $emptyString);

        $this->setAttribute('data-type', 'dropdown');
    }

    /**
     * @return string
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @param $before
     * @param bool|false $beforeVal
     * @return CustomizableInputField
     */
    public function setBefore($before, $beforeVal = false)
    {
        $this->before = strval($before);

        if ($beforeVal !== false) {
            $this->beforeVal = strval($beforeVal);
        } else {
            $this->beforeVal = $this->before;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param $after
     * @param bool|false $afterVal
     * @return CustomizableInputField
     */
    public function setAfter($after, $afterVal = false)
    {
        $this->after = strval($after);

        if ($afterVal !== false) {
            $this->afterVal = strval($afterVal);
        } else {
            $this->afterVal = $this->after;
        }
        return $this;
    }

    /**
     * removes whitespaces between input, before and after
     */
    public function setNoWithespaces()
    {
        $this->whitespaces = 0;
    }

    /**
     *
     */
    public function Selected()
    {
        return $this->Value();
    }

    /**
     * Gets the source array including any empty default values.
     *
     * @return array|ArrayAccess
     */
    public function Options() {

        $options = $this->getSource();
        $items = array();
        if ($options) {
            foreach ($options as $value => $title) {
                $obj = new ArrayData(array(
                    'Title' => $title,
                    'Value' => $value
                ));
                $items[] = $obj;
            }
        }
        return new ArrayList($items);
    }

}

