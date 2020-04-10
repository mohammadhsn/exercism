<?php


class Robot
{
    protected $name;

    protected $letter;

    protected $number;

    protected $names = [];

    public function __construct()
    {
        $this->letter = new CapitalLettersGenerator;
        $this->number = new NumbersGenerator;
    }

    protected function setName(string $name): bool
    {
        if ($name === $this->name || in_array($name, $this->names)) {
            return false;
        }
        $this->name = $name;
        $this->names []= $name;
        return true;
    }

    protected function generateName()
    {
        return $this->letter->generateMany(2) . $this->number->generateMany(3);
    }

    public function reset()
    {
        $newName = $this->generateName();
        while (!$this->setName($newName)) {
            $newName = $this->generateName();
        }
    }

    public function getName()
    {
        if ($this->name) {
            return $this->name;
        }
        $this->reset();
        return $this->name;
    }
}


abstract class StringGenerator
{
    abstract public function letters(): string;

    public function generateOne(): string
    {
        $letters = $this->letters();
        return $letters[mt_rand(0, strlen($letters) - 1)];
    }

    public function generateMany(int $count): string
    {
        $letters = '';
        
        for ($i = 0;$i < $count;$i ++) {
            $letters .= $this->generateOne();
        }

        return $letters;
    }
}


class CapitalLettersGenerator extends StringGenerator
{
    const LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public function letters(): string
    {
        return self::LETTERS;
    }
}


class NumbersGenerator extends StringGenerator
{
    const LETTERS = '0123456789';
    public function letters(): string
    {
        return self::LETTERS;
    }
}
