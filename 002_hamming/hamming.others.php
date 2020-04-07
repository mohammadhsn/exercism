<?php

//
// This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
// convenience to get you started writing code faster.
//

function distance($a, $b)
{
    $compare = new SequenceCompare($a, $b);
    $compare->addValidation(new StrandValidatorLength());

    return $compare->calculateDistance();
}

/**
 * Interface InterfaceStrandValidationRule
 */
interface InterfaceStrandValidationRule
{

    /**
     * @param Strand $firstSequence
     * @param Strand $secondSequence
     *
     * @return boolean
     */
    public function satisfies(Strand $firstSequence, Strand $secondSequence);
}

/**
 * Class SequenceCompare
 */
class SequenceCompare
{

    /**
     * @var Strand
     */
    private $first;

    /**
     * @var Strand
     */
    private $second;

    /**
     * @var array|InterfaceStrandValidationRule[]
     */
    private $rules;

    /**
     * @param string $firstSequenceString
     * @param string $secondSequenceString
     */
    public function __construct($firstSequenceString, $secondSequenceString)
    {
        $this->first  = new Strand($firstSequenceString);
        $this->second = new Strand($secondSequenceString);
    }

    /**
     * @param InterfaceStrandValidationRule $sequenceRule
     */
    public function addValidation(InterfaceStrandValidationRule $sequenceRule)
    {
        $this->rules[] = $sequenceRule;
    }

    /**
     * @return bool
     */
    private function validate()
    {
        foreach ($this->rules as $rule) {
            if (!$rule->satisfies($this->first, $this->second)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return int
     */
    public function calculateDistance()
    {
        $this->validate();
        $i    = 0;
        $diff = 0;
        foreach ($this->first->getNucleotides() as $nucleotide) {
            if ($nucleotide->getChar() !== $this->second->getNucleotides()[$i]->getChar()) {
                $diff++;
            }
            $i++;
        }

        return $diff;
    }
}

/**
 * Class StrandValidatorLength
 */
class StrandValidatorLength implements InterfaceStrandValidationRule
{
    public function satisfies(Strand $firstSequence, Strand $secondSequence)
    {
        if ($firstSequence->getLength() !== $secondSequence->getLength()) {
            throw new InvalidArgumentException('DNA strands must be of equal length.', 1);
        }

        return true;
    }
}

/**
 * Class Strand
 */
class Strand
{

    /**
     * @var string
     */
    private $value;


    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return strlen($this->value);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array|Nucleotide[]
     */
    public function getNucleotides()
    {
        $result     = array();
        $characters = str_split($this->value);
        foreach ($characters as $char) {
            $result[] = new Nucleotide($char);
        }

        return $result;
    }
}

/**
 * Class Nucleotide
 */
class Nucleotide
{

    /**
     * @var string
     */
    private $char;

    /**
     * @param string $char
     */
    public function __construct($char)
    {
        $this->char = $char;
    }

    /**
     * @return string
     */
    public function getChar()
    {
        return $this->char;
    }
}
