<?php


class Bob { 
    public function respondTo(string $sentence): string
    {
        return (new DialogProccesor($sentence, new AnswerFactory))
            ->addSanitizer(new WhiteSpaceSanitizer)
            ->process()
            ->dialog();
    }

}


interface Answer
{
    public function dialog(): string;
}


class QuestionAnswer implements Answer
{
    public function dialog(): string
    {
        return 'Sure.';
    }
}

class YellAnswer implements Answer
{
    public function dialog(): string
    {
        return 'Whoa, chill out!';
    }
}


class YellQuestionAnswer implements Answer
{
    public function dialog(): string
    {
        return "Calm down, I know what I'm doing!";
    }
}


class AddressQuestionAnswer implements Answer
{
    public function dialog(): string
    {
        return 'Fine. Be that way!';
    }
}


class MiscellaneousQuestionAnswer implements Answer
{
    public function dialog(): string
    {
        return 'Whatever.';
    }
}


class Str
{
    protected $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function __toString()
    {
        return $this->str();
    }

    public function isEmpty()
    {
        return $this->string === '';
    }

    public function startsWith(string $needle)
    {
        return substr($this->string, 0, strlen($this->string)) === $needle;
    }

    protected function getLetters()
    {
        preg_match_all('/[A-Za-z]/', $this->string, $letters);
        return $letters[0];
    }

    public function isUppercase()
    {
        $letters = $this->getLetters();

        if (empty($letters)) {
            return false;
        }

        return mb_strtoupper(implode($letters)) === implode($letters);
    }

    public function endsWith(string $needle)
    {
        return substr($this->string, -strlen($needle)) === $needle;
    }

    public function str(): string
    {
        return $this->string;
    }
}


class AnswerFactory
{
    public function createAnswer(Str $str): Answer
    {
        if ($str->isUppercase() && $str->endsWith('?')) {
            return new YellQuestionAnswer;
        } elseif ($str->isUppercase()) {
            return new YellAnswer;
        } elseif ($str->endsWith('?')) {
            return new QuestionAnswer;
        } elseif ($str->isEmpty()) {
            return new AddressQuestionAnswer;
        } else {
            return new MiscellaneousQuestionAnswer;
        }

        throw new InvalidArgumentException("There is no answer for {$str->str()}");
    }

}


interface Sanitizer
{
    public function sanitize(string $sentence): string;
}


class WhiteSpaceSanitizer implements Sanitizer
{
    public function sanitize(string $sentence): string
    {
        return preg_replace('/\s/', '', $sentence);
    }
}


class DialogProccesor
{
    /**
     * @var Sanitizer []
     */
    protected $sanitizers = [];
    /**
     * @var AnswerFactory
     */
    protected $factory;
    /**
     * @var string
     */
    protected $string;

    public function __construct(string $string, AnswerFactory $factory)
    {
        $this->factory = $factory;
        $this->string = $string;
    }

    public function addSanitizer(Sanitizer $sanitizer): self
    {
        $this->sanitizers []= $sanitizer;
        return $this;
    }

    public function clean()
    {
        foreach ($this->sanitizers as $sanitizer) {
            $this->string = $sanitizer->sanitize($this->string);
        }

        return $this;
    }

    public function process(): Answer
    {
        $this->clean();
        return $this->factory->createAnswer(new Str($this->string));
    }
}
