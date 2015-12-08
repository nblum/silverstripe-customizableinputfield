<?php

/**
 * Color field
 */
class CustomizableInputFieldSet extends TextField
{

    /**
     * @var TextField[]
     */
    protected $parts = [];

    public function __construct($name, $title = null, $value = '', $maxLength = null, $form = null)
    {
        parent::__construct($name, $title, $value, $maxLength, $form);


        $this->setTemplate('CustomizableInputField');

        $this->setAttribute('class', 'text');
        $this->setAttribute('data-value', 'true');
        $this->setAttribute('type', 'hidden');
    }

    /**
     * @return CustomizableInputField
     */
    public function addPart(CustomizableInputFieldPart $part)
    {
        if (empty($part->getName())) {
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
     * returns the parts with filled values
     * @return ArrayList
     */
    public function getParts()
    {
        $partValues = json_decode($this->getAttribute('value'));

        /* @var $part CustomizableInputFieldPart */
        foreach ($this->parts as $key => $part) {
            if (!isset($partValues[$key])) {
                continue;
            }
            $part->setAttribute('value', $partValues[$key]->val);
        }

        return new ArrayList($this->parts);
    }


    /* public function Value() {
         return 'val';
     }

     public function getValue() {
         return 'val';
     }

     public function Bla() {
         return 'bla1';
     }

     public function getBla() {
         return 'bla2';
     }

     public function Items() {
         return $this->forTemplate();
     }

     public function forTemplate() {
         return json_decode($this->value);
     }*/

    /**
     * @param mixed $value
     * @return $this
     */
    /*public function setValue($value) {
        $this->parts =
        parent::setValue($value);
        //return parent::setValue(json_decode($value));
    }*/
}

