<?php

/**
 * Color field
 */
class CustomizableInputFieldSet extends TextField
{

    /**
     * @var string
     */
    protected $rawValue = '';

    /**
     * @var TextField[]
     */
    protected $parts = array();

    public function __construct($name, $title = null, $value = '', $maxLength = null, $form = null)
    {
        parent::__construct($name, $title, $value, $maxLength, $form);


        $this->setTemplate('CustomizableInputField');

        $this->setAttribute('class', 'text');
        $this->setAttribute('data-value', 'true');
        $this->setAttribute('type', 'hidden');
    }

    /**
     * @return FormField
     */
    public function addPart(FormField $part)
    {
        if (strval($part->getName()) === '') {
            $part->setName(sprintf('%s-%s', $this->getName(), count($this->parts)));
        }
        $part->setAttribute('data-part', count($this->parts));

        $this->parts[] = $part;
        return $this;
    }

    public function Field($properties = array())
    {
        Requirements::css('silverstripe-customizableinputfield/css/customizable-input.css');
        Requirements::javascript('silverstripe-customizableinputfield/javascript/customizable-input.js');
        return parent::Field($properties);
    }

    /**
     * forces concatenated output
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        return parent::setValue($value);
    }


    /**
     * returns the parts with filled values
     * @return ArrayList
     */
    public function getParts()
    {
        $partValues = json_decode($this->value);

        /* @var $part CustomizableInputFieldPart */
        foreach ($this->parts as $key => $part) {
            if (!isset($partValues[$key])) {
                continue;
            }
            $part->setValue($partValues[$key]->val);
            $part->setAttribute('value', $partValues[$key]->val);
        }

        return new ArrayList($this->parts);
    }
}

