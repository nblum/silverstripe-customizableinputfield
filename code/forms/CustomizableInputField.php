<?php


class CustomizableInputField extends Text
{


    public function Strval()
    {
        $parts = json_decode($this->value);
        $strval = '';

        foreach ($parts as $part) {
            $strval .= $part->val;
        }

        return $strval;
    }

    public function Parts()
    {
        $parts = json_decode($this->value);

        $items = array();
        if ($parts) {
            foreach ($parts as $key => $item) {
                $obj = new ArrayData([
                    'Value' => $item->val,
                    'Before' => $item->before,
                    'After' => $item->after
                ]);
                $items[] = $obj;
            }
        }
        return new ArrayList($items);
    }

}