<?php

namespace Polntantos\AnnotationPlugin;

use Closure;
use Filament\Forms\Components\Field;
use SebastianBergmann\Type\VoidType;
use stdClass;

class AnnotationPlugin extends Field
{
    protected string $view = 'annotation-plugin::annotation-field';

    protected array|Closure $labels = [];

    protected string|Closure $text = '';

    public function setLabels(array|Closure $labels): static
    {
        if (!is_array($labels)) {
            $this->labels = $labels;
            return $this;
        }

        foreach ($labels as $label) {
            if (!in_array($label, $this->labels)) {
                $this->labels[] = $label;
            }
        }
        return $this;
    }

    public function getLabels(): ?array
    {
        return $this->evaluate($this->labels);
    }

    public function setText(string | Closure $text): static
    {
        $this->text = $text;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->evaluate($this->text);
    }

    public function getConfig(): string
    {
        $labelStrings = "";
        foreach ($this->getLabels() as $label) {
            $labelStrings .= "<Label value=\"{$label}\" background=\"{$this->genColorCodeFromText($label)}\"/>";
        }
        return "<View>
        <Labels name=\"label\" toName=\"text\">
        {$labelStrings}
        </Labels>
        <Text name=\"text\" value=\"{$this->getText()}\"/>
        </View>";
    }

    function getInterfaces(): array
    {
        return [
            "panel",
            "update",
            "submit",
            "controls",
            "side-column",
            "annotations:menu",
            "annotations:add-new",
            "annotations:delete",
            "predictions:menu",
        ];
    }

    function getUser()
    {
        $user = new stdClass();
        $user->pk = 1;
        $user->firstName = "James";
        $user->lastname = "Dean";
        return json_encode($user);
    }

    function getTask()
    {
        $task = new stdClass();
        $task->annotations = [];
        $task->predictions = [];
        // $task->load = false;
        $task->id = 1;
        $task->data = [
            "text" => $this->getText()
        ];

        return json_encode($task);
    }

    private function genColorCodeFromText($text)
    {
        $hash = md5($text);  //Gen hash of text
        $colors = array();
        for ($i = 0; $i < 3; $i++)
            $colors[$i] = max(array(round(((hexdec(substr($hash, 10 * $i, 10))) / hexdec(str_pad('', 10, 'F'))) * 255), 100)); //convert hash into 3 decimal values between 0 and 255

        if (100 > 0)  //only check brightness requirements if min_brightness is about 100
            while (array_sum($colors) / 3 < 100)  //loop until brightness is above or equal to min_brightness
                for ($i = 0; $i < 3; $i++)
                    $colors[$i] += 10;    //increase each color by 10

        $output = '';

        for ($i = 0; $i < 3; $i++)
            $output .= str_pad(dechex($colors[$i]), 2, 0, STR_PAD_LEFT);  //convert each color to hex and append to output

        return '#' . $output;
    }
}
