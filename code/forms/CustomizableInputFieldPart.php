<?php

/**
 * Color field
 */
class CustomizableInputFieldPart extends TextField
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

    /**
     * @var string
     */
    protected $allowedSigns = '';


    public function __construct($name = '', $title = null, $value = '', $maxLength = null, $form = null)
    {
        parent::__construct($name, $title, $value, $maxLength, $form);

        $this->setAttribute('class', 'text');
        $this->setAttribute('type', 'text');
        $this->setAttribute('data-type', 'input');
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
     * @param string $allowedSigns
     */
    public function setAllowedSigns($allowedSigns)
    {
        $this->allowedSigns = $allowedSigns;
    }

}

