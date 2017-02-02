<?php
defined('__VERN') or die('Restricted access');


// I am not using this in this starter app, but I thought I would include it just the same, since I find it
// helpful at times

class listHelper
{
    public $htmlName = '';
    public $htmlId = '';
    public $htmlClass = '';
    public $htmlStyle = '';

    public $addFirst = false;
    public $selected = null;    // mixed: index numeric or string


    // array( array('id'=>1, 'choice='whatever'), array('id'=>2, 'choice='another'),... )
    public $listOfChoices = array();

    public $listOfCheckedItems = array();

    public function __construct( $listOfChoices, $htmlName )
    {
        $this->listOfChoices = $listOfChoices;
        $this->htmlName = $htmlName;
        // everything else will be set in the calling script's code
    }

    public function asSelect($idFieldName='id', $choiceFieldName='choice')
    {
        $h = "<select name='$this->htmlName'";
        $h .= empty($this->htmlId) ?  " id='$this->htmlName'" : " id='$this->htmlId'";
        $h .= empty($this->htmlClass) ? "" : " class='$this->htmlClass'";
        $h .= empty($this->htmlStyle) ? "" : " style='$this->htmlStyle''";
        $h .= ">". PHP_EOL;

        $h .= $this->addFirst ? "<option value=0>Select one...</option>". PHP_EOL : "";

        foreach ($this->listOfChoices as $c) {
            $h .= "<option value='". $c->{$idFieldName} ."'";
            $h .= ($c->{$idFieldName} == $this->selected) ? " selected='selected'" : '';
            $h .= ">". $c->{$choiceFieldName}. "</option>" . PHP_EOL;
        }

        $h .= "</select>". PHP_EOL;
        return $h;
    }



    public function asCheckList($idFieldName='id', $choiceFieldName='choice',$p=null)
    {
        $h = '';
        // $h .= '<!-- '. var_export($p,true). ' -->';
        foreach( $this->listOfChoices as $choice) {
            $name = $this->htmlName.'_'.$choice->{$idFieldName};

            $h .= "<input type='checkbox' ";

            $h .= "name='$name'";

            $h .= empty($this->htmlId) ?  " id='$name'" : " id='$this->htmlId'";

            $h .= empty($this->htmlClass) ? "" : " class='$this->htmlClass'";
            $h .= empty($this->htmlStyle) ? "" : " style='$this->htmlStyle''";

            if ( (isset($p)==true) && (isset($p[$name])==true)   ) {
                $h .= ' myvalue=' . $p[$name];
                $h .= ($p[$name]==1) ? " value='1' checked='yes'" : " value='1'";
            } else {
                $h .=    (in_array($choice->{$idFieldName},$this->listOfCheckedItems)) ? " value='1' checked='yes'" : " value='1'";
            }

            $h .= ">" . $choice->{$choiceFieldName} . "</br>". PHP_EOL;
        }
        return $h;
    }

}
